<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Http\Middleware\Encryption;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPayments()
    {
        // Get All Payments
        $data = Payment::all();

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
            // Return All Payments in JSON format
            return response()->json(['responseMessage' => $decrypted,'responseCode' => 200]);
        }
    }

    /**
     * Receive Payment from clients (Students or the general public)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function receivePayments(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPaymentByID($id)
    {
      // Get Payment by ID
      $data = \DB::table('payments')
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
        // Return All Payments in JSON format
        return response()->json(['responseMessage' => $decrypted,'responseCode' => 200]);
      }
    }

}
