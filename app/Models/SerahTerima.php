<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SerahTerima extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(SerahTerimaDetail::class, 'serah_id', 'id');
    }

    public function lokasi()
    {
        return $this->hasMany(Lokasi::class, 'id', 'lokasi_id');
    }
}
