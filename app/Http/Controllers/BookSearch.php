<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\Category;

class BookSearch extends Controller
{
    //

    public function search_calculation(Request $request, $published = true) {
        $filter = $request->filter;
        $search = $request->search;

        if($filter == 'category') {
            if($published)
            $book = Book::withCount('reads as reads')->with('author')->whereRelation('chapters', 'state', 'published')->whereRelation('category', 'name', 'like', '%'. $search .'%');
            else $book = Book::withCount('reads as reads')->with('author')->whereRelation('category', 'name', 'like', '%'. $search .'%');
        }

        else if ($filter == 'title') {
            if($published)
            $book = Book::withCount('reads as reads')->with('author')->whereRelation('chapters', 'state', 'published')->where('title', 'like', '%'. $search .'%');
            else
            $book = Book::where('title', 'like', '%'. $search .'%');
        }

        else if ($filter == 'tag') {
            if($published)
            $book = Book::withCount('reads as reads')->with('author')->whereRelation('chapters', 'state', 'published')->whereRelation('tags', 'name', 'like', '%'. $search .'%');
            else
            $book = Book::withCount('reads as reads')->with('author')->whereRelation('tags', 'name', 'like', '%'. $search .'%');
        }

        else if ($filter == 'character') {
            if($published)
            $book = Book::withCount('reads as reads')->with('author')->whereRelation('chapters', 'state', 'published')->whereRelation('characters', 'name', 'like', '%'. $search .'%');
            else
            $book = Book::withCount('reads as reads')->with('author')->whereRelation('characters', 'name', 'like', '%'. $search .'%');
        }

        else if ($filter == 'author') {
            if($published)
            $book = Book::withCount('reads as reads')->with('author')->whereRelation('chapters', 'state', 'published')->whereRelation('author', 'authors', 'like', '%'. $search .'%')->orwhereRelation('author', 'first_name', 'like', '%'. $search .'%')->orWhereRelation('author', 'last_name', 'like', '%' . $search . '%')
            ->orWhereRaw('exists (select concat(first_name, " ", last_name) as name from users where `books`.`author_id` = `users`.`id` having name like ? )', '%'. $search .'%')
            ;
            else
            $book = Book::withCount('reads as reads')->with('author')->whereRelation('author', 'authors', 'like', '%'. $search .'%')->orwhereRelation('author', 'first_name', 'like', '%'. $search .'%')->orWhereRelation('author', 'last_name', 'like', '%' . $search . '%')
            ->orWhereRaw('exists (select concat(first_name, " ", last_name) as name from users where `books`.`author_id` = `users`.`id` having name like ?)', '%'. $search .'%')
            ;
        }

        else {
            if($published)
            $book = Book::withCount('reads as reads')->with('author')->whereRelation('chapters', 'state', 'published')->
                    where(function($query) use($search) {
                        $query->whereRelation('category', 'name', 'like', '%'. $search .'%')
                            ->orWhereRelation('author', 'first_name', 'like', '%'. $search .'%')
                            ->orWhereRelation('author', 'last_name', 'like', '%' . $search . '%')
                            ->orWhereRaw('exists (select concat(first_name, " ", last_name) as name from users where `books`.`author_id` = `users`.`id` having name like ? )', '%'. $search .'%')
                            ->orWhere('title', 'like', '%'. $search .'%')
                            ->orWhere('authors', 'like', '%'. $search .'%');
                    });
            else 
            $book = Book::withCount('reads as reads')->with('author')->
                where(function($query) use($search) {
                    $query->whereRelation('category', 'name', 'like', '%'. $search .'%')
                        ->orWhereRelation('author', 'first_name', 'like', '%'. $search .'%')
                        ->orWhereRelation('author', 'last_name', 'like', '%' . $search . '%')
                        ->orWhereRaw('exists (select concat(first_name, " ", last_name) as name from users where `books`.`author_id` = `users`.`id` having name like ? )', '%'. $search .'%')
                        ->orWhere('title', 'like', '%'. $search .'%')
                        ->orWhere('authors', 'like', '%'. $search .'%');
                });
                    
        }

        $book->with('author');

        $view_array = [
            'books' => $book->paginate(5),
            'collections' => Category::latest()->get(),
            'search' => $search ,
            'filter' => $filter,
        ];

        return $view_array;
    }

    public function search(Request $request) {

        $view_array = $this->search_calculation($request);

        if(request()->ajax()) return view('test', $view_array);

        return view('books', $view_array);
    }

    public function your_book_search(Request $request) {
        $search = $request->search;

        $result = Book::where('title', 'like', '%'.$search.'%')->where('author_id', auth()->user()->id)->paginate(5);

        if(request()->ajax()) return view('yourbook_search', [
            'books' => $result
        ]);

        else return view('yourbooks', [
            'books' => $result
        ]);
    }

    public function admin_books(Request $request) {
        $view_array = $this->search_calculation($request, false);

        if(request()->ajax()) return view('admin_table', $view_array);

        return view('adminbooks', $view_array);
    }
}


