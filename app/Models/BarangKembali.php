<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKembali extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function serahTerima()
    {
        return $this->hasMany(SerahTerima::class, 'id', 'serah_terima_id');
    }

    public function serahTerimaDetail()
    {
        return $this->belongsTo(SerahTerimaDetail::class, 'serah_terima_detail_id', 'id');
    }
}
