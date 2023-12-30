<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [IndexController::class, 'home']);
Route::get('/dich-vu', [IndexController::class, 'dichvu'])->name('dichvu'); // tat ca dịch vụ
Route::get('/dich-vu/{slug}', [IndexController::class, 'dichvucon'])->name('dichvucon'); //dịch vụ con thuộc dịch vụ

Route::get('/danh-muc', [IndexController::class, 'danhmuc'])->name('danhmuc'); // tat ca danh muc
Route::get('/danh-muc/{slug}', [IndexController::class, 'danhmuccon'])->name('danhmuccon');//dịch vụ con thuộc danh muc


//Category
Route::resource('/category', CategoryController::class); //resource: gồm thêm sửa xóa cập nhật

// Authentication
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

