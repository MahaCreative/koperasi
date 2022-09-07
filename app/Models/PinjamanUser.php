<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinjamanUser extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function detail_data_pinjaman()
    {
        return $this->belongsTo(DetailDataPinjaman::class);
    }


    public function profile()
    {
        return $this->belongsTo(ProfileUser::class, 'profile_user_id');
    }

    public function pembayaran_user()
    {
        return $this->hasOne(PembayaranUser::class);
    }
}