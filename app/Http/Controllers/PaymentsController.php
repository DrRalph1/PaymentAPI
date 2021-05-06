<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Transaction;
use App\Http\Middleware\Encryption;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{

    /**
     * Receive Payment from clients (Students or the general public)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function receivePayments(Request $request)
    {
        // Request Input from user
        $input = $request->input();

        // Get API Key
        $api_key = @$input['api_key'];

        // Get User ID
        $user_id = @$input['user_id'];

        // Get Client ID
        $client_id = @$input['client_id'];

        // Get Transaction ID
        $transaction_id = @$input['transaction_id'];

        // Get Payment Type
        $payment_type = @$input['payment_type'];

        // Get Mode of Payment
        $mode_of_payment = @$input['mode_of_payment'];

        // Get Amount
        $amount = @$input['amount'];

        // Get Currency
        $currency = @$input['currency'];

        // Get Payment Status
        $status = @$input['status'];


        // Authenticate the API KEY
        if ($api_key == env('APP_KEY')){

        // check if the user provided all the necessary information
        if(isset($user_id) && isset($transaction_id) && isset($payment_type) && isset($mode_of_payment) && isset($amount) && isset($currency) && isset($status)){

        // check if user entered numeric value(s) ONLY for the amount
        if((preg_match('/^-?(?:\d+|\d*\.\d+)$/', $amount))){


          $transaction = new Transaction();
          $transaction->user_id = $user_id;
          $transaction->client_id = $client_id;
          $transaction->transaction_type = $payment_type;
          $transaction->amount = $amount;
          $transaction->currency = $currency;
          $transaction->mode_of_payment = $mode_of_payment;
          $transaction->status = $status;

          if ($transaction->save()){

          $payment = new Payment();
          $payment->user_id = $user_id;
          $payment->client_id = $client_id;
          $payment->transaction_id = $transaction->id;
          $payment->payment_type = $payment_type;
          $payment->mode_of_payment = $mode_of_payment;
          $payment->amount = $amount;
          $payment->currency = $currency;
          $payment->status = $status;
        
          if ($payment->save()) {

            $transaction = Transaction::where('id', $transaction->id)->update(array(
              'payment_id'=>$payment->id,
                ));
            
            // Return Payment Successful Message
            return response()->json(['responseMessage' => 'The Payment Has Been Made Successfully !!','responseCode' => 100]);

          } else {
            // Return an error message if the payment was unsuccesful
            return response()->json(['responseMessage' => 'Something went wrong. Payment was unsuccessful !!','responseCode' => 100]);
          }

          } else {
            // Return an error message if the payment was unsuccesful
            return response()->json(['responseMessage' => 'Something went wrong. Payment was unsuccessful !!','responseCode' => 100]);
          }

          } else {
            // Return Error Message if user does not enter a number for the amount
            return response()->json(['responseMessage' => 'Invalid Input for Amount Field. Amount can only be a number !!','responseCode' => 100]);
          }

        } else {
          // Return Error Message if user does not supply all the neccessary fields
          return response()->json(['responseMessage' => 'All Fields Are Required !!','responseCode' => 100]);
        }

    } else {
      // Return Error Message if API KEY is wrong
      return response()->json(['responseMessage' => 'Invalid API KEY Supplied !!','responseCode' => 100]);
    }

  }

}
