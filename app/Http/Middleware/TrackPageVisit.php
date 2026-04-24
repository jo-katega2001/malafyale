<?php

namespace App\Http\Middleware;

use App\Models\PageVisit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class TrackPageVisit
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only track GET requests to HTML pages (not assets, not admin, not API)
        if (
            $request->isMethod('GET') &&
            !$request->is('admin/*') &&
            !$request->is('api/*') &&
            !$request->ajax() &&
            $response->getStatusCode() === 200 &&
            Schema::hasTable('page_visits')
        ) {
            // Simple rate-limit: skip if same IP visited same URL within 30 seconds
            $recentVisit = PageVisit::where('ip_address', $request->ip())
                ->where('url', $request->fullUrl())
                ->where('visited_at', '>=', now()->subSeconds(30))
                ->exists();

            if (!$recentVisit) {
                PageVisit::create([
                    'ip_address' => $request->ip(),
                    'user_agent' => substr($request->userAgent() ?? '', 0, 500),
                    'url' => substr($request->fullUrl(), 0, 2048),
                    'referrer' => $request->header('referer') ? substr($request->header('referer'), 0, 2048) : null,
                    'visited_at' => now(),
                ]);
            }
        }

        return $response;
    }
}
