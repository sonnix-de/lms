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

Route::get('/', function () {return view('welcome');})->name('welcome');

Auth::routes();


// die Backend-Routen
Route::group(['prefix' => '/lms', 'as' => 'lms-' ], function()
{
    Route::get('/', 'LmsController@index')->name('start');
    Route::get('/medien', 'MedienController@index')->name('medien');
    Route::get('/ausleihen', 'AusleihenController@index')->name('ausleihen');
    Route::get('/user', 'LmsController@index')->name('user');
    Route::get('/service', 'LmsController@index')->name('service');
});

// die Admin-Routen
Route::group(['prefix' => '/admin', 'as' => 'admin-' ], function()
{
    Route::get('/set-features', 'LmsController@setFeatures')->name('set-features');
    Route::get('/features/feature/{id}', 'FeatureController@edit')->name('edit-feature');
});


// dieDaten-Routen
Route::group(['prefix' => '/rest'  ], function()
{
    // medien:
    Route::get('/get/book/id/{id?}', 'MedienController@getBook')->name('restGetBook');
    Route::get('/get/books/{search?}', 'MedienController@getBooks')->name('restGetBooks');
    Route::get('/get/isbn/{isbn}', 'MedienController@getIsbnData');
    Route::post('/post/book/update', 'MedienController@updateBook');

    Route::post('/post/ausleihe', 'AusleihenController@ausleihe')->name('restAusleihe');

    // article
    Route::get('/get/page/{field}/{value}', 'ArticleController@show');


    // features 
    Route::get('/get/feature/{name}', 'FeatureController@show')->name('restGetFeature');
    Route::post('/post/feature/{name}', 'FeatureController@update')->name('restPostFeature');

    // user
    Route::get('/get/user/id/{id?}', function($id) {
        $user = App\User::find($id);
        if (!$user)
        {
            abort(404);
        }
        return  $user;
    })->name('restGetUser');;
});


