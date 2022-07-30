<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerijinanController;
use App\Http\Controllers\StatusPerijinanController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
p| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/', [AuthController::class, 'loginPage'])->name('index');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/login', [AuthController::class, 'loginPage'])->name('loginPage');
Route::post('/register-process', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//route group middleware auth
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [AuthController::class, 'home'])->name('home');

    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::patch('/profile', [AuthController::class, 'profile_update'])->name('profile.update');
    Route::patch('/profile/change-password', [AuthController::class, 'change_password'])->name('profile.password');

    Route::get('/permohonan-perijinan', [PerijinanController::class, 'index'])->name('pp.index');
    Route::get('/permohonan-perijinan/add', [PerijinanController::class, 'create'])->name('pp.create');
    Route::post('/permohonan-perijinan/add', [PerijinanController::class, 'store'])->name('pp.store');
    Route::get('/permohonan-perijinan/edit/{perijinan_id}', [PerijinanController::class, 'edit'])->name('pp.edit');
    Route::patch('/permohonan-perijinan/edit/{perijinan_id}', [PerijinanController::class, 'update'])->name('pp.update');
    Route::delete('/permohonan-perijinan/delete/{perijinan_id}', [PerijinanController::class, 'delete'])->name('pp.delete');
    
        Route::group(['middleware' => 'superadmin'], function () {
            Route::get('/user', [UserController::class, 'index'])->name('user.index');
            Route::delete('/user/delete/{user_id}', [UserController::class, 'delete'])->name('user.delete');
        });
        
        //role admin and superadmin
        // Route::group(['middleware' => 'admin'], function () {
            Route::get('/semua-perijinan', [StatusPerijinanController::class, 'index'])->name('sp.index');
            Route::get('/permohonan-perijinan/show/{perijinan_id}', [StatusPerijinanController::class, 'show'])->name('pp.show');
            Route::patch('/permohonan-perijinan/acc/{perijinan_id}', [StatusPerijinanController::class, 'acc'])->name('pp.acc');
            Route::put('/permohonan-perijinan/rej/{perijinan_id}', [StatusPerijinanController::class, 'rej'])->name('pp.rej');
        // });
        
        Route::get('/permohonan-perijinan/pdf/{perijinan_id}', [PerijinanController::class, 'pdf_single'])->name('pdf.single');
        Route::get('/status-perijinan/acc/pdf/', [StatusPerijinanController::class, 'pdf_acc'])->name('pdf.acc'); 
    // Route::get('/pdf/{perijinan_id}', [PerijinanController::class, 'pdf1'])->name('pp1.pdf');
});
