<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use View;
use App\User;
use App\Quest;
use App\Project;
use App\Bubble;
use App\Http\Requests;

class BubbleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
        View::share('controller', 'bubble');
    }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
    public function index()
    {
        if (Auth::check()) {
            return view('bubbles.overview', [
                'user' => Auth::user()
            ]);
        } else {
            View::share('controller', 'welcome');

            $numQuests = Quest::all()->count();
            $numProjects = Project::all()->count();
            $numUsers = User::all()->count();

            $nAll = $numQuests + $numProjects + $numUsers;

            // CSS: width and height:
            $start = 100;
            $stop = 300;
            $cssRadQuests = Bubble::map($numQuests, 0, $nAll, $start, $stop);
            $cssRadProjects = Bubble::map($numProjects, 0, $nAll, $start, $stop);
            $cssRadUsers = Bubble::map($numUsers, 0, $nAll, $start, $stop);

            $maxRad = max([$cssRadQuests, $cssRadProjects, $cssRadUsers]);
            $cssMarQuests = ($maxRad - $cssRadQuests);
            $cssMarProjects = ($maxRad - $cssRadProjects);
            $cssMarUsers = ($maxRad - $cssRadUsers);

            // CSS: opacity:
            $start = 0.2;
            $stop = 0.6;
            $cssOpaQuests = Bubble::map($numQuests, 0, $nAll, $start, $stop);
            $cssOpaProjects = Bubble::map($numProjects, 0, $nAll, $start, $stop);
            $cssOpaUsers = Bubble::map($numUsers, 0, $nAll, $start, $stop);

            // CSS: font-size:
            $start = 15;
            $stop = 27;
            $cssFntQuests = Bubble::map($numQuests, 0, $nAll, $start, $stop);
            $cssFntProjects = Bubble::map($numProjects, 0, $nAll, $start, $stop);
            $cssFntUsers = Bubble::map($numUsers, 0, $nAll, $start, $stop);

            return view('welcome', [
            'numQuests'     => $numQuests,
            'numProjects'   => $numProjects,
            'numUsers'      => $numUsers,
            'cssRadQuests'  => $cssRadQuests,
            'cssRadProjects' => $cssRadProjects,
            'cssRadUsers'   => $cssRadUsers,
            'cssOpaQuests'  => $cssOpaQuests,
            'cssOpaProjects' => $cssOpaProjects,
            'cssOpaUsers'   => $cssOpaUsers,
            'cssFntQuests'  => $cssFntQuests,
            'cssFntProjects' => $cssFntProjects,
            'cssFntUsers'   => $cssFntUsers,
            'cssMarQuests'  => $cssMarQuests,
            'cssMarProjects' => $cssMarProjects,
            'cssMarUsers'   => $cssMarUsers,
            ]);
        }
    }

  /**
   * Display a listing of the personal resource.
   *
   * @return \Illuminate\Http\Response
   */
    public function overview()
    {
        return view('bubbles.index', [
          'bubbles' => Auth::user()->bubbles,
        ]);
    }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
    public function create()
    {
        $projects = [];
        foreach (Auth::user()->projects as $key => $project) {
            $projects[$project->id] = $project->name;
        }
        $quests = [];
        foreach (Auth::user()->createdQuests as $key => $quest) {
            $quests[$quest->id] = $quest->name;
        }
        return view('bubbles.create', [
          'projects' => $projects,
          'quests' => $quests,
        ]);
    }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
    public function store(Request $request)
    {
        $this->validate($request, Bubble::getValidationRules());
        $input = $request->all();

        $projectId = $input['type'] == 'project' ? $input['project_id'] : null;
        $questId = $input['type'] == 'quest' ? $input['quest_id'] : null;

        $bubble = Bubble::create([
          'type' => $input['type'],
          'project_id' => $projectId,
          'quest_id' => $questId,
          'order' => $input['order'],
          'user_id' => $request->user()->id,
        ]);
        $bubble->save();
        return redirect()->route('bubbles.show', ['id' => $bubble->id]);
    }


  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
    public function show($id)
    {
        $bubble = Bubble::find($id);
        if (is_null($bubble)) {
            return redirect()->route('bubbles.index');
        }
        return view('bubbles.show', ['bubble' => $bubble]);
    }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
    public function edit($id)
    {
        $bubble = Bubble::find($id);
        if (is_null($bubble) || (Auth::user()->id != $bubble->user_id)) {
            return redirect()->route('bubbles.create');
        }
        $projects = [];
        foreach (Auth::user()->projects as $key => $project) {
            $projects[$project->id] = $project->name;
        }
        $quests = [];
        foreach (Auth::user()->createdQuests as $key => $quest) {
            $quests[$quest->id] = $quest->name;
        }
        return view('bubbles.edit', [
          'bubble' => $bubble,
          'projects' => $projects,
          'quests' => $quests,
        ]);
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
        $bubble = Bubble::find($id);
        if (is_null($bubble) || ($request->user()->id != $bubble->user_id)) {
            return redirect()->route('bubbles.create');
        }
        $this->validate($request, Bubble::getValidationRules());

        $input = $request->all();
        $input['project_id'] = $input['type'] == 'project' ? $input['project_id'] : null;
        $input['quest_id'] = $input['type'] == 'quest' ? $input['quest_id'] : null;
        Bubble::find($id)->update($input);
        return redirect()->route('bubbles.show', ['id' => $bubble->id]);
    }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
    public function destroy($id)
    {
        $bubble = Bubble::find($id);
        if (is_null($bubble) || (Auth::user()->id != $bubble->user_id)) {
            return redirect()->route('bubbles.create');
        }
        Bubble::find($id)->delete();
        return redirect()->route('bubbles.index');
    }
}
