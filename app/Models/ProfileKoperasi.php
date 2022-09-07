<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileKoperasi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getTakeImageAttribute()
    {
        return 'storage/' . $this->logo;
    }
}