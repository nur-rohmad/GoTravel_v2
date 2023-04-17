<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OpenTrip extends Model
{
    use HasFactory;
    protected $table = 'open_trip';
    protected $filable = [
        'title',
        'slug',
        'deskripsi',
        'jumlah_peserta',
        'tgl_berangkat',
        'lokasi_tujuan',
        'harga',
        'lama_open_trip',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function getKeyType()
    {
        return 'string';
    }
}
