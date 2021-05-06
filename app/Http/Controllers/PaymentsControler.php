<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentsControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get All Payments
        $Payments = Payment::all();

        if (count($Payments) < 1) {
            // Return an error message if no record is found
            return response()->json(['responseMessage' => 'No record was found !!','responseCode' => 100]);
        } else {
            // Return All Payments in JSON format
            return response()->json(['responseMessage' => $Payments,'responseCode' => 200]);
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
    public function show($id)
    {
      // Get Payment by ID
      $Payment = Payment::findOrFail($id);

      // Return Payment in json format
      return response()->json(['responseMessage' => $Payment,'responseCode' => 200]);
    }

}
