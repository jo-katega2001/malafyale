<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LeadCrudController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\LeadController;
use App\Http\Middleware\TrackPageVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;

// Public homepage with visitor tracking
$renderHome = function (
    Request $request,
    string $locale,
    ?string $sectionName = null,
    ?string $sectionAnchor = null
) {
    $request->session()->put('locale', $locale);
    app()->setLocale($locale);

    return response()->view('home', [
        'sectionName' => $sectionName,
        'sectionAnchor' => $sectionAnchor,
    ]);
};

Route::get('/', fn (Request $request) => $renderHome($request, 'en'))
    ->middleware(TrackPageVisit::class)
    ->name('home');

Route::get('/sw', fn (Request $request) => $renderHome($request, 'sw'))
    ->middleware(TrackPageVisit::class)
    ->name('home.sw');

// Lead capture API
Route::post('/lead-capture', [LeadController::class, 'store'])->name('leads.store');

// Section endpoints with hardened cookie tracking
$sections = [
    'request-callback' => 'lead-capture',
    'quick-actions' => 'quick-actions',
    'about' => 'about',
    'audience' => 'audience-fit',
    'program' => 'featured-program',
    'offers' => 'offers',
    'payments' => 'payments',
    'videos' => 'intro-video',
    'faq' => 'faq',
    'start' => 'start-now',
    'kyc' => 'lead-capture',
];

$sectionCookie = function (string $name) {
    return Cookie::make(
        'last_visited_section',
        $name,
        1440,
        '/',
        null,
        app()->environment('production'),
        true,
        false,
        'Strict'
    );
};

foreach ($sections as $name => $anchor) {
    Route::get('/' . $name, function (Request $request) use ($renderHome, $sectionCookie, $name, $anchor) {
        return $renderHome($request, 'en', $name, $anchor)
            ->withCookie($sectionCookie($name));
    })->middleware(TrackPageVisit::class)->name('section.' . $name);

    Route::get('/sw/' . $name, function (Request $request) use ($renderHome, $sectionCookie, $name, $anchor) {
        return $renderHome($request, 'sw', $name, $anchor)
            ->withCookie($sectionCookie($name));
    })->middleware(TrackPageVisit::class)->name('section.sw.' . $name);
}

// Sitemap
Route::get('/sitemap.xml', function () use ($sections) {
    $urls = [
        url('/'),
        url('/sw'),
    ];

    foreach (array_keys($sections) as $name) {
        $urls[] = url('/' . $name);
        $urls[] = url('/sw/' . $name);
    }

    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    
    foreach ($urls as $url) {
        $xml .= '<url>';
        $xml .= '<loc>' . htmlspecialchars($url) . '</loc>';
        $xml .= '<changefreq>weekly</changefreq>';
        $xml .= '<priority>' . ($url === url('/') || $url === url('/sw') ? '1.0' : '0.8') . '</priority>';
        $xml .= '</url>';
    }
    
    $xml .= '</urlset>';

    return response($xml, 200, [
        'Content-Type' => 'application/xml'
    ]);
})->name('sitemap');

// Auth routes
Route::redirect('/portal', '/portal/login')->name('portal');
Route::get('/portal/login', [LoginController::class, 'showLoginForm'])->name('portal.login');
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// Admin routes (auth required)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Leads CRUD
    Route::get('/leads', [LeadCrudController::class, 'index'])->name('leads.index');
    Route::get('/leads/{lead}', [LeadCrudController::class, 'show'])->name('leads.show');
    Route::get('/leads/{lead}/edit', [LeadCrudController::class, 'edit'])->name('leads.edit');
    Route::put('/leads/{lead}', [LeadCrudController::class, 'update'])->name('leads.update');
    Route::delete('/leads/{lead}', [LeadCrudController::class, 'destroy'])->name('leads.destroy');
    Route::patch('/leads/{lead}/status', [LeadCrudController::class, 'updateStatus'])->name('leads.update-status');

    // Visitors
    Route::get('/visitors', [VisitorController::class, 'index'])->name('visitors.index');
});
