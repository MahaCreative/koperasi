<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenarikanSimpanan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function simpanan_user()
    {
        return $this->belongsTo(SimpananUser::class);
    }

    public function penarikan_simpanan()
    {
        return $this->belongsTo(PenarikanSimpanan::class);
    }
}