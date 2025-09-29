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

// Client-facing routes
Route::prefix('clients')->name('clients.')->group(function () {
    Route::get('/', LandingPage::class)->name('landing');
    // Add more client routes here as needed
    // Route::get('/services', [ClientController::class, 'services'])->name('services');
    // Route::get('/contact', [ClientController::class, 'contact'])->name('contact');
});

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Client Management
    Route::get('/clients', Index::class)->name('clients.index');
    Route::get('/clients/create', Create::class)->name('clients.create');
    Route::get('/clients/{client}/edit', Edit::class)->name('clients.edit');

    // Services Management
    Route::get('/services', \App\Livewire\Services\Index::class)->name('services.index');

    //Invoice Management
    Route::get('/invoices', \App\Livewire\Invoices\ManageInvoices::class)->name('invoices.index');

    // Invoice PDF generation
    Route::get('/invoices/{invoice}/pdf', [InvoicePdfController::class, 'show'])
        ->name('invoices.pdf')
        ->where('invoice', '[0-9]+'); // Ensure invoice parameter is numeric
});

// Profile routes (requires auth but not email verification)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
});

// Include authentication routes
require __DIR__ . '/auth.php';
