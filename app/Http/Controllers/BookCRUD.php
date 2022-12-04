<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;

class BookCRUD extends Controller
{
    //
    public function delete() {
        $id = request()->id;
        if(Book::where('id', $id)->delete()) return response()->json(['response' => true]);
        return response()->json(['response' => false, 'id' => $id]);
    }
}
