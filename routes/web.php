<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\SidangController;
use App\Http\Controllers\AkunDosenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DataMagangController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/data-magang', [DataMagangController::class, 'index'])->name('data-magang');
    Route::post('/data-magang', [DataMagangController::class, 'store'])->name('data-magang.post');
    Route::get('/data-magang/{id}/{name}', [DataMagangController::class, 'show'])->name('data-magang.detail-mahasiswa');

    Route::get('/data-magang/{id}', [DataMagangController::class, 'edit'])->name('data-magang.edit-data-diri');
    Route::patch('/data-magang/{id}', [DataMagangController::class, 'update'])->name('data-magang.update-data-diri');
    // perubahan
    Route::put('/tentukan-kelulusan/{id}', [DataMagangController::class, 'tentukanKelulusan'])->name('tentukan-kelulusan');
    // dikit
    // p2
    Route::post('/upload-laporan/{id}', [DataMagangController::class, 'uploadLaporan'])->name('upload.laporan');

    // p2
    Route::patch('/data-tempat-magang/{id}/update', [DataMagangController::class, 'update_tempat_magang'])->name('update-tempat-magang');
    Route::patch('/data-penjadwalan/{id}/update', [SidangController::class, 'update_penjadwalan'])->name('update-penjadwalan');
    Route::put('/data-nilai/{id}/update', [NilaiController::class, 'update_nilai'])->name('update_nilai');

    Route::get('/profile', [ProfileController::class, 'index']);
    Route::get('/profile/edit', [ProfileController::class, 'edit']);
    Route::patch('/profile/update', [ProfileController::class, 'update']);

    Route::resource('data-akun-dosen', AkunDosenController::class)->middleware('adminOnly');
    Route::patch('/data-akun-dosen/update-role/{id}', [AkunDosenController::class, 'jadikan_dosen_penguji'])->middleware('adminOnly');

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');
    Route::get('/welcome', [LoginController::class, 'welcome'])->name('welcome');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});
