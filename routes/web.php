<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CreatedController;
use App\Http\Controllers\PlatformController;

use App\Models\Created;
use App\Models\Platform;

// Routes Admin
Route::get('/', [AdminController::class, 'showLoginForm'])->name('login');
Route::post('login', [AdminController::class, 'login']);
Route::get('adminpage', [AdminController::class, 'login'])->name('adminpage');
Route::get('adminpage', function () {
    return view('adminpage');
})->name('adminpage');
Route::get('adminpage', [AdminController::class, 'showAdminPage'])->name('adminpage');


// Routes Created
Route::post('/created/store', [CreatedController::class, 'store'])->name('created.store');
Route::get('/utilisateurs', [CreatedController::class, 'index'])->name('created.index');
Route::delete('/utilisateurs/{id}', [CreatedController::class, 'destroy'])->name('created.destroy');
Route::get('edit/{id}', [CreatedController::class, 'edit'])->name('edit');
Route::put('/created/update/{id}', [CreatedController::class, 'update'])->name('created.update');
Route::get('/created/create', [CreatedController::class, 'create'])->name('created.create');

// Routes Platforms
Route::get('/platforms', [PlatformController::class, 'index'])->name('platforms.index');
Route::post('/platforms/store', [PlatformController::class, 'store'])->name('platforms.store');
Route::delete('/platforms/{id}', [PlatformController::class, 'destroy'])->name('platforms.destroy');
Route::resource('platforms', PlatformController::class);
// Pages spécifiques
Route::get('/createdpage', function () {
    return view('createdpage');
})->name('createdpage');
//Route::get('platforms/{platformId}/check-access', [PlatformController::class, 'checkAccess']);
//Route::get('platforms/{platformId}/check-access', [PlatformController::class, 'checkAccess']);
//Route::post('platforms', [PlatformController::class, 'store']);
Route::post('login-jwt', [AdminController::class, 'loginWithJWT']);