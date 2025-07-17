<?php

// use App\Http\Controllers\Antrian\RadiologyController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TTD\HasilController;
use App\Http\Controllers\TTD\KecamatanController;
use App\Http\Controllers\TTD\KelurahanController;
use App\Http\Controllers\TTD\PemeriksaanController;
use App\Http\Controllers\TTD\PuskesmasController;
use App\Http\Controllers\TTD\SekolahController;
use App\Http\Controllers\TTD\TambahDarahController;
use App\Http\Controllers\TTD\UserController;
use App\Models\TambahDarah;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes();
//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);


Route::middleware('guest')->group(function () {
    // Route::get('register', [RegisteredUserController::class, 'create'])
    //     ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

    Route::get('/', [PemeriksaanController::class, 'index'])->name('index');
});


Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('ttd/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/chart/hasil', [HasilController::class, 'chartData']);
    Route::get('/ttd/chart/donut/hasil/{bulan}/{puskesmas}', [HasilController::class, 'hasilHB'])->name('donutChart');

    Route::get('tambah-darah/data', [TambahDarahController::class, 'data'])->name('tambah-darah.data');
    Route::get('tambah-darah/{id}/edit', [TambahDarahController::class, 'getedit'])->name('tambah-darah.getedit');
    Route::put('tambah-darah/{id}/update', [TambahDarahController::class, 'update'])->name('tambah-darah.update');
    Route::delete('tambah-darah/{id}', [TambahDarahController::class, 'destroy'])->name('tambah-darah.destroy');    
    Route::put('tambah-darah/{id}/restore', [TambahDarahController::class, 'restore'])->name('tambah-darah.restore');
});

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::resource('kecamatan', KecamatanController::class);
});

Route::middleware(['auth', 'role:superadmin,admin'])->group(function () {
    Route::resource('puskesmas', PuskesmasController::class);
    Route::resource('user', UserController::class);
    Route::resource('sekolah', SekolahController::class);
    Route::get('/sekolah/export', [SekolahController::class, 'export'])->name('sekolah.export');
    Route::post('/pemeriksaan/restore/{id}', [PemeriksaanController::class, 'restore'])->name('pemeriksaan.restore');
    Route::post('/hasil-pemeriksaan/restore/{id}', [HasilController::class, 'restore'])->name('hasil-pemeriksaan.restore');
});

Route::middleware(['auth', 'role:superadmin,admin,puskesmas,sekolah'])->group(function () {
    Route::resource('pemeriksaan', PemeriksaanController::class);
});
Route::resource('hasil-pemeriksaan', HasilController::class);

Route::post('/pemeriksaan', [PemeriksaanController::class, 'store'])->name('pemeriksaan.store');
Route::get('tambah-darah', [TambahDarahController::class, 'index'])->name('tambah-darah.index');
Route::get('tambah-darah/{id}', [TambahDarahController::class, 'show'])->name('tambah-darah.show');
Route::post('tambah-darah', [TambahDarahController::class, 'store'])->name('tambah-darah.store');
Route::get('tambah-darah/cari-nik/{nik}', [TambahDarahController::class, 'cariByNik']);
Route::get('/geo-kecamatan', [KecamatanController::class, 'geojson'])->name('geo-kec');
Route::get('/geo-kelurahan', [KelurahanController::class, 'geojson'])->name('geo-kel');
Route::get('/get-data-sekolah', [SekolahController::class, 'data'])->name('sekolah.data');
Route::get('/cari-nik', [HasilController::class, 'cariNik'])->name('biodata.cari-nik');


// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->where('any', '.*');
