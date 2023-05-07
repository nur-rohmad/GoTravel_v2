<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getKeyType()
    {
        return 'string';
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'id_booking', 'id');
    }
    public function chanel_pembayaran()
    {
        return $this->belongsTo(ChanelPembayaran::class, 'id_chanel_pembayaran', 'id');
    }
}
