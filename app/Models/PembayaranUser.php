<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranUser extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function pinjaman_user()
    {
        return $this->belongsTo(PinjamanUser::class);
    }

    public function detail_pembayaran_user()
    {
        return $this->hasMany(DetailPembayaranUser::class);
    }
}