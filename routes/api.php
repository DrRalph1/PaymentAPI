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
// auth => Ensures that only authenticated users get access to the RESTful API
// cors => Ensures that user is accessing the RESTful API from a secured connection (HTTPS)
// authIPAddress => Ensures that only whitelisted IP Addresses can access the RESTful API
Route::group(['middleware' => ['authIPAddress']], function() {

// RESTful API Endpoint to check owed or accrued arrears of school fees or any other payment source
Route::post('/checkArrears', 'ArrearsController@checkArrears');

// RESTful API to submit Owed or Accrued Arrears
Route::post('/submitArrears', 'ArrearsController@submitArrears');

// RESTful API Endpoint to Receive Payment from clients (Students or the general public)
Route::post('/receivePayments', 'PaymentsController@receivePayments');

// RESTful API Endpoint to Retrieve All Transaction Histories
Route::post('/retrieveTransactionHistory', 'TransactionsController@retrieveTransactionHistory');

// RESTful API Endpoint to Refund a Sale
Route::post('/refundSale', 'RefundsController@refundSale');

 });





