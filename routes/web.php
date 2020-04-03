<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>['auth']],function(){
    Route::group(['prefix'=>'admin','as'=>'admin.','namespace'=>'Admin','middleware' => ['auth','admin']], function () {
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
//        Route::get('/user', 'UserController@index')->name('user');
    });
    Route::group(['prefix'=>'employee','as'=>'employee.','namespace'=>'Employee','middleware' => ['auth','employee']], function () {
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    });
});
Route::get('/posts', 'ckEditorController@index')->name('allpost');
Route::get('/blogs', 'ckEditorController@create')->name('blogs');
Route::post('/store/blog','ckEditorController@store')->name('storeblog');
Route::get('/blog/{id}', 'ckEditorController@show')->name('blog');
Route::get('/edit/blog/{id}','ckEditorController@edit')->name('edit');
Route::post('/update/blog/{id}', 'ckEditorController@update')->name('updateblog');
Route::post('ckeditor/image_upload', 'CKEditorController@upload')->name('upload');
