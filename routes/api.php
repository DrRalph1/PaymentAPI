<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//////////////////////////////////////////////////////////////////////////////////
////////////////// API ENDPOINTS EXPOSED BY THE PAYMENT GATEWAY //////////////////
//////////////////////////////////////////////////////////////////////////////////

// Enforce Extra Security on the RESTful API
// auth => Ensures that only authenticated users get access to RESTful API
// cors => Ensures that user is accessing the RESTful API from a secured connection (HTTPS)
// authIPAddress => Ensures that only whitelisted IP Addresses can access the RESTful API
// Route::group(['middleware' => ['auth', 'cors', 'authIPAddress']], function() {

// RESTful API Endpoint to check owed or accrued arrears of school fees or any other payment source
Route::get('/checkOwedORAccuredArrears', 'ArrearsController@checkOwedORAccuredArrears');

// RESTful API Endpoint to Receive Payment from clients (Students or the general public)
Route::post('/receivePayments', 'PaymentsController@receivePayments');

// RESTful API Endpoint to Retrieve All Transaction Histories
Route::post('/retrieveTransactionHistory', 'TransactionsController@retrieveTransactionHistory');

// RESTful API Endpoint to Retrieve Transaction History By ID
Route::post('/retrieveTransactionHistoryByID', 'TransactionsController@retrieveTransactionHistoryByID');

// RESTful API Endpoint to Refund a Sale
Route::post('/refundSale', 'RefundsController@refundSale');


////////////////////////////////////////////////////////////////////////////////////////
////////////////// OTHER API ENDPOINTS EXPOSED BY THE PAYMENT GATEWAY //////////////////
////////////////////////////////////////////////////////////////////////////////////////

// RESTful API Endpoint to Retrieve All Payments
Route::post('/retrievePayments', 'PaymentsController@retrievePayments');

// RESTful API Endpoint to Retrieve Payment By ID
Route::post('/retrievePaymentByID', 'PaymentsController@retrievePaymentByID');

// RESTful API Endpoint to Retrieve All Refund Histories
Route::get('/getRefunds/{api_key}', 'RefundsController@getRefunds');
// RESTful API Endpoint to Retrieve Refund History By ID
Route::get('/getRefundByID/{api_key}/{payment_id}', 'RefundsController@getRefundByID');

// RESTful API Endpoint to Retrieve All Arrears Histories
Route::get('/getArrears/{api_key}', 'ArrearsController@getArrears');
// RESTful API Endpoint to Retrieve Arrears History By ID
Route::get('/getArrearsByID/{api_key}/{arrears_id}', 'ArrearsController@getArrearsByID');

// });





