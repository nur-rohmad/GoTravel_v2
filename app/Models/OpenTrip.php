<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OpenTrip extends Model
{
    use HasFactory;
    protected $table = 'open_trip';
    protected $fillable = [
        'title',
        'slug',
        'deskripsi',
        'jumlah_peserta',
        'tgl_berangkat',
        'lokasi_tujuan',
        'harga',
        'lama_open_trip',
        'poster',
        'lokasi_penjemputan'
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

    public function getLokasiTujuanAttribute()
    {
        $lokasiTujuan = json_decode($this->attributes['lokasi_tujuan'], true);

        $lokasi = Wisata::select('id', 'nama_wisata', 'image', 'deskripsi', 'updated_at', 'kota')->whereIn('id', $lokasiTujuan)->get();
        return $lokasi;
    }

    public function getLokasiPenjemputanAttribute()
    {
        $location = json_decode($this->attributes['lokasi_penjemputan']);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $location = new \stdClass;
        }

        return $location;
    }
}
