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
                
                Route::get('/','CategoryController@index')->name('category.index');
                Route::get('/create','CategoryController@create')->name('category.create');
                Route::post('/store','CategoryController@store')->name('category.store');
                Route::get('/edit/{id}','CategoryController@edit')->name('category.edit');
                Route::post('/update/{id}','CategoryController@update')->name('category.update');
                Route::get('/delete/{id}','CategoryController@delete')->name('category.delete');


            });
             ###################### end categorys route ##########


            


             ###################### start brands route ################################

            Route::group(['prefix'=>'brands'],function(){
                
                Route::get('/','BrandsController@index')->name('brand.index');
                Route::get('/create','BrandsController@create')->name('brand.create');
                Route::post('/store','BrandsController@store')->name('brand.store');
                Route::get('/edit/{id}','BrandsController@edit')->name('brand.edit');
                Route::post('/update/{id}','BrandsController@update')->name('brand.update');
                Route::get('/delete/{id}','BrandsController@delete')->name('brand.delete');


            });
             ###################### start tags route ##################################


             Route::group(['prefix'=>'tags'],function(){
                
                Route::get('/','TagController@index')->name('tag.index');
                Route::get('/create','TagController@create')->name('tag.create');
                Route::post('/store','TagController@store')->name('tag.store');
                Route::get('/edit/{id}','TagController@edit')->name('tag.edit');
                Route::post('/update/{id}','TagController@update')->name('tag.update');
                Route::get('/delete/{id}','TagController@delete')->name('tag.delete');


            });
             ###################### end tags route ##################################

              ###################### start products route ##################################


              Route::group(['prefix'=>'product'],function(){
                
                Route::get('/','ProductController@index')->name('product.index');
                Route::get('/create','ProductController@create')->name('product.create');
                Route::get('/store','ProductController@store')->name('product.store');

                Route::get('/create/price/{id}','ProductController@createPrice')->name('product.price.create');
                Route::post('/store/price/{id}','ProductController@storePrice')->name('product.price.store');
                Route::get('/create/stock/{id}','ProductController@createStock')->name('product.stock.create');
                Route::post('/store/stock/{id}','ProductController@storeStock')->name('product.stock.store');
                Route::get('/create/image/{id}','ProductController@createimage')->name('product.image.create');
                Route::post('/save/image/{id}','ProductController@saveImage')->name('product.image.save');
                Route::post('/store/image/{id}','ProductController@storeImage')->name('product.image.store');

                Route::get('/edit/{id}','ProductController@edit')->name('product.edit');
                Route::post('/update/{id}','ProductController@update')->name('product.update');
                Route::get('/delete/{id}','ProductController@delete')->name('product.delete');

                Route::group(['prefix'=>'option'],function(){
                
                    Route::get('/','OptionController@index')->name('product.option.index');
                    Route::get('/create/{id}','OptionController@create')->name('product.option.create');
                    Route::post('/store','OptionController@store')->name('product.option.store');
                    Route::get('/edit/{id}','OptionController@edit')->name('product.option.edit');
                    Route::post('/update/{id}','OptionController@update')->name('product.option.update');
                    Route::get('/delete/{id}','OptionController@delete')->name('product.option.delete');
    
    
                });


            });
             ###################### end products route ##################################


              ###################### start attribute route ##################################


              Route::group(['prefix'=>'attribute'],function(){
                
                Route::get('/','AttributeController@index')->name('attribute.index');
                Route::get('/create','AttributeController@create')->name('attribute.create');
                Route::post('/store','AttributeController@store')->name('attribute.store');
                Route::get('/edit/{id}','AttributeController@edit')->name('attribute.edit');
                Route::post('/update/{id}','AttributeController@update')->name('attribute.update');
                Route::get('/delete/{id}','AttributeController@delete')->name('attribute.delete');


            });
             ###################### end attribute route ##################################


             ###################### start attribute route ##################################


             Route::group(['prefix'=>'option'],function(){
                
                Route::get('/','OptionController@index')->name('option.index');
                Route::get('/create','OptionController@create')->name('option.create');
                Route::post('/store','OptionController@store')->name('option.store');
                Route::get('/edit/{id}','OptionController@edit')->name('option.edit');
                Route::post('/update/{id}','OptionController@update')->name('option.update');
                Route::get('/delete/{id}','OptionController@delete')->name('option.delete');


            });
             ###################### end option route ##################################


             

            

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
