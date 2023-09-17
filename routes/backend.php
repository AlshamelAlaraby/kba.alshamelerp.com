<?php

use \Illuminate\Routing\Router;

Route::group(['namespace' => 'Auth', 'as' => 'backend.'], function (Router $router) {
    $router->get('login', 'LoginController@showLoginForm')->name('show.login.form');
    $router->post('login', 'LoginController@login')->name('auth.login');
    $router->get('logout', 'LoginController@logout')->name('auth.logout');
});

Route::group(['middleware' => ['auth:admin'], 'as' => 'backend.'], function (Router $router) {
    $router->get('/', 'HomeController@index')->name('home');
    $router->get('migrate', 'HomeController@migrate')->name('migrate');
    $router->post('importCategories', 'ExcelController@importCategories')->name('importCategories');
    $router->get('setting', array('as' => 'settings.edit', 'uses' => 'SettingController@index'));
    $router->post('setting/edit', array('as' => 'settings.update', 'uses' => 'SettingController@update'));
    $router->get('clubs', 'HomeController@getClubList')->name('getClubList');
    $router->get('player', 'HomeController@getPlayerList')->name('getPlayerList');
    $router->get('refereeslist', 'HomeController@getRefereeList')->name('getRefereeList');

    Route::group(['middleware' => 'authorize'], function (Router $router) {
        $router->resource('roles', 'RoleController')->except('show');
        $router->resource('admins', 'AdminController')->except('show');
        $router->resource('category', 'CategoryController')->except('show');
        $router->resource('imglookups', 'ImgLookupController')->except('show');
        $router->resource('regions', 'RegionController')->except('show');
        $router->resource('nationality', 'NationalityController')->except('show');
        $router->resource('groups', 'GroupController')->except('show');
        $router->resource('status', 'StatusController')->except('show');
        $router->resource('degrees', 'DegreeController')->except('show');
        $router->resource('family', 'FamilyController')->except('show');
        $router->resource('sessions', 'SessionController')->except('show');
        $router->resource('championships', 'ChampionshipController')->except('show');
        $router->resource('matches', 'MatcheController');
        //$router->resource('payments', 'PaymentController')->except('show');
        $router->resource('members', 'MemberController');
        $router->resource('loans', 'LoanController')->except('show');
        $router->resource('escalations', 'EscalationController')->except('show');
        $router->resource('banks', 'BankController')->except('show');
        $router->resource('refrees', 'RefreeController');
        $router->resource('salaries', 'SalaryController')->except('show');
        //$router->any('payment/{member_id?}', 'MemberController@addPayment')->name('members.addPayment');
        $router->get('report/members', 'ReportController@getMembers')->name('members.getMembersReport');
    });

});
