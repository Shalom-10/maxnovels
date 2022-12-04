<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CollectionCRUD extends Controller
{
    //
    public function update() {
        $id = request()->id;
        $name = request()->name;
        $image = request()->file('image');

        $response = [
            'response' => false,
        ];

        if($image) {

            $image_name = date('YmdHi') . '_' . $image->getClientOriginalName();

            if($image->move(public_path('images/collections'), $image_name))
            Category::where('id', $id)->update([
                'image' => $image_name
            ]);
        }

        if(Category::where('id', $id)->update([
            'name' => $name
        ])) $response['response'] = true;

        $category = Category::where('id', $id)->first();

        $response['image'] = $category->image;
        $response['name'] = $category->name;


        return response()->json($response);

    }

    public function delete() {
        $id = request()->id;
        if(Category::where('id', $id)->delete()) return response()->json(['response' => true]);
        return response()->json(['response' => false, 'id' => $id]);
    }

}
