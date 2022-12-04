<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Category extends Model
{
    use HasFactory;

    public function books() {
        return $this->hasMany(Book::class, 'category_id');
    }

    public function reads() {
        return $this->hasManyThrough(Read::class, Book::class, 'category_id', 'book_id');
    }

}
