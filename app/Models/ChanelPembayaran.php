<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChanelPembayaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'payment_type',
        'payment_code',
        'image'
    ];
}
