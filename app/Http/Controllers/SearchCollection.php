<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class SearchCollection extends Controller
{
    //

    public function search(Request $request) {
        $search = $request->search;

        $result = Category::where('name', 'like', '%'.$search.'%')->withCount('reads as reads')->paginate(5);

        if(request()->ajax()) return view('collection_search', [
            'collections' => $result
        ]);

        else return view('collections', [
            'collections' => $result
        ]);
    }
}
