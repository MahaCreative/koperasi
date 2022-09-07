<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembayaranUser extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function pembayaran_user()
    {
        return $this->belongsTo(PembayaranUser::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
    public function pinjaman_user()
    {
        return $this->belongsTo(PinjamanUser::class);
    }
}