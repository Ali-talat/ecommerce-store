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






###################### there is prefix admin for this file ##########


Route::group(
    [
        
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){ 
    

        Route::group(['middleware'=>'auth:admin', 'namespace'=>'admin' ,'prefix'=>'admin' ] ,function(){

            Route::get('/home','DashboradController@index')->name('dashborad.index');


             ###################### start setting route ##########

            Route::group(['prefix'=>'setting'],function(){
                
                Route::get('/shipping/{type}','SettingController@editShipping')->name('shipping.edit');
                Route::post('/shipping/{id}','SettingController@updateShipping')->name('shipping.update');

            });

             ###################### start setting route ##########


             ###################### start profile route ##########


            Route::group(['prefix'=>'profile'],function(){
                
                Route::get('/edit/{id}','ProfileController@editProfile')->name('profile.edit');
                Route::post('/update/{id}','ProfileController@updateProfile')->name('profile.update');

            });

             ###################### end profile route ##########


             ###################### start categorys route ##########

            Route::group(['prefix'=>'category'],function(){
                
                Route::get('/','categoryController@index')->name('category.index');
                Route::get('/create','categoryController@create')->name('category.create');
                Route::post('/store','categoryController@store')->name('category.store');
                Route::get('/edit/{id}','categoryController@edit')->name('category.edit');
                Route::post('/update/{id}','categoryController@update')->name('category.update');
                Route::get('/delete/{id}','categoryController@delete')->name('category.delete');


            });
             ###################### end categorys route ##########


            


             ###################### start brands route ################################

            Route::group(['prefix'=>'brands'],function(){
                
                Route::get('/','brandsController@index')->name('brand.index');
                Route::get('/create','brandsController@create')->name('brand.create');
                Route::post('/store','brandsController@store')->name('brand.store');
                Route::get('/edit/{id}','brandsController@edit')->name('brand.edit');
                Route::post('/update/{id}','brandsController@update')->name('brand.update');
                Route::get('/delete/{id}','brandsController@delete')->name('brand.delete');


            });
             ###################### start tags route ##################################


             Route::group(['prefix'=>'tags'],function(){
                
                Route::get('/','tagController@index')->name('tag.index');
                Route::get('/create','tagController@create')->name('tag.create');
                Route::post('/store','tagController@store')->name('tag.store');
                Route::get('/edit/{id}','tagController@edit')->name('tag.edit');
                Route::post('/update/{id}','tagController@update')->name('tag.update');
                Route::get('/delete/{id}','tagController@delete')->name('tag.delete');


            });
             ###################### end tags route ##################################

              ###################### start product route ##################################


              Route::group(['prefix'=>'product'],function(){
                
                Route::get('/','ProductController@index')->name('product.index');
                Route::get('/create','ProductController@create')->name('product.create');
                Route::post('/store','ProductController@store')->name('product.store');
                Route::get('/edit/{id}','ProductController@edit')->name('product.edit');
                Route::post('/update/{id}','ProductController@update')->name('product.update');
                Route::get('/delete/{id}','ProductController@delete')->name('product.delete');


            });
             ###################### end product route ##################################
             

            

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
