<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    use HasFactory;
    protected $appends = ['badge_color'];
    protected $guarded  = [];
    protected $keyType = 'string';
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function open_trip()
    {
        return $this->belongsTo(OpenTrip::class, 'id_openTrip', 'id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'id_booking');
    }

    public function getBadgeColorAttribute()
    {
        $color = '';
        switch ($this->status) {
            case 'menunggu_pembayaran':
                $color = 'warning';
                break;
            case 'proses':
                $color = 'dark';
                break;
            case 'berhasil' :
            case 'dibayar' :
                $color = 'success';
                break;
            case 'gagal':
                $color = 'danger';
                break;
            default:
                $color = 'light';
                break;
        }
        return $color;
    }
}
