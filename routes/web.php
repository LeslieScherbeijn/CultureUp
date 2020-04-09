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

Auth::routes();

Route::get('/', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::get('/assignments', function() {
    return view('cases_proto');
})->name('cases_proto')->middleware('auth');

Route::get('/student', function() {
    return view('StudentPage.home');
})->name('Home')->middleware('auth');

Route::get('/logout', function() {
    Auth::logout();
    return view('home');
})->name('home')->middleware('auth');

//Route::resource('test', 'PageController');

Route::group(array('prefix' => 'assignment'), function() {
    Route::group(array('prefix' => 'editor'), function() {
        //replace test and test2 with better names
        Route::resource('test/{assignmentID}/page', 'PageEditorController')->middleware('auth');
        Route::resource('test2', 'AssignmentController')->middleware('auth');
    });
    Route::resource('view/{assignmentID}/page', 'PageController')->middleware('auth');
});



