<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use View;
use App\User;
use App\Http\Requests;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'create', 'store']]);
        View::share('controller', 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('points', 'DESC')->get()->filter(function ($user) {
            return true;
            // return $user->points > 1;
        })->values();
        return view('users.index', [
          'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        View::share('controller', 'sign-up');
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, User::getRegistrationValidationRules());
        $input = $request->all();
        $user = User::create([
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
        ]);
        Auth::login($user);
        // return view('users.show', ['user' => $user ]);
        return redirect()->route('users.show', ['id' => $user->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return redirect()->route('users.index');
        }

        $users = User::orderBy('points', 'DESC')->get()->filter(function ($user) {
            return true;
            // return $user->points > 1;
        })->values();

        $nUsers = count($users);
        if ($nUsers == 0) {
            $nUsers = 1;
        }
        $counter = 1;
        foreach ($users as $key => $unknown) {
            if ($user->id != $unknown->id) {
                $counter++;
            } else {
                break;
            }
        }
        $topPercent = $counter / $nUsers * 100;

        $communityRank = 'E';
        if (100 - $topPercent >= 80) {
            $communityRank = 'A';
        } elseif (100 - $topPercent >= 60) {
            $communityRank = 'B';
        } elseif (100 - $topPercent >= 40) {
            $communityRank = 'C';
        } elseif (100 - $topPercent >= 20) {
            $communityRank = 'D';
        }

        View::share('title', $user->username);
        return view('users.show', [
            'user' => $user,
            'n_users' => $nUsers,
            'top_percent' => $topPercent,
            'community_rank' => $communityRank
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = User::find(Auth::user()->id);
        if (is_null($user)) {
            return redirect()->route('users.index');
        }
        View::share('title', $user->username);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return redirect()->route('users.index');
        }
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, User::getValidationRules());
        $input = $request->all();
        $input['email_public'] =((is_null($request->input('email_public')))?0:1);
        $input['quests_public'] =((is_null($request->input('quests_public')))?0:1);
        $input['dashboard_tagcloud'] =((is_null($request->input('dashboard_tagcloud')))?0:1);
        $input['dashboard_accepted_quests'] =((is_null($request->input('dashboard_accepted_quests')))?0:1);
        $input['dashboard_created_quests'] =((is_null($request->input('dashboard_created_quests')))?0:1);
        $input['dashboard_created_projects'] =((is_null($request->input('dashboard_created_projects')))?0:1);
        $user = User::find($id);
        $user->update($input);
        return redirect()->route('users.show', ['id' => $user->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index');
    }

    public function overview()
    {
        return '-';
    }
}
