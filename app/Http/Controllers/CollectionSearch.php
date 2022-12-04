<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;
use App\Models\Tag;
use App\Models\TagToBooks;

class CollectionSearch extends Controller
{
    //

    public function search_calculation(Request $request) {
        $search = $request->search;
        $filter = $request->filter;

        if($filter == 'book') {

            $book = Book::where('title', 'like', '%' . $search . '%')->first();
            if($book != null) $result = Category::where('id', $book->id)->withCount('reads as reads')->withCount('books as books');
            else $result = [];
        }
        else {
            $result = Category::where('name', 'like', '%' . $search . '%')->withCount('reads as reads')->withCount('books as books');
        }

        $view_array = [
            'collections' => $result->paginate(5),
            'search' => $search ,
            'filter' => $filter,
        ];

        return $view_array;
    }

    public function admin_search(Request $request) {
        $view_array = $this->search_calculation($request);

        if(request()->ajax()) return view('admin_collection', $view_array);

        return view('admincollection', $view_array);
    }
}
