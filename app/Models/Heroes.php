<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Heroes extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getTakeImageAttribute()
    {
        return 'storage/' . $this->logo;
    }
}