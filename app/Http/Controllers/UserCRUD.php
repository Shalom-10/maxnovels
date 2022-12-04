<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserCRUD extends Controller
{
    //

    public function update() {
        $id = request()->id;
        $role = request()->role;
        $image = request()->file('image');

        $response = [
            'response' => false,
        ];

        if($image) {

            $image_name = date('YmdHi') . '_' . $image->getClientOriginalName();

            if($image->move(public_path('images/avatars'), $image_name))
            User::where('id', $id)->update([
                'avatar' => $image_name
            ]);
        }

        if(User::where('id', $id)->update([
            'role' => $role
        ])) $response['response'] = true;

        $user = User::where('id', $id)->first();

        $response['image'] = $user->avatar;
        $response['role'] = $user->tole;


        return response()->json($response);
    }

    public function delete() {
        $id = request()->id;

        if(User::where('id', $id)->delete()) {
            return response()->json([
                'response' => true
            ]);
        }

        return response()->json([
            'response' => false
        ]);
    }
}
