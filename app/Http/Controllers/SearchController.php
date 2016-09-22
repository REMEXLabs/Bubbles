<?php

namespace App\Http\Controllers;

use View;
use App\Http\Requests;
use App\Project;
use App\Quest;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        View::share('controller', 'search');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $fields = $input = $request->all();
        $search = trim($fields['search']);

        if ($search != '') {
            $search = '%' . $search . '%';

            $projects = Project::where('name', 'LIKE', $search)->get();
            $quests = Quest::where('name', 'LIKE', $search)->get();
            $users = User::where('username', 'LIKE', $search)->get();

            return view('search.index', [
              'projects'    => $projects,
              'n_projects'  => count($projects),
              'quests'      => $quests,
              'n_quests'    => count($quests),
              'users'       => $users,
              'n_users'     => count($users)
            ]);
        }

        return view('search.index', [
          'projects'    => [],
          'n_projects'  => 0,
          'quests'      => [],
          'n_quests'    => 0,
          'users'       => [],
          'n_users'     => 0
        ]);
    }
}
