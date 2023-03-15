<?php


Route::group(['prefix' => 'admin/admin_dashboard', 'middleware' => ['admin','web']], function() {

    Route::get('/home', 'AdminController@admin_index');
    Route::get('/all_users', 'AdminController@all_user');
    Route::get('/withdrawal-history', 'AdminController@getWithdrawalHistory');
    Route::get('/deposit-history', 'AdminController@getDepositHistory');

    Route::post('/search_user', 'AdminController@search_user');
    Route::get('/user_profile/{id}','AdminController@user_profile');
    Route::post('/update_profile/{id}', 'AdminController@update_profile');
    Route::get('/delete_profile/{id}', 'AdminController@delete_profile');

    Route::get('/approve/{id}', 'AdminController@approveRequest');
    Route::get('/disapprove/{id}', 'AdminController@cancleRequest');

    Route::get('/add_funds/{id}', 'AdminController@add_funds');
    Route::post('/add_funds_user', 'AdminController@add_funds_user');

    Route::post('/change_status/{id}','AdminController@change_status');
    Route::post('/change_user_password/{id}','AdminController@change_user_password');
    Route::get('/user_financial_details/{id}','AdminController@user_financial_details');
    Route::post('/add_profit', 'AdminController@addProfit')->name('add_deposit_profit');
});
