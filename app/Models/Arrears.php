<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arrears extends Model
{
    use HasFactory;

    protected $table = "arrears";

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'client_id',
        'amount',
        'currency',
        'arrears_type', 
        'status', 
    ];
}
