<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenarikanSimpanan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function detail_penarikan_simpanan()
    {
        return $this->hasMany(DetailPenarikanSimpanan::class, 'penarikan_simpanan_id');
    }

    public function simpanan_user()
    {
        return $this->belongsTo(SimpananUser::class, 'simpanan_user_id');
    }
}