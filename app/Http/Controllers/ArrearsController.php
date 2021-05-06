<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Arrears;
use App\Http\Middleware\Encryption;
use Illuminate\Http\Request;

class ArrearsController extends Controller
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
       $client_id = @$input['client_id'];

       // Get Payment ID
       $amount = @$input['amount'];

       // Get Mode of Refund
       $currency = @$input['currency'];

       // Get Status of Refund
       $arrears_type = @$input['arrears_type'];      
       
       // Get Status of Refund
       $status = @$input['status'];  

       // Authenticate the API KEY
       if ($api_key == env('APP_KEY')){

        // check if the user provided all the necessary information
        if(isset($user_id) && isset($client_id) && isset($amount) && isset($currency) && isset($arrears_type)&& isset($status)){

          




        } else {
          // Return Error Message if user does not supply all the neccessary fields
          return response()->json(['responseMessage' => 'All Fields Are Required !!','responseCode' => 100]);
        }

        } else {
        // Return Error Message if API KEY is wrong
        return response()->json(['responseMessage' => 'Invalid API KEY Supplied !!','responseCode' => 100]);
      }
  
    }
