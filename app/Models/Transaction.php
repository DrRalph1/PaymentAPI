<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transactions";

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'client_id',
        'payment_id',
        'transaction_type',
        'amount',
        'currency',
        'mode_of_payment',
        'refund_id',
        'date_of_refund',
        'status',
    ];
}