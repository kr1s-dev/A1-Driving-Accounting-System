<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    //return view('welcome');
    return Redirect::to('/login');
});
Route::auth();
//Verification of newly created user
Route::get('auth/verify/{token}', ['as'=>'verify','uses' => 'RegisterVerifier\RegisterVerifierController@getVerifier']);
Route::post('auth/verify', ['as'=>'verify','uses' => 'RegisterVerifier\RegisterVerifierController@postVerifier']);

// Uses authentication middleware, to avoid uneccessary access if not login
Route::group(['middleware' => 'auth'], function () {

	//Admin Dashboard Routes
	Route::get('admin-dashboard',['as'=>'admin-dashboard','uses'=>'AdminDashboard\AdminDashboardController@getAdminDashboard']);

	//Branch Routes
	Route::resource('branches','Branches\BranchController');

	//User Routes
	Route::resource('user','Users\UserController');
	Route::get('user/resetpassword/{id}', ['as'=>'user.resetpassword','uses' => 'Users\UserController@sendUserResetLinkEmail']);
	Route::get('user/changepassword/{id}', ['as'=>'user.changepassword','uses' => 'Users\UserController@getChangePassword']);
	Route::post('user/changepassword', 'Users\UserController@postChangePassword');

	//Students Routes
	Route::resource('students','Students\StudentController');

	//Invoice Routes
	Route::resource('invoice','Invoices\InvoiceController',['except'=>['destroy']]);
	Route::get('student/{id}/invoice', ['as'=>'student.invoice','uses'=>'Invoices\InvoiceController@create']);

	//Expense Routes
	Route::resource('expense','Expenses\ExpenseController');

	//Receipt Routes
	Route::resource('receipt','Receipt\ReceiptController');
	Route::get('receipt/{id}/create', ['as'=>'invoice.receipt.create','uses'=>'Receipt\ReceiptController@create']);

	//Asset Routes
	Route::resource('asset','Assets\AssetController');

	//Account Title Routes
	Route::resource('accounttitle','AccountTitles\AccountTitleController');
	Route::get('accounttitle/{id}/create',['as'=>'accounttitle.with.parent.accounttitle','uses'=>'AccountTitles\AccountTitleController@createWithParent']);
	Route::get('accounttitle/{id}/group/create',['as'=>'accounttitle.with.parent.accountgroup','uses'=>'AccountTitles\AccountTitleController@createWithGroupParent']);

	//Item Routes
	Route::resource('item','InvExpItem\InvoiceExpenseItemsController',['except'=>['index']]);
	Route::get('item/{id}/create',['as'=>'item.create','uses'=>'InvExpItem\InvoiceExpenseItemsController@create']);

	//Journal Entry Routes
    Route::get('journal/create' ,['as'=>'journal.create','uses'=>'Journal\JournalEntryController@getJournalEntry']);
    Route::get('journal/adjustment/create' ,['as'=>'adjustment.create','uses'=>'Journal\JournalEntryController@getAdjustmenstEntry']);
    Route::post('journal/create' ,'Journal\JournalEntryController@store');
    Route::get('journal' ,['as'=>'journal.index','uses'=>'Journal\JournalEntryController@index']);

    //Acount Information Route
    Route::get('account/details' ,['as'=>'account.details','uses'=>'AccountInformation\AccountInformationController@index']);

    //Report viewing
    Route::get('reports/incomestatement',['as'=>'incomestatement','uses'=>'Reports\ReportController@getGenerateIncomeStatement']);
    Route::post('reports/incomestatement','Reports\ReportController@postGenerateIncomeStatement');
    Route::get('reports/ownersequitystatement',['as'=>'ownersequity','uses'=>'Reports\ReportController@getGenerateOwnersEquityStatement']);
    Route::post('reports/ownersequitystatement','Reports\ReportController@postGenerateOwnersEquityStatement');
    Route::get('reports/balancesheet',['as'=>'balancesheet','uses'=>'Reports\ReportController@getGenerateBalanceSheet']);
    Route::post('reports/balancesheet','Reports\ReportController@postGenerateBalanceSheet');
    Route::get('reports/assets',['as'=>'asset.registry','uses'=>'Reports\ReportController@getGenerateAssetRegistry']);

    //PDF Generation
    Route::post('pdf','PDF\PDFController@postGeneratePDF');
});
