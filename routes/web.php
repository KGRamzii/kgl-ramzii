<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoicePdfController;
use App\Livewire\Clients\{LandingPage, Index, Create, Edit};

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
// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Client-facing routes (public)
Route::prefix('clients')->name('clients.')->group(function () {
    Route::get('/', LandingPage::class)->name('landing');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Client Management (protected)
    Route::prefix('dashboard/clients')->name('clients.')->group(function () {
        Route::get('/', Index::class)->name('index');
        Route::get('/create', Create::class)->name('create');
        Route::get('/{client}/edit', Edit::class)->name('edit');
    });

    // Services Management
    Route::get('/dashboard/services', \App\Livewire\Services\Index::class)->name('services.index');

    // Invoice Management
    Route::get('/dashboard/invoices', \App\Livewire\Invoices\ManageInvoices::class)->name('invoices.index');

    // Invoice PDF generation
    Route::get('/dashboard/invoices/{invoice}/pdf', [InvoicePdfController::class, 'show'])
        ->name('invoices.pdf')
        ->where('invoice', '[0-9]+');
});

// Profile routes (requires auth but not email verification)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
});

// Include authentication routes
require __DIR__ . '/auth.php';
