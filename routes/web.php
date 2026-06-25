<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminAboutController;
use App\Http\Controllers\Admin\PenelitianController;
use App\Http\Controllers\Admin\InformationController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ResearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/Research', [ResearchController::class, 'index'])->name('research.index');
Route::get('/Information', [InfoController::class, 'index'])->name('information.index');
Route::get('/information/detail/{id}', [InfoController::class, 'show'])->name('information.detail');
Route::get('/About', [AboutController::class, 'index'])->name('about.index');
Route::get('/research/detail/{id}', [ResearchController::class, 'detail'])->name('detail.penelitian');
Route::get('/berita/detail/{id}', [NewsController::class, 'show'])->name('detail.berita');
Route::get('/media/detail/{id}', [MediaController::class, 'detail'])->name('media.detail');


Route::middleware(['guest:admin'])->group(function () {
    Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
});

Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/{berita}', [BeritaController::class, 'show'])->name('berita.show');
    Route::get('/berita/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/berita/{berita}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');

    Route::get('/penelitian', [PenelitianController::class, 'index'])->name('penelitian.index');
    Route::get('/penelitian/create', [PenelitianController::class, 'create'])->name('penelitian.create');
    Route::post('/penelitian/store', [PenelitianController::class, 'store'])->name('penelitian.store');
    Route::get('/penelitian/{id}/edit', [PenelitianController::class, 'edit'])->name('penelitian.edit');
    Route::put('/penelitian/{id}/update', [PenelitianController::class, 'update'])->name('penelitian.update');
    Route::delete('/penelitian/{id}/delete', [PenelitianController::class, 'destroy'])->name('penelitian.destroy');

    Route::get('/information', [InformationController::class, 'index'])->name('information.index');
    Route::get('/information/create', [InformationController::class, 'create'])->name('information.create');
    Route::post('/information/store', [InformationController::class, 'store'])->name('information.store');
    Route::get('/information/{id}/edit', [InformationController::class, 'edit'])->name('information.edit');
    Route::put('/information/{id}/update', [InformationController::class, 'update'])->name('information.update');
    Route::delete('/information/{id}/delete', [InformationController::class, 'destroy'])->name('information.destroy');

    Route::get('/media', [MediaController::class, 'index'])->name('media.index');
    Route::get('/media/create', [MediaController::class, 'create'])->name('media.create');
    Route::post('/media/store', [MediaController::class, 'store'])->name('media.store');
    Route::get('/media/{id}/edit', [MediaController::class, 'edit'])->name('media.edit');
    Route::put('/media/{id}/update', [MediaController::class, 'update'])->name('media.update');
    Route::delete('/media/{id}/delete', [MediaController::class, 'destroy'])->name('media.destroy');

    Route::get('/about', [AdminAboutController::class, 'index'])->name('about.index');
    Route::get('/about/create', [AdminAboutController::class, 'create'])->name('about.create');
    Route::post('/about', [AdminAboutController::class, 'store'])->name('about.store');
    Route::get('/about/{id}/edit', [AdminAboutController::class, 'edit'])->name('about.edit');
    Route::put('/about/{id}', [AdminAboutController::class, 'update'])->name('about.update');
    Route::delete('/about/{id}', [AdminAboutController::class, 'destroy'])->name('about.destroy');
});
