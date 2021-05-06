<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id')->startingValue(1);
            $table->integer('user_id');
            $table->integer('client_id');
            $table->integer('payment_id')->nullable();
            $table->string('transaction_type');
            $table->float('amount');
            $table->string('currency');
            $table->string('mode_of_payment');
            $table->string('refund_id')->nullable();
            $table->string('date_of_refund')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}