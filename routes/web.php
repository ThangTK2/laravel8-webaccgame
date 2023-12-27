<?php

use App\Http\Controllers\IndexController;
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
Route::get('/dich-vu', [IndexController::class, 'dichvu'])->name('dichvu'); // dịch vụ
Route::get('/dich-vu/{slug}', [IndexController::class, 'dichvucon'])->name('dichvucon'); //dịch vụ con thuộc dịch vụ
