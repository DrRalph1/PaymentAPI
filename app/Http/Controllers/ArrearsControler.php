<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Arrears;
use Illuminate\Http\Request;

class ArrearsControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get All Accured / Owed Arrears
        $Arrears = Arrears::all();

        $data = $Arrears;

        // Encryption Key
        $encryption_key = 'base64:paYulEG55oLLh6f5Mr2/F0UunKXjF9qDO4YVwNOq9Bc=';

        // Encrypt The Data
        $encrypted = Encryption::encrypt($data, $encryption_key);

        // Decrypt The Data
        $decrypted = Encryption::decrypt($encrypted, $encryption_key);

        if (count($Arrears) < 1) {
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
    public function show($id)
    {
      // Get Arrears by ID
      $Arrears = Arrears::findOrFail($id);

      $data = $Arrears;
      
      // Encryption Key
      $encryption_key = 'base64:paYulEG55oLLh6f5Mr2/F0UunKXjF9qDO4YVwNOq9Bc=';

      // Encrypt The Data
      $encrypted = Encryption::encrypt($data, $encryption_key);

      // Decrypt The Data
      $decrypted = Encryption::decrypt($encrypted, $encryption_key);

      // Return Arrears in json format
      return response()->json(['responseMessage' => $decrypted,'responseCode' => 200]);
    }

}
