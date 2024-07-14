<?php

use App\Http\Controllers\QrCodeScannerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
});

Auth::routes(); // Pastikan hanya ini yang mengatur rute autentikasi

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rute untuk profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Rute untuk halaman scanner
    Route::get('/scanner', [QrCodeScannerController::class, 'index'])->name('scanner');
    Route::post('/scanner', [QrCodeScannerController::class, 'scan'])->name('scanner.scan');
});

require __DIR__.'/auth.php';
