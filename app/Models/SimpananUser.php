<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimpananUser extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function jenis_simpanan()
    {
        return $this->belongsTo(JenisSimpanan::class);
    }

    public function profile()
    {
        return $this->belongsTo(ProfileUser::class, 'profile_user_id');
    }
    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function penarikan_simpanan()
    {
        return $this->hasOne(PenarikanSimpanan::class);
    }
}