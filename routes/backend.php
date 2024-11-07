<?php
use Illuminate\Support\Facades\Route;

//file
Route::prefix('file')->as('file')->group(function () {
    Route::get('stream/{id}/{name}', "FileController@getFile");
    Route::get('download/{id}/{name}', "FileController@downloadFile");
    Route::get('delete/{id}/{name}', "FileController@deleteFile");
    Route::post('upload-image-editor', 'FileController@handleEditorImageUpload');
});

Route::group(['middleware'=>['role:Admin|Super Admin']], function () {
    Route::get('/home', "DashboardController@index")->name('home');
    Route::post('/sorted', "MenuController@sorted")->name('menu.sorted');
    //menus
    Route::prefix('menu')->as('menu')->group(function () {
        Route::get('/data', "MenuController@data");
        Route::get('delete/{id}', "MenuController@delete");
    });
    Route::resource('menu', "MenuController");
    //users
    Route::prefix('users')->as('users')->group(function () {
        Route::get('/data', "UserController@data");
        Route::get('delete/{id}', "UserController@delete");
    });
    Route::resource('users', "UserController");
    //roles
    Route::resources(['roles' => RoleController::class]);
    //berita
    Route::prefix('berita')->as('berita')->group(function () {
        Route::get('delete/{id}', 'BeritaController@delete');
    });
    Route::resource('berita', 'BeritaController');

//gencrud
});