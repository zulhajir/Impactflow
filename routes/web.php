<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ParticipationController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Rute Publik (Akses Tanpa Login) ---
Route::get('/', [PublicController::class, 'welcome'])->name('welcome');
Route::get('/kegiatan', [PublicController::class, 'activities'])->name('public.activities.index');
Route::get('/kegiatan/{activity}', [PublicController::class, 'showActivity'])->name('public.activities.show');

Route::get('/berita', [PublicController::class, 'contentsIndex'])->name('public.contents.index');
Route::get('/berita/{content:slug}', [PublicController::class, 'showContent'])->name('public.contents.show');

Route::get('/galeri', [PublicController::class, 'mediaIndex'])->name('public.media.index');
Route::get('/galeri/{album}', [PublicController::class, 'showMedia'])->name('public.media.show');

Route::get('/donasi', [PublicController::class, 'donationPage'])->name('public.donations.page');
Route::post('/donasi-submit', [PublicController::class, 'submitDonation'])->name('public.donations.submit');

Route::get('/tentang-kami', function() { return view('public.about'); })->name('public.about');
Route::get('/kontak-kami', function() { return view('public.contact'); })->name('public.contact');


// --- Rute Otentikasi (Login/Register/Logout) ---
Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('register.store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('login.authenticate');
    Route::post('/logout', 'logout')->name('logout');
});

// --- Rute yang Memerlukan Autentikasi (untuk User yang Login) ---
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/kegiatan/{activity}/daftar/{type}', [PublicController::class, 'registerParticipation'])->name('public.participation.register');
    Route::delete('/kegiatan/{activity}/batal/{type}', [PublicController::class, 'cancelParticipation'])->name('public.participation.cancel');
});

// --- Rute Khusus Admin/Pengelola (Memerlukan Autentikasi DAN Role Admin/Manager) ---
Route::middleware(['auth', 'role:admin,manager'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('activities', ActivityController::class);

    Route::prefix('activities/{activity}')->name('activities.')->group(function () {
        Route::get('participations', [ParticipationController::class, 'index'])->name('participations.index');
        Route::post('participations', [ParticipationController::class, 'store'])->name('participations.store');
        Route::put('participations/{participation}', [ParticipationController::class, 'update'])->name('participations.update');
        Route::delete('participations/{participation}', [ParticipationController::class, 'destroy'])->name('participations.destroy');
        Route::get('export-participations', [ParticipationController::class, 'export'])->name('participations.export');
    });

    Route::resource('donations', DonationController::class);
    Route::get('donations/export', [DonationController::class, 'export'])->name('donations.export'); // Rute untuk export donasi

    Route::resource('contents', ContentController::class);

    Route::resource('media', MediaController::class);
    Route::prefix('media/{album}')->name('media.')->group(function () {
        Route::get('items', [MediaController::class, 'itemsIndex'])->name('items.index');
        Route::post('items', [MediaController::class, 'storeItem'])->name('items.store');
        Route::delete('items/{item}', [MediaController::class, 'destroyItem'])->name('items.destroy');
    });

    Route::resource('users', UserController::class)->except(['create', 'store']);
    Route::post('users/{user}/change-role', [UserController::class, 'changeRole'])->name('users.change-role');

    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');


    Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');


        Route::resource('users', UserController::class)->except(['create', 'store']);
        Route::post('users/{user}/change-role', [UserController::class, 'changeRole'])->name('users.change-role');

    });
});