<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Arrears;
use App\Http\Middleware\Encryption;
use Illuminate\Http\Request;

class ArrearsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getArrears()
    {
        // Get All Accured / Owed Arrears
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
            // Return All Accured / Owed Arrears in JSON format
            return response()->json(['responseMessage' => $decrypted,'responseCode' => 200]);
        }
    }

    /**
     * Check owed or accrued arrears of school fees or any other payment source
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkOwedORAccuredArrears(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getArrearsByID($id)
    {
      // Get Arrears by ID
      $data = \DB::table('arrears')
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
