<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Http\Middleware\Encryption;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTransactionHistories()
    {
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
            // Return All Transactions in JSON format
            return response()->json(['responseMessage' => $decrypted,'responseCode' => 200]);
        }
    }

   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getTransactionHistoryByID($id)
    {

      // Get Transaction by ID
      $data = \DB::table('transactions')
      ->select(\DB::raw("*"))
      ->where("id", "=", $id)
      ->get();
      
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
        // Return All Transactions in JSON format
        return response()->json(['responseMessage' => $decrypted,'responseCode' => 200]);
      }
    }

}
