<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Builder\Class_;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    public function subject(){

        return $this->hasMany(Subject::class);

    }

    public function count_rows($id){
        
        $subject = Subject::where('category_id', $id)->get();

        return count($subject);

    }

}
