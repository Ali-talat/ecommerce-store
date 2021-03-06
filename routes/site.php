<?php

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

Route::group(
    [
        
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){ 
    
        
        Route::group(['middleware'=>'auth:user' , 'prefix'=>'site'],function(){
            

            Route::get('xx',function(){
                return 'yes';
            });
            
        });
        Route::get('logout','Auth\LoginController@logout')->name('logout');
        Route::get('/','front\SiteController@index')->name('site.index');


        Route::group(['middleware'=>'guest' , 'namespace'=> 'Auth','prefix'=>'site'],function(){
            // Route::get('login','LoginController@showLoginForm')->name('login');
            // Route::post('login','loginController@login')->name('front.post.login');

            
        });

        


    });






// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
