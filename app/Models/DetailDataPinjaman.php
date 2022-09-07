<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDataPinjaman extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function data_pinjaman()
    {
        return $this->belongsTo(DataPinjaman::class);
    }
    public function data_angsuran()
    {
        return $this->belongsTo(DataAngsuran::class);
    }
}