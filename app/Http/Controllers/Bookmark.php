<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chapter;
use App\Models\Bookmark as BookmarkIt;

class Bookmark extends Controller
{
    //

    function bookmark(Request $request) {
        $attributes = $this->unbookmark($request, true);

        if(BookmarkIt::create($attributes)) {
            return response()->json(['response' => true]);
        }

        return response()->json(['response' => false]);
    }

    function unbookmark(Request $request, $local = false) {
        $attributes = $request->validate([
            'user_id' => 'exists:users,id',
            'chapter_id' => 'exists:chapters,id',
            'book_id' => 'exists:books,id'
        ]);

        $bookmark = BookmarkIt::where('user_id', $attributes['user_id'])->where('book_id', $attributes['book_id'])->first();

        if($bookmark != null) BookmarkIt::where('user_id', $attributes['user_id'])->where('book_id', $attributes['book_id'])->delete();
        if(!$local) return response()->json(['response' => true]);
           
        return $attributes;

    }

}