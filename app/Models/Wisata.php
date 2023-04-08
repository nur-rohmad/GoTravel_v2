<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Wisata extends Model
{
    use HasFactory;
    protected $table = 'wisata';
    protected $fillable = [
        'nama_wisata',
        'kota',
        'image',
        'deskripsi',
        'status',
        'location'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function getLocationAttribute()
    {
        $location = json_decode($this->attributes['location']);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $location = new \stdClass;
        }

        return $location;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
