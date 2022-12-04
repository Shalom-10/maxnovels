<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\BookFile;
use App\Models\Tag;
use App\Models\Character;
use App\Models\Chapter;
use App\Models\Language;
use App\Models\LanguageToBook;
use App\Models\CopyrightToBook;
use App\Models\CharacterToBook;
use App\Models\TagToBooks;
use App\Models\RatingToBook;
use App\Models\AudienceToBook;

class WriterForm extends Controller
{
    //

    public function handleProperty($properties, $mainClass, $subClass, $book_id, $first_key, $second_key) {
        
        if(str_replace(' ', '', $properties) == '') return false;

        $properties = explode(',', $properties);

        foreach($properties as $property) {

            $property = strtolower($property);

            $propertyObj = $mainClass::where('name', $property)->get()->toArray();

            if($propertyObj == []) {
                $propertyObj = $mainClass::create([
                    'name' => $property
                ]);

                $propertyObj = $propertyObj->toArray();

            }
            else {
                $propertyObj = $propertyObj[0];
            }


            $attributes = [];
            $attributes[$first_key] = $propertyObj['id'];
            $attributes[$second_key] = $book_id;

            $subClass::create($attributes);
        }

    }

    public function handleId($id, $book_id,  $mainClass, $key) {
        $attributes = [];

        $attributes['book_id'] = $book_id;
        $attributes[$key] = $id;

        $mainClass::create($attributes);
    }

    public function newbook() {
        if(request()->type == 'external' && request()->id == null)
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'main_characters' => '',
            'category' => 'required|exists:App\Models\Category,id',
            'tags' => '',
            'target_audience' => 'required|exists:target_audiences,id',
            'language' => 'required',
            'copyright' => 'required|exists:copyrights,id',
            'rating' => 'required|exists:ratings,id',
            'cover_image' => '',
            'author' => '',
            'id' => '',
            'type' => 'required',
            'book_file' => 'required'
        ]);
        else 
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'main_characters' => '',
            'category' => 'required|exists:App\Models\Category,id',
            'tags' => '',
            'target_audience' => 'required|exists:target_audiences,id',
            'language' => 'required',
            'copyright' => 'required|exists:copyrights,id',
            'rating' => 'required|exists:ratings,id',
            'cover_image' => '',
            'author' => '',
            'id' => '',
            'type' => 'required',
        ]);

        $image = request()->file('cover_image');
        $book_file = request()->file('book_file');



        if($image) {
            $image_name = date('YmdHi').'_'.$image->getClientOriginalName();
        }

        else {
            $image_name = 'default_cover';
        }

        $book = Book::where('id', $attributes['id'])->first();

        if($book != null) {
            $image_name = $image_name != 'default_cover' ? $image_name : $book->cover_image;

            $book->update([
                'title' => $attributes['title'],
                'description' => $attributes['description'],
                'cover_image' => $image_name,
                'reads' => 0,
                'authors' => $attributes['author'],
                'author_id' => session('user')['id'],
                'category_id' => $attributes['category']
            ]);

            $output = $attributes['type'] == 'external'? redirect('/admin_books') :redirect('/chapters/' . $book->id);

            TagToBooks::where('book_id', $book->id)->delete();
            CharacterToBook::where('book_id', $book->id)->delete();
            LanguageToBook::where('book_id', $book->id)->delete();
            AudienceToBook::where('book_id', $book->id)->delete();
            CopyrightToBook::where('book_id', $book->id)->delete();
            RatingToBook::where('book_id', $book->id)->delete();
        }

        else {

            $book = Book::create([
                'title' => $attributes['title'],
                'description' => $attributes['description'],
                'cover_image' => $image_name,
                'reads' => 0,
                'authors' => $attributes['author'],
                'author_id' => session('user')['id'],
                'category_id' => $attributes['category'],
                'type' => $book_file != null ? 'external' : 'native',
            ]);

            $output = $book_file != null ? redirect('/admin_books') : redirect('/writer/' . $book->id . '/new');
        }

        if($image != null)
            $image->move(public_path('images/cover_images'), $image_name);

        if($book_file != null ) {

            $book_file_name = date('YmdHi').'_'.$book_file->getClientOriginalName();
            $book_file->move(public_path('upbooks'), $book_file_name);

            BookFile::where('book_id', $book->id)->delete();

            BookFile::create([
                'book_id' => $book->id,
                'file_name' => $book_file_name,
            ]);

            $last_order = Chapter::where('book_id', $book->id)->orderBy('order', 'DESC')->first();
            $order = $last_order == null ? 1 : $last_order->order + 1;

            $chapter = Chapter::create([
                'title' => 'Untitled Chapter',
                'book_id' => $book->id,
                'order' => $order,
                'state' => 'published',
            ]);
        }
            

        $this->handleProperty($attributes['tags'], Tag::class, TagToBooks::class, $book->id, 'tag_id', 'book_id');
        $this->handleProperty($attributes['main_characters'], Character::class, CharacterToBook::class, $book->id, 'character_id', 'book_id');
        $this->handleProperty($attributes['language'], Language::class, LanguageToBook::class, $book->id, 'language_id', 'book_id');

        $this->handleId($attributes['target_audience'], $book->id, AudienceToBook::class, 'audience_id');
        $this->handleId($attributes['copyright'], $book->id, CopyrightToBook::class, 'copyright_id');
        $this->handleId($attributes['rating'], $book->id, RatingToBook::class, 'rating_id');

        return $output;

    }
}
