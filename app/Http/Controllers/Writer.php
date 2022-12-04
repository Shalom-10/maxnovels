<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Book;
use App\Models\Chapter;

class Writer extends Controller
{
    //
    function writer(Book $book, $chapter_id) {

        // dd(session('user')['id'], $book->author_id);

        if(session('user')['id'] != $book->author_id) return redirect('/yourbooks');

        if($chapter_id == 'new') {
            $last_order = Chapter::where('book_id', $book->id)->orderBy('order', 'DESC')->first();
            $order = $last_order == null ? 1 : $last_order->order + 1;

            $chapter = Chapter::create([
                'title' => 'Untitled Chapter',
                'book_id' => $book->id,
                'order' => $order,
            ]);

            return redirect('/writer/'. $book->id . '/' . $chapter->id);
        }
        else {
            $chapter = Chapter::where('id', $chapter_id)->first();
        }

        if($chapter == null || $chapter->toArray() == []) {
            return redirect('/writer/'. $book->id . '/new');
        }

        return view('writer2', [
            'chapter' => $chapter,
        ]);
    }

    function save(Book $book, $chapter_id) {

        $attributes = request()->validate([
            'chapter_title' => '',
            'chapter_content' => '',
            'type' => '',
        ]);

        // dd(json_decode($attributes['chapter_content']));

        $chapter = Chapter::where('id', $chapter_id)->first();
        
        if($attributes['type'] == 'save') {

            // dd($attributes['chapter_title']);

            Chapter::where('id', $chapter_id)->update([
                'title' => $attributes['chapter_title'],
                'draft_content' => $attributes['chapter_content']
            ]);

        }

        else if($attributes['type'] == 'publish') {

            Chapter::where('id', $chapter_id)->update([
                'title' => $attributes['chapter_title'],
                'saved_content' => $attributes['chapter_content'],
                'draft_content' => $attributes['chapter_content'],
                'state' => 'published',
            ]);

        }

        else if($attributes['type'] == 'delete') {

            Chapter::where('id', $chapter_id)->delete();
            return redirect('/chapters/'. $book->id);

        }


        return redirect('/writer/'. $book->id . '/' . $chapter_id);
    }

    function chapters(Book $book) {
        if(session('user')['id'] != $book->author_id) return redirect('/yourbooks');

        $chapters = Chapter::where('book_id', $book->id)->orderBy('order', 'ASC')->get();


        return view('chapters', [
            'chapters' => $chapters,
            'book_id'  => $book->id,
        ]);
    }

    function publishall(Book $book) {
        $chapters = Chapter::where('book_id', $book->id)->orderBy('order', 'ASC')->get();

        foreach($chapters as $chapter) {
            $chapter->update([
                'state' => 'published'
            ]);
        }

        return redirect('/chapters/' . $book->id);
    }

    function sortchapters(Request $request) {
        $book_id = $request->book_id;
        $new_orders = explode(',', $request->chapters);
        $count = 0;

        $chapters = Chapter::where('book_id', $book_id)->orderBy('order', 'ASC')->get();

        foreach($chapters as $chapter) {
            if($chapter->order != $new_orders[$count] && $new_orders[$count] != null) {
                $old_order = $chapter->order;
                $new_order = $new_orders[$count];

                $old_chapter = Chapter::where('order', $old_order)->first()->id;
                $new_chapter = Chapter::where('order', $new_order)->first()->id;


                Chapter::where('id', $old_chapter)->update(['order' => $new_order]);
                Chapter::where('id', $new_chapter)->update(['order' => $old_order]);

                $new_orders[array_search($old_order, $new_orders)] = null;
            }

            $count++;
        }

        return response()->json(['book_id' => $book_id, 'order' => $new_orders]);
    }
}
