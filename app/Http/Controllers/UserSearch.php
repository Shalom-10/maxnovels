<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserSearch extends Controller
{
    //

    public function search_calculation(Request $request) {
        $search = $request->search;
        $filter = $request->filter;

        if($filter == 'name') {
            $result = User::withCount('reads as reads')->whereRaw(' concat(first_name, " ", last_name) like ? ', '%'. $search .'%');
        }
        else if($filter == 'email') {
            $result = User::withCount('reads as reads')->where('email', 'like', '%'. $search .'%');
        }
        else if($filter == 'date') {
            $result = User::withCount('reads as reads')->where('date_of_birth', 'like', '%'. $search .'%');
        }
        else if($filter == 'age_greater_than') {
            $search = str_replace(' ', '', $search) == "" ? 0 : $search;
            $result = User::withCount('reads as reads')->whereRaw('date_format(from_days(datediff(now(), date_of_birth)), "%Y") + 0 > ?', $search);
        }
        else if($filter == 'age_less_than') {
            $search = str_replace(' ', '', $search) == "" ? 1000 : $search;
            $result = User::withCount('reads as reads')->whereRaw('date_format(from_days(datediff(now(), date_of_birth)), "%Y") + 0 < ?', $search);
        }
        else if($filter == 'age') {
            $result = User::withCount('reads as reads')->whereRaw('date_format(from_days(datediff(now(), date_of_birth)), "%Y") + 0 like ?', "%$search%");
        }
        else if($filter == 'active') {
            $result = User::withCount('reads as reads')->whereNotNull('last_seen')->where('last_seen', '>=', now()->subMinutes(2))->where(
                function($query) use($search) {
                    $query
                    ->where('email', 'like', '%'. $search .'%')
                    ->orWhereRaw(' concat(first_name, " ", last_name) like ? ', '%'. $search . '%');
                }
            );
        }
        else {
            $result = User::withCount('reads as reads')->where('email', 'like', '%'. $search .'%')->orWhereRaw(' concat(first_name, " ", last_name) like ? ', '%'. $search . '%');
        }

        $view_array = [
            'users' => $result->paginate(5),
            'search' => $search ,
            'filter' => $filter,
        ];

        return $view_array;
    }

    public function admin_search(Request $request) {
        $view_array = $this->search_calculation($request);

        if(request()->ajax()) return view('admin_users', $view_array);

        return view('adminusers', $view_array);
    }
}
