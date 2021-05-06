<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Refund;
use App\Http\Middleware\Encryption;
use Illuminate\Http\Request;

class RefundsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRefunds()
    {
        // Get All Refunds
        $data = Refund::all();
      
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
            // Return All Refunds in JSON format
            return response()->json(['responseMessage' => $decrypted,'responseCode' => 200]);
        }
    }

    /**
     * Refund a Sale
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function refundSale(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getRefundByID($id)
    {
      // Get Refund by ID
      $data = \DB::table('refunds')
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
        // Return All Accured / Owed Arrears in JSON format
        return response()->json(['responseMessage' => $decrypted,'responseCode' => 200]);
      }
    }

}
