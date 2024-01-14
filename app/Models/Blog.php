<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
    ];


    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query->where('title', 'LIKE', "%$search%");
        }
    }

    
}
