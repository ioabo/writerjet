<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'staffs',
        'category_id',
        'from',
        'to',
        'file_ref',
        'attn',
        'date_issued',
        'cc',
        'subject',
        'content',
        'for_secretary',
        'status',
        'pdf_url',
        'user_id',
    
    ];

    protected $dates = ['date_issued'];

    public function user()
    {
        return $this->has(User::class);
    }

}
