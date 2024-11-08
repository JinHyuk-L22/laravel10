<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(\App\Http\Controllers\HomeController::class)->group(function() {
    Route::get('/', 'index')->name('main');
//    Route::get('intro', 'intro')->name('main.intro');
    // Route::post('data', 'data')->name('main.data');

    // if (isDev()) {
    //     Route::get('test', 'test')->name('main.test');
    // }
});

// Route::middleware('guest')->prefix('member')->controller(\App\Http\Controllers\Member\LoginController::class)->group(function() {
Route::prefix('member')->controller(\App\Http\Controllers\Member\LoginController::class)->group(function() {
    Route::match(['get', 'post'], 'login', 'login')->name('member.login');
    Route::post('logout', 'logout')->name('member.logout');
});

Route::prefix('lib')->controller(\App\Http\Controllers\Lib\LibController::class)->group(function(){

    Route::get('rowspan', 'rowspan')->name('lib.rowspan');

});

Route::prefix('bbs/{bbs_name}')->controller(\App\Http\Controllers\Bbs\BbsController::class)->group(function(){
    
    Route::get('', 'list')->name('bbs.list');
    Route::get('post/{sid?}', 'post')->name('bbs.post');
    Route::get('{sid/show}', 'show')->name('bbs.show');

    Route::post('data', 'data')->name('bbs.data');
    Route::get('down', 'down')->name('bbs.down');

});

Route::prefix('file')->controller(\App\Http\Controllers\FileController::class)->group(function(){
    Route::post('upload/{path}', 'upload')->name('file.upload');
});
