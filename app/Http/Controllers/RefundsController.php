<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Refund;
use App\Models\Payment;
use App\Models\Transaction;
use App\Http\Middleware\Encryption;
use Illuminate\Http\Request;

class RefundsController extends Controller
{
    /**
     * Refund a Sale
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function refundSale(Request $request)
    {
       // Request Input from user
       $input = $request->input();

       // Get API Key
       $api_key = @$input['api_key'];

       // Get User ID
       $user_id = @$input['user_id'];

       // Get Sale's ID
       $sale_id = @$input['sale_id'];

       // Get Payment ID
       $payment_id = @$input['payment_id'];

       // Get Mode of Refund
       $mode_of_refund = @$input['mode_of_refund'];

       // Get Status of Refund
       $status = @$input['status'];       

       // Authenticate the API KEY
       if ($api_key == env('APP_KEY')){

        // check if the user provided all the necessary information
        if(isset($user_id) && isset($sale_id) && isset($payment_id) && isset($mode_of_refund) && isset($status)){
                $refund = new Refund();
                $refund->user_id = $user_id;
                $refund->sale_id = $sale_id;
                $refund->payment_id = $payment_id;
                $refund->mode_of_refund = $mode_of_refund;
                $refund->status = $status;

                if ($refund->save()) {

                  $transaction = Transaction::where('payment_id', $payment_id)->update(array(
                    'refund_id'=>$refund->id,
                    'date_of_refund'=>now(),
                    'status'=>'Refunded',
                      ));
                  
                  if($transaction){

                  $updatePayment = Payment::where('id', $payment_id)->delete();

                    if ($updatePayment){

                    // Return Payment Successful Message
                    return response()->json(['responseMessage' => 'The Refund Has Been Made Successfully !!','responseCode' => 200]);

                    } else {
                      // Return an error message if the payment was unsuccesful
                      return response()->json(['responseMessage' => 'This Sales Has Already Been Refunded !!','responseCode' => 100]);
                    }

                  } else {
            
                    Refund::where('payment_id', $payment_id)->delete();

                    // Return an error message if the payment was unsuccesful
                    return response()->json(['responseMessage' => 'Sorry, there is no transaction with the specified Payment ID !!','responseCode' => 101]);
                  }

                } else {
                  // Return an error message if the payment was unsuccesful
                  return response()->json(['responseMessage' => 'Something went wrong. Refund was unsuccessful !!','responseCode' => 102]);
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
