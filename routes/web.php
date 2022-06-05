<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/welcome', function () {
//     return view('welcome');
// })->name('welcome');

Route::get('/underconstruction', function () {
    return view('underconstruction');
})->name('underconstruction');

Route::get('/', 'FrontProductController@index')->name('index');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/profile', 'ProfileController@index')->name('profile');
// Route::put('/profile', 'ProfileController@update')->name('profile.update');
// Route::get('/get_notification_data', 'HomeController@get_notification_data')->name('get_notification_data');
// Route::get('/get_notification_detail/{user_id}', 'HomeController@get_notification_detail')->name('get_notification_detail');
// Route::get('/notification_seen/{user_id}', 'HomeController@notification_seen')->name('notification_seen');


// Route::get('/about', function () {
//     return view('about');
// })->name('about');

// Route::group(['prefix'=>'master','as'=>'master.'], function(){
//     Route::get('/daily', ['as' => 'daily', 'uses' => 'MasterDataController@daily']);
//     Route::get('/monthly', ['as' => 'monthly', 'uses' => 'MasterDataController@monthly']);
// });

Route::group([
    'prefix'=>'user_management',
    'as'=>'user_management.'], 
        function(){
            Route::get('/', [
                'as' => 'index',
                'uses' => 'UserController@index'
            ]);
            Route::get('/index_point', [
                'as' => 'index_point',
                'uses' => 'UserController@index_point'
            ]);
            Route::post('/store', [
                'as' => 'store',
                'uses' => 'UserController@store'
            ]);
            Route::get('/update/{id}', [
                'as' => 'update',
                'uses' => 'UserController@update'
            ]);
            Route::get('/delete{id}', [
                'as' => 'delete',
                'uses' => 'UserController@delete'
            ]);
});

Route::group([
    'prefix' => 'orderreport', 
    'as' => 'orderreport.'], 
        function(){
            Route::get('/', [
                'as' => 'index',
                'uses' => 'OrderReportController@index'
            ]);
            Route::get('/get-filtered/{start}/{end}/{id}', [
                'as' => 'get-filtered',
                'uses' => 'OrderReportController@getReportDataByIdAndTime'
            ]);
});

Route::get('/getUserData/{id}','HomeController@getUserData');

Route::group([
    'prefix' => 'product', 
    'as' => 'product.'], 
        function(){
            Route::get('/', [
                'as' => 'index',
                'uses' => 'ProductController@index'
            ]);
            Route::get('/get-data', [
                'as' => 'get-data',
                'uses' => 'ProductController@getData'
            ]);
            Route::post('/store', [
                'as' => 'store',
                'uses' => 'ProductController@store'
            ]);
});

Route::group([
    'prefix' => 'category', 
    'as' => 'category.'], 
        function(){
            Route::get('/', [
                'as' => 'index',
                'uses' => 'CategoryController@index'
            ]);
            Route::post('/store', [
                'as' => 'store',
                'uses' => 'CategoryController@store'
            ]);
            Route::post('/update', [
                'as' => 'update',
                'uses' => 'CategoryController@update'
            ]);
            Route::delete('/delete', [
                'as' => 'delete',
                'uses' => 'CategoryController@delete'
            ]);
        }
);

Route::get('clear-app', function () {
    try {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        return '<pre>App Cleared !</pre>';
    } catch (Exception $e) {
        report($e);
        return '<pre>Failed to clear app.</pre>';
    }
});

Route::get('phpinfo', function (){
    return view('phpinfo');
});

Route::get('emergency-logout', function (){
    Auth::logout();
    return view('welcome');
});