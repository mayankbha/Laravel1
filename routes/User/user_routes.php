<?php


Route::get('/user/dashboard', 'HomeController@user_index');

Route::group(['prefix' => '/user'], function() {

    Route::get('/login','BasicController@login_form');
    Route::get('/register','BasicController@registration_form');
    Route::get('/logout','BasicController@user_logout');
    Route::post('/add-funds', 'UserController@addFunds');
    Route::post('/withdraw-funds', 'UserController@withdrawFunds');
    Route::get('/withdrawal-history', 'UserController@getWithdrawalHistory');
    Route::get('/fund-history', 'UserController@getDepositHistory');
    Route::get('/all-transaction', 'UserController@getAllTransaction');
    Route::get('/service-paymant-fee', 'UserController@getServicePaymentAndFees');
    Route::get('/deposite-of-trade-group', 'UserController@getDepositeOfTradeGroup');
    Route::get('/invesement-history', 'UserController@getInvesementHistory');
    Route::get('/deposit-profit-history', 'UserController@getDepositProfitHistory');
    Route::get('/referral-history', 'UserReferralController@referralHistory');
    Route::get('/refer-friend', 'UserReferralController@index');
    Route::post('/refer-friend', 'UserReferralController@referFriend')->name('refer-friend');



});

Route::post('/check_login','BasicController@check_login')->name('login');
Route::post('/check_register','BasicController@check_register')->name('check_r');
