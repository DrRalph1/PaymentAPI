<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Refund;
use Illuminate\Http\Request;

class RefundsControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get All Refunds
        $Refunds = Refund::all();

        $data = $Refunds;
      
        // Encryption Key
        $encryption_key = 'base64:paYulEG55oLLh6f5Mr2/F0UunKXjF9qDO4YVwNOq9Bc=';

        // Encrypt The Data
        $encrypted = Encryption::encrypt($data, $encryption_key);

        // Decrypt The Data
        $decrypted = Encryption::decrypt($encrypted, $encryption_key);

        if (count($Refunds) < 1) {
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
    public function show($id)
    {
      // Get Refund by ID
      $Refund = Refund::findOrFail($id);

      $data = $Refunds;
      
      // Encryption Key
      $encryption_key = 'base64:paYulEG55oLLh6f5Mr2/F0UunKXjF9qDO4YVwNOq9Bc=';

      // Encrypt The Data
      $encrypted = Encryption::encrypt($data, $encryption_key);

      // Decrypt The Data
      $decrypted = Encryption::decrypt($encrypted, $encryption_key);

      // Return Refund in json format
      return response()->json(['responseMessage' => $decrypted,'responseCode' => 200]);
    }

}
