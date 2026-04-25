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

Route::get('/videos', function (Request $request) {
    app()->setLocale('en');
    return view('videos', ['locale' => 'en', 'isSw' => false]);
})->middleware(TrackPageVisit::class)->name('videos.en');

Route::get('/sw/videos', function (Request $request) {
    app()->setLocale('sw');
    return view('videos', ['locale' => 'sw', 'isSw' => true]);
})->middleware(TrackPageVisit::class)->name('videos.sw');

// Sitemap
Route::get('/sitemap.xml', function () {
    $urls = [
        url('/'),
        url('/sw'),
    ];

    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    
    foreach ($urls as $url) {
        $xml .= '<url>';
        $xml .= '<loc>' . htmlspecialchars($url) . '</loc>';
        $xml .= '<changefreq>weekly</changefreq>';
        $xml .= '<priority>1.0</priority>';
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
