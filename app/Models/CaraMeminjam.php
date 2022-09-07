<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaraMeminjam extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function cara_meminjam_detail()
    {
        return $this->hasOne(CaraMeminjamDetail::class);
    }
}