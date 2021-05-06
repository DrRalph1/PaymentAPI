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
    public function submitArrears(Request $request)
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
       $accrual_amount = @$input['accrual_amount'];  

       // Get Status of Refund
       $status = @$input['status']; 

       // Authenticate the API KEY
       if ($api_key == env('APP_KEY')){

        // check if the user provided all the necessary information
        if(isset($user_id) && isset($client_id) && isset($amount) && isset($currency) && isset($arrears_type)){

          // check if user entered numeric value(s) ONLY for the amount
          if((preg_match('/^-?(?:\d+|\d*\.\d+)$/', $amount))){
        
          $arrears = new arrears();
          $arrears->user_id = $user_id;
          $arrears->client_id = $client_id;
          $arrears->amount = $amount;
          $arrears->currency = $currency;
          $arrears->arrears_type = $arrears_type;

          if ($arrears->save()){

             // Return Successful Message
             return response()->json(['responseMessage' => 'Arrears has been added successfully !!','responseCode' => 100]);

          } else {
            // Return an error message if unsuccesful
            return response()->json(['responseMessage' => 'Something went wrong. Arrears was not added !!','responseCode' => 100]);
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


    /**
     * Retrieve Transaction History
     *
     * @return \Illuminate\Http\Response
     */
    public function retrieveArrears(Request $request)
    {
        // Request Input from user
        $input = $request->input();

        // Get API Key
        $api_key = @$input['api_key'];

        if($api_key = env('APP_KEY')){

        // Get All Transactions
        $data = Arrears::all();

        // Encryption Key
        $encryption_key = env('APP_KEY');

        // Encrypt The Data
        $encrypted = Encryption::encrypt($data, $encryption_key);

        // Decrypt The Data
        $decrypted = Encryption::decrypt($encrypted, $encryption_key);

        if (count($data) < 1) {
            // Return an error message if no record is found
            return response()->json(['responseMessage' => 'No record was found !!','responseCode' => 100]);
        } else {
            // Return Decrypted Arrears Info in JSON format
            return json_decode($decrypted);

            // Return Encrypted Arrears Info
            // return $encrypted;
        }

      } else {
        // Return Error Message if API KEY is wrong
        return response()->json(['responseMessage' => 'Invalid API KEY Supplied !!','responseCode' => 100]);
      }
      
    }

  }
