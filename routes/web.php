<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PetaController;

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
    return view('pages.front.home');
});

Route::get('/peta', function () {
    return view('pages.front.home');
});

Route::get('/kontak', function () {
    return view('pages.front.kontak');
});

Route::get('/manfaat-jagung-bagi-kesehatan', function () {
    return view('pages.front.manfaatJagung');
});
Route::get('/cara-budidaya-jagung', function () {
    return view('pages.front.budidayaJagung');
});
Route::get('/kesehatan-jagung', function () {
    return view('pages.front.kesehatanJagung');
});

Route::get('/peta', [PetaController::class, 'index'])->name('peta.index');

Route::prefix('dashboard')->as('admin.')->group(function () {
    // route auth admin and writer
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::resource('users', UserController::class)->except('create', 'edit');
    });

    // route auth only admin
    Route::middleware(['auth', 'role:admin'])->group(function () {});

    // route auth all
    Route::group(['middleware' => ['auth', 'role:admin,user']], function () {});
});


// route auth all
Route::middleware(['auth', 'role:admin,user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/blank', [DashboardController::class, 'index2'])->name('dashboard');

    Route::get('/admin', function () {
        return redirect('/dashboard');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require_once __DIR__ . '/auth.php';
