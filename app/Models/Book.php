<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = "books";

    protected $fillable = [
        'title',
        'author',
        'publication_year',
        'publisher',
        'id_category',
        'image',
    ];

    public function category()
    {
        return $this->hasOne('App\Models\BookCategory', 'id', 'id_category');
    }
}
