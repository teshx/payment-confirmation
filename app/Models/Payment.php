<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_id',
        'bank',
        'deposited_by',
        'transaction_reference',
        'payment_date',
        'receipt_path',
        'status'
    ];
}
