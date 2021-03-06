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

//Route::get('/admin', function () {
//    return view('home');
//})->name('home')->middleware('auth');

// Article routes
Route::resource('article' , 'ArticleController');
Route::get('/articles', 'ArticleController@index')->name('articles')->middleware('auth');
//
Route::get('/{name}', function () {
    return view('home.home', [
        'assignments' => \App\Assignment::paginate(5),
        'articles' => \App\Article::take(4)->latest()->get()
    ]);
})->where('name', 'home||')->name('Home')->middleware('auth');

//Route::resource('/articles', 'ArticleController');
//Route::get('/articles', 'ArticleController@index');
//Route::post('/article/create', 'ArticleController@store');
//Route::post('/articles', 'ArticleController@store');
//Route::get('/article/create', 'ArticleController@create');



//Profile Routes
Route::get('/profile/{id?}', 'UserController@show')->name('profile')->middleware('auth');

//unused should get removed
//Route::get('test', function () {
//    return view('draganddrop');
//});



//Leaderboard Routes
Route::resource('/leaderboard', 'LeaderboardController', ['except' => ['show', 'update', 'edit', 'create']]);


//Teacher routes
Route::namespace('Teacher')->prefix('teacher')->name('teacher.')->middleware('auth')->group(function () {
    Route::resource('/', 'TeacherController', ['except' => ['show', 'create', 'store']]);
    Route::resource('/progress', 'ProgressController', ['except' => ['show', 'create', 'store']]);
    Route::resource('/courses', 'CoursesController', ['except' => ['show', 'update', 'edit', 'create']]);
});

//Administration routes
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('/teachers', 'AdminController', ['except' => ['show', 'edit']]);
});

Route::group(array('prefix' => 'assignment'), function () {
    Route::group(array('prefix' => 'editor'), function () {
        Route::resource('currentPage/{assignmentID}/page', 'PageEditorController', [
            'as' => 'editor', 'parameters' => [
                'assignmentID' => 'assignment', 'page' => 'page']
        ])->middleware('auth');
        // Route for creating new assignment via form
        Route::resource('current', 'AssignmentEditorController', ['parameters' => [
            'current' => 'assignment',],
            'as' => 'editor'])->middleware('auth');

        Route::resource('currentElement/{assignment}/page/{page}/element', 'ElementController')->middleware('auth');
    });

    //element/create

    // assignment/view

    Route::resource('view/{assignmentID}/page', 'PageController',
        ['parameters' => ['page' => 'assignment'
        ]])->middleware('auth');
    Route::resource('view', 'AssignmentController',
        ['parameters' => ['view' => 'assignment'
        ]])->middleware('auth');
});



//unused should get removed
//Route::get('DokSTestingStuffDontTouch', function () {
//    session()->regenerate();
//    return response()->json([
//        "token" => csrf_token()],
//        200);
//})->name('home')->middleware('auth');

//unused should get removed
//Route::resource('current', "AssignmentEditorController")->middleware('auth');

// Routes for GLOBE and COUNTRIES(AssignmentPage)
Route::get('/globe', function () {
    return view('assignmentPage.globe');
})->name('Globe')->middleware('auth');

Route::resource('countries', 'CountryController')->middleware('auth');

//test countries foreach
Route::get('/{country}', 'CountryController@show')->name('country')->middleware('auth');


