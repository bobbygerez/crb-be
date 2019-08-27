<?php

Route::post('login', 'Auth\LoginController@login');
Route::get('/verify-user/{code}', 'Auth\RegisterController@activateUser');

Route::group(['namespace' => 'Auth', 'prefix' => 'password'], function () {
    Route::post('create', 'ResetPasswordController@create');
    Route::get('find/{token}', 'ResetPasswordController@find');
    Route::post('reset', 'ResetPasswordController@reset');
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');
    Route::resource('users', 'Api\User\UserController');
    Route::resource('roles', 'Api\Role\RoleController');

    Route::resource('menus', 'Api\Menu\MenuController');
    Route::resource('dashboard_categories', 'Api\Category\DashboardCategoryController');
    Route::resource('dashboard_menus', 'Api\Menu\DashboardMenuController');
    Route::resource('chart_accounts', 'Api\ChartAccount\ChartAccountController');
    Route::resource('company_chart_accounts', 'Api\ChartAccount\CompanyChartAccountController');
    Route::resource('access_rights', 'Api\AccessRight\AccessRightController');
    Route::get('search-menus', 'Api\Menu\DashboardMenuController@search');

    Route::resource('branches', 'Api\Branch\BranchController');
    Route::post('users/change-password', 'Api\User\UserController@changePassword');

    Route::resource('branches', 'Api\Branch\BranchController');
    Route::post('users/change-password', 'Api\User\UserController@changePassword');

});

Route::resource('dashboard_role', 'Api\Role\DashboardRoleController');
Route::get('provinces', 'Api\Places\PlacesController@provinces');
Route::get('cities/{provinceId}', 'Api\Places\PlacesController@cities');
Route::get('brgys/{cityId}', 'Api\Places\PlacesController@brgys');
Route::resource('categories', 'Api\Category\CategoryController');
Route::get('products/{id}', 'Api\Product\ProductController@show');
Route::resource('products', 'Api\Product\ProductController');
Route::resource('category_products', 'Api\Product\CategoryProductController');
Route::resource('loans', 'Api\Loan\LoanController');
Route::post('loan_processing', 'Api\Loan\LoanController@processing');
Route::post('loan_approval', 'Api\Loan\LoanController@approval');
Route::post('loan_release', 'Api\Loan\LoanController@release');
Route::post('loan_amortization/{id}', 'Api\Loan\LoanController@amortizationSchedule');

// LOAN SETUP
Route::resource('account', 'Api\MasterSetup\AccountController');
Route::resource('officer', 'Api\MasterSetup\OfficerController');
Route::resource('collector', 'Api\MasterSetup\CollectorController');
Route::resource('center', 'Api\MasterSetup\CenterController');
Route::resource('group', 'Api\MasterSetup\GroupController');

// LOAN INFORMATION
Route::get('view_ledger/{id}', 'Api\Loan\InformationController@showLedger');
Route::get('view_information/{id}', 'Api\Loan\InformationController@showLoanInfo');
Route::get('loan_amortization/{id}', 'Api\Loan\InformationController@showAmortization');
Route::get('loan_amortization_status/{id}', 'Api\Loan\InformationController@showAmortizationStatus');

//epoy
Route::resource('lmmcategories', 'Api\MasterSetup\lmmCategoryController'); //creat loan categories
Route::resource('loan_code', 'Api\MasterSetup\LoanCodeController'); //create loan code
Route::get('lmmcategories/{id}', 'Api\MasterSetup\lmmCategoryController@show'); //display all category from parent
Route::get('loan_code/{id}', 'Api\MasterSetup\LoanCodeController@show');
