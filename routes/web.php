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

//Authentication Routes
Auth::routes();


Route::get('/admin', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::get('/articles', 'ArticleController@index')->name('articles')->middleware('auth');

Route::get('/{name}', function () {
    return view('StudentPage.home' , [
        'assignments' => \App\Assignment::take(5)->latest()->get()
    ]);
})->where('name', 'home||')->name('Home')->middleware('auth');

//Profile Routes
Route::get('/profile/{id?}', 'UserController@show')->name('profile')->middleware('auth');


//Leaderboard Routes
Route::get('/leaderboard', function () {
    return view('StudentPage.leaderboard');
})->name('Leaderboard')->middleware('auth');


//Teacher routes
Route::namespace('Teacher')->prefix('teacher')->name('teacher.')->middleware('auth')->group(function () {
    Route::resource('/', 'TeacherController', ['except' => ['show', 'create', 'store']]);
    Route::resource('/progress', 'ProgressController', ['except' => ['show', 'create', 'store']]);
});



Route::group(array('prefix' => 'assignment'), function () {
    Route::group(array('prefix' => 'editor'), function () {
        //replace test and test2 with better names
        // assignment/editor/test2
        Route::resource('currentPage/{assignmentID}/page', 'PageEditorController', [
            'as' => 'editor'
        ])->middleware('auth');
        Route::resource('current', 'AssignmentEditorController', ['parameters' => [
            'current' => 'assignment',
        ]])->middleware('auth');
    });
    // assignment/view

    Route::resource('view/{assignmentID}/page', 'PageController',
        ['parameters' => ['page' => 'assignment'
        ]])->middleware('auth');
    Route::resource('view', 'AssignmentController',
        ['parameters' => ['view' => 'assignment'
        ]])->middleware('auth');
});


//Jochems zn meuk
Route::get('DokSTestingStuffDontTouch', function () {
    session()->regenerate();
    return response()->json([
        "token" => csrf_token()],
        200);
})->name('home')->middleware('auth');

Route::resource('current', "AssignmentEditorController")->middleware('auth');

// Routes for GLOBE (AssignmentPage)
Route::get('/globe', function () {
    return view('AssignmentPage.globe');
})->name('Globe')->middleware('auth');
