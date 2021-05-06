<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionsControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get All Transactions
        $Transactions = Transaction::all();

        if (count($Transactions) < 1) {
            // Return an error message if no record is found
            return response()->json(['responseMessage' => 'No record was found !!','responseCode' => 100]);
        } else {
            // Return All Transactions in JSON format
            return response()->json(['responseMessage' => $Transactions,'responseCode' => 200]);
        }
    }

   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      // Get Transaction by ID
      $Transaction = Transaction::findOrFail($id);

      // Return Transaction in json format
      return response()->json(['responseMessage' => $Transaction,'responseCode' => 200]);
    }

}
