<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Http\Middleware\Encryption;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Retrieve Transaction History
     *
     * @return \Illuminate\Http\Response
     */
    public function retrieveTransactionHistory(Request $request)
    {
        // Request Input from user
        $input = $request->input();

        // Get API Key
        $api_key = @$input['api_key'];

        if($api_key = env('APP_KEY')){

        // Get All Transactions
        $data = Transaction::all();

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
            // Return Decrypted Transactions in JSON format
            return json_decode($decrypted);

            // Return Encrypted Transactions
            // return $encrypted;
        }

      } else {
        // Return Error Message if API KEY is wrong
        return response()->json(['responseMessage' => 'Invalid API KEY Supplied !!','responseCode' => 100]);
      }
      
    }

}