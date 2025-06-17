<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\AdminController;

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
    return view('main.index');
});

Route::resource('users', UserController::class);
Route::resource('boards', BoardController::class);
Route::resource('admins', AdminController::class);
Route::resource('files', FileController::class);


//중복확인 메소드
Route::post('/check-user-id', [UserController::class, 'checkUserId']); 
//로그인
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


// 파일 삭제 별도 선언 (resource 에서 destroy 포함되어 있지만, 명확히 쓰는 것도 OK)
Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.destroy');

Route::put('/attrChange/{id}', [AdminController::class, 'attrChange'])->name('attrChange');

Route::put('/admins/resetPassword/{id}', [AdminController::class, 'resetPassword'])->name('admins.resetPassword');
