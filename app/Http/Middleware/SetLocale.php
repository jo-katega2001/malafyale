<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * @var array<int, string>
     */
    private array $supportedLocales = ['en', 'sw'];

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->session()->get('locale', config('app.locale'));

        if (! in_array($locale, $this->supportedLocales, true)) {
            $locale = config('app.fallback_locale', 'en');
        }

        app()->setLocale($locale);
        View::share('currentLocale', $locale);

        return $next($request);
    }
}
