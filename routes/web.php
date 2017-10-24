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

Route::middleware('web')->group(function () {

    Route::match(['get', 'post'], '/', ['uses'=>'IndexController@execute', 'as'=>'home']);
    Route::get('/page/{alias}', ['uses'=>'PageController@execute', 'as'=>'page']);

    Route::auth();

});

// admin/service
Route::prefix('admin')->middleware('auth')->group(function () {

    // admin
    Route::get('/', function () {

        $data = ['title' => 'Панель Адмиистратора'];

        return view('admin.index', $data);
    });

    // admin/pages
    Route::prefix('pages')->group(function () {

        // admin/pages
        Route::get('/', ['uses'=>'PagesController@execute', 'as'=>'pages']);

        // admin/pages/add
        Route::match(['get', 'post'], '/add', ['uses'=>'PagesAddController@execute', 'as'=>'pagesAdd']);
        // admin/pages/edit/2
        Route::match(['get', 'post', 'delete'], '/edit/{page}', ['uses'=>'PagesEditController@execute', 'as'=>'pagesEdit']);

    });

    // admin/portfolios
    Route::prefix('portfolios')->group(function () {

        // admin/portfolios
        Route::get('/', ['uses'=>'PortfolioController@execute', 'as'=>'portfolio']);

        // admin/portfolios/add
        Route::match(['get', 'post'], '/add', ['uses'=>'PortfolioAddController@execute', 'as'=>'portfolioAdd']);
        // admin/portfolios/edit/2
        Route::match(['get', 'post', 'delete'], '/edit/{portfolio}', ['uses'=>'PortfolioEditController@execute', 'as'=>'portfolioEdit']);

    });

    // admin/services
    Route::prefix('services')->group(function () {

        // admin/services
        Route::get('/', ['uses'=>'ServiceController@execute', 'as'=>'services']);

        // admin/services/add
        Route::match(['get', 'post'], '/add', ['uses'=>'ServiceAddController@execute', 'as'=>'serviceAdd']);
        // admin/services/edit/2
        Route::match(['get', 'post', 'delete'], '/edit/{service}', ['uses'=>'ServiceEditController@execute', 'as'=>'serviceEdit']);

    });

});

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
