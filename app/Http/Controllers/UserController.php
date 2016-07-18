<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use Auth;
use App\User;
use App\Http\Requests;

class UserController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index', [
          'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $this->validate($request, [
            'username'    => 'required|alpha_num|unique:users,username|max:255',
            'email'       => 'required|email|unique:users,email|max:255',
            'password'    => 'required|min:6|max:255|confirmed',
        ]);
        $input = $request->all();
        $user = User::create([
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => bcrypt($input['password']),
        ]);
        Auth::login($user);
        return view('users.show',
            ['user' => $user ]);
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
        return view('users.show',
            ['user' => $user ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if (Auth::guest()) {
        //     return redirect()->route('users.index');
        // }

        $user = User::find($id);
        if (is_null($user)) {
            return redirect()->route('users.index');
        }
        return view('users.edit',
            ['user' => $user ]);
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
        // if (Auth::guest()) {
        //     return redirect()->route('users.index');
        // }

        $this->validate($request, [
            'name' => 'alpha_num|max:255',
        ]);

        $input = $request->all();
        $input['email_public'] =((is_null($request->input('email_public')))?0:1);

        $user = User::find($id);
        $user->update($input);
        return redirect()->route('users.show',
            ['id' => $user->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if (Auth::guest()) {
        //     return redirect()->route('users.index');
        // }

        User::find($id)->delete();
		return redirect()->route('users.index');
    }
}