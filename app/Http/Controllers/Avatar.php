<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class Avatar extends Controller
{
    //

    function upload(Request $request) {

        $attributes = $request->validate([
            'image' => '',
            'user_id' => '',
        ]);

        $image = request()->file('image');

        if($image) {
            $image_name = date('YmdHi').'_'.$image->getClientOriginalName();
        }
        else {
            $image_name = 'default_cover';
        }

        if($image != null)
            $image->move(public_path('images/avatars'), $image_name);

        if(User::where('id', $attributes['user_id'])->update([
            'avatar' => $image_name
        ])) return response()->json([
            'response' => true
        ]);

        return response()->json([
            'response' => false
        ]);
    }
}
