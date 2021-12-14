<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ministry extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'address',
        'SRO',
        'p_o_box',
        'phone',
        'email',
        'website'
    ];

    public function division()
    {
        return $this->hasMany(Division::class);
    }

    public function count_divisions($id){
        
        $divisions = Division::where('ministry_id', $id)->get();

        return count($divisions);

    }
}
