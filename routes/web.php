<?php

use App\Services\SitemapGenerator;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteMapController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Sitemaps Route
    Route::get('/site-maps', [SiteMapController::class, 'index'])->name('site-maps.index');
    Route::get('/site-maps/create', [SiteMapController::class, 'create'])->name('site-maps.create');
    Route::post('/site-maps', [SiteMapController::class, 'store'])->name('site-maps.store');
    Route::get('/site-maps/{siteMap}/edit', [SiteMapController::class, 'edit'])->name('site-maps.edit');
    Route::put('/site-maps/{siteMap}', [SiteMapController::class, 'update'])->name('site-maps.update');
    Route::get('site-maps/{id}', [SiteMapController::class, 'show'])->name('site-maps.show');
    Route::delete('/site-maps/{siteMap}', [SiteMapController::class, 'destroy'])->name('site-maps.destroy');
});

require __DIR__ . '/auth.php';
