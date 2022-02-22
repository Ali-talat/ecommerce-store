<?php

use GuzzleHttp\Middleware;
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


###################### there is prifex admin for this file ##########

Route::group(['middleware'=>'auth:admin', 'namespace'=>'admin'] ,function(){

    Route::get('/home','DashboradController@index')->name('dashborad.index');
});
Route::get('login','admin\loginController@login')->name('admin.login');
Route::post('login','admin\loginController@postLogin')->name('admin.post.login');








// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
