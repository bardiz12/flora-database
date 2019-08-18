<?php

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
/*Route::group(['prefix' => 'api','middleware'=>'delay'], function () {
    
});*/
Route::group(['prefix'=>'admin'],function(){
    Route::group(['middleware'=>['auth'],'as'=>'admin.'],function(){
        Route::get('/','AdminController@index')->name('index');
        Route::group(['prefix'=>'family','as'=>'family.'],function(){
            Route::get('/','FamilyController@index')->name('index');
            Route::get('/trash/{id}','FamilyController@toggleTrash')->name('trash');
            Route::get('/new','FamilyController@create')->name('create');
            Route::post('/edit','FamilyController@store')->name('store');
        });

        Route::group(['prefix'=>'flora','as'=>'flora.'],function(){
            Route::get('/','FloraController@index')->name('index');
            Route::get('/new','FloraController@create')->name('create');
            Route::post('/store','FloraController@store')->name('store');
            Route::post('/delete','FloraController@delete')->name('delete');
        });

        Route::group(['prefix'=>'status','as'=>'status.'],function(){
            Route::get('/','StatusController@index')->name('index');
            Route::get('/trash/{id}','StatusController@toggleTrash')->name('trash');
            Route::get('/new','StatusController@create')->name('create');
            Route::post('/edit','StatusController@store')->name('store');
        });

        Route::group(['prefix'=>'kategori','as'=>'kategori.'],function(){
            Route::get('/','KategoriController@index')->name('index');
            Route::get('/trash/{id}','KategoriController@toggleTrash')->name('trash');
            Route::get('/new','KategoriController@create')->name('create');
            Route::post('/edit','KategoriController@store')->name('store');
        });

        Route::group(['prefix'=>'import','as'=>'import.'],function(){
            Route::get('/','CsvController@index')->name('index');
            Route::post('/','CsvController@store')->name('store');
        });

        
    });
    

    Auth::routes(['register'=>false]);
});
Route::get('/{any}', 'SPAController@index')->where('any','.*');

