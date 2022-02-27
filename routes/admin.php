<?php

use GuzzleHttp\Middleware;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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


Route::group(
    [
        
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ 
    

        Route::group(['middleware'=>'auth:admin', 'namespace'=>'admin' ,'prifex'=>'admin' ] ,function(){

            Route::get('/home','DashboradController@index')->name('dashborad.index');

            Route::group(['prifex'=>'setting'],function(){
                
                Route::get('/shipping/{type}','SettingController@editShipping')->name('shipping.edit');
                Route::post('/shipping/{id}','SettingController@updateShipping')->name('shipping.update');

            });
            

        });

        ###################### login route ##########

        Route::prefix('admin')->group(function () {
            Route::get('login','admin\loginController@login')->name('admin.login');
            Route::post('login','admin\loginController@postLogin')->name('admin.post.login');
        });
        

        ###################### login route ##########

    });







// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
