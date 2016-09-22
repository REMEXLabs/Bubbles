<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use View;

class SharingController extends Controller
{
    public function profile($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return redirect()->route('users.index');
        }
        View::share('title', $user->username);
        return view('sharing.profile', ['user' => $user ]);
    }

    public function bubble($id)
    {
        return view('sharing.bubble');
    }
}
