<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Chapter;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Character;
use App\Models\TargetAudience;
use App\Models\Language;
use App\Models\Copyright;
use App\Models\Rating;
use App\Models\BookFile;
use App\Models\Read;


class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function chapters() {
        return $this->hasMany(Chapter::class);
    }

    public function file() {
        return $this->hasOne(BookFile::class);
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'tag_to_books');
    }

    public function characters() {
        return $this->belongsToMany(Character::class, 'character_to_books');
    }

    public function audience() {
        return $this->belongsToMany(TargetAudience::class, 'audience_to_books', 'book_id', 'audience_id');
    }

    public function languages() {
        return $this->belongsToMany(Language::class, 'language_to_books');
    }

    public function copyright() {
        return $this->belongsToMany(Copyright::class, 'copyright_to_books');
    }

    public function rating() {
        return $this->belongsToMany(Rating::class, 'rating_to_books');
    }

    public function reads() {
        return $this->hasMany(Read::class, 'book_id');
    }
}
