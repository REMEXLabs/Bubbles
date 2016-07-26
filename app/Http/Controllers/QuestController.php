<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use View;
use App\User;
use App\Quest;
use App\Http\Requests;

class QuestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        View::share('controller', 'quest');
    }

      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
    public function index()
    {
        return view('quests.index', [
        'quests' => Quest::orderBy('id', 'DESC')->get()
        ]);
    }

      /**
       * Display a listing of the personal resource.
       *
       * @return \Illuminate\Http\Response
       */
    public function overview()
    {
        return view('quests.overview', [
              'accepted_quests' => Auth::user()->acceptedQuests,
              'resolved_quests' => Auth::user()->resolvedQuests,
              'created_quests' => Auth::user()->createdQuests,
        ]);
    }

      /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
    public function create()
    {
        return view('quests.create');
    }

      /**
       * Store a newly created resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\Response
       */
    public function store(Request $request)
    {
        $this->validate($request, Quest::getValidationRules());
        $input = $request->all();
        $quest = Quest::create([
          'name' => $input['name'],
          'description' => $input['description'],
          'difficulty' => $input['difficulty'],
          'language' => $input['language'],
          'author_id' => $request->user()->id,
        ]);
        $quest->save();
      //     return view('quests.show', ['quest' => $quest]);
        return redirect()->route('quests.show', ['id' => $quest->id]);
    }

      /**
       * Display the specified resource.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
    public function show($id)
    {
        $quest = Quest::find($id);
        if (is_null($quest)) {
            return redirect()->route('quests.index');
        }
        return view(
            'quests.show',
            ['quest' => $quest]
        );
    }

      /**
       * Show the form for editing the specified resource.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
    public function edit($id)
    {
        $quest = Quest::find($id);
        if (is_null($quest) || (Auth::user()->id != $quest->author_id)) {
            return redirect()->route('quests.create');
        }
        return view('quests.edit', ['quest' => $quest ]);
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
        $quest = Quest::find($id);
        if (is_null($quest) || ($request->user()->id != $quest->author_id)) {
            return redirect()->route('quests.create');
        }
        $this->validate($request, Quest::getValidationRules());
        Quest::find($id)->update($request->all());
        return redirect()->route(
            'quests.show',
            ['id' => $quest->id]
        );
    }

      /**
       * Remove the specified resource from storage.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
    public function destroy($id)
    {
        $quest = Quest::find($id);
        if (is_null($quest) || (Auth::user()->id != $quest->author_id)) {
            return redirect()->route('quests.create');
        }
        Quest::find($id)->delete();
        return redirect()->route('quests.index');
    }
}
