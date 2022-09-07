<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAngsuran extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function detail_pinjaman()
    {
        return $this->hasMany(DetailDataPinjaman::class);
    }
}