<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Bubble;
use App\Http\Requests;

class BubbleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
    public function index()
    {
        return view('bubbles.index', [
          'bubbles' => Auth::user()->bubbles,
        ]);
    }

  /**
   * Display a listing of the personal resource.
   *
   * @return \Illuminate\Http\Response
   */
    public function overview()
    {
        return view('bubbles.overview', [
          'user' => Auth::user()
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
