<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'ministry_id'
    ];

    public function ministry()
    {
        return $this->belongsTo(Ministry::class);
    }

    public function unit()
    {
        return $this->hasMany(Unit::class);
    }

}
