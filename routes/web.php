<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LeadCrudController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\LeadController;
use App\Http\Middleware\TrackPageVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public homepage with visitor tracking
Route::get('/', function (Request $request) {
    $request->session()->put('locale', 'en');
    app()->setLocale('en');

    return view('home');
})->middleware(TrackPageVisit::class)->name('home');

Route::get('/sw', function (Request $request) {
    $request->session()->put('locale', 'sw');
    app()->setLocale('sw');

    return view('home');
})->middleware(TrackPageVisit::class)->name('home.sw');

// Lead capture API
Route::post('/lead-capture', [LeadController::class, 'store'])->name('leads.store');

// Section endpoints with cookie tracking
$sections = [
    'about' => 'about',
    'program' => 'featured-program',
    'offers' => 'offers',
    'payments' => 'payments',
    'videos' => 'intro-video',
    'faq' => 'faq',
    'kyc' => 'lead-capture',
];

foreach ($sections as $name => $anchor) {
    Route::get('/' . $name, function () use ($name, $anchor) {
        return redirect('/#' . $anchor)->cookie('last_visited_section', $name, 1440);
    })->name('section.' . $name);

    Route::get('/sw/' . $name, function () use ($name, $anchor) {
        return redirect('/sw#' . $anchor)->cookie('last_visited_section', $name, 1440);
    })->name('section.sw.' . $name);
}

// Auth routes
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
