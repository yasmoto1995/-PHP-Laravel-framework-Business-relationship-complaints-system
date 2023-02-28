<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\StudentsController;
use Illuminate\Support\Facades\Route;

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


Route::prefix('email')->middleware('auth:admin')->group(function () {
    Route::get('verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');
    Route::get('verify/send', [EmailVerificationController::class, 'send'])->name('verification.send')->middleware('throttle:6,1');
    Route::get('verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify')->middleware('throttle:6,1');
});

Route::get('cms/admin/login', [AuthController::class, 'showlogin'])->name('auth.login')->middleware('guest:admin');
Route::post('cms/admin/login', [AuthController::class, 'login'])->name('authentica.login')->middleware('guest:admin');


Route::prefix('cms/admin')->middleware('auth:admin', 'verified')->group(function () {

    Route::get('/',[StudentsController::class,'index'])->name('students.index');
    Route::get('/{student}/edit',[StudentsController::class,'edit'])->name('students.edit');
    Route::put('/{student}',[StudentsController::class,'update'])->name('students.update');
    Route::resource('admin', AdminController::class);
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout')->withoutMiddleware('verified');
});


Route::prefix('/')->group(function () {
    Route::get('/', [StudentsController::class, 'create'])->name('students.create');
    Route::post('/', [StudentsController::class, 'store'])->name('students.store');
    Route::get('search', [StudentsController::class, 'search'])->name('students.search');
    Route::post('show', [StudentsController::class, 'show'])->name('students.show');
});
