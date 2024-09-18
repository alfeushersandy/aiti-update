<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerahTerimaDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'id', 'barang_id');
    }

    public function SerahTerima()
    {
        return $this->belongsTo(SerahTerima::class, 'serah_id', 'id');
    }

    public function lokasi1()
    {
        return $this->hasOne(Lokasi::class, 'id', 'lokasi_awal_id');
    }

    public function lokasi2()
    {
        return $this->hasOne(Lokasi::class, 'id', 'lokasi_tujuan_id');
    }
}
