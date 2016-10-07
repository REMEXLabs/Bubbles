<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use View;
use App\User;
use App\Tag;
use App\Http\Requests;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        View::share('controller', 'tag');
    }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
    public function index()
    {
        return view('tags.index', [
            'tags' => Auth::user()->tags
        ]);
    }

  /**
   * Display a listing of the personal resource.
   *
   * @return \Illuminate\Http\Response
   */
    public function overview()
    {
        return view('tags.index', [
            'tags' => Auth::user()->tags,
        ]);
    }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
    public function create()
    {
        return view('tags.create');
    }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
    public function store(Request $request)
    {
        $this->validate($request, Tag::getValidationRules());
        $input = $request->all();
        $tag = Tag::create([
          'name' => $input['name'],
          'color' => $input['color'],
          'author_id' => $request->user()->id,
        ]);
        $tag->save();
        return redirect()->route('tags.show', ['id' => $tag->id]);
    }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
    public function show($id)
    {
        $tag = Tag::find($id);
        if (is_null($tag)) {
            return redirect()->route('tags.index');
        }
        return view('tags.show', [
            'tag' => $tag,
            'projects' => $tag->projects,
            'quests' => $tag->quests
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($id)
    {
        $tag = Tag::find($id);
        if (is_null($tag)) {
            return redirect()->route('tags.index');
        }
        if (Auth::user()->id != $tag->author_id) {
            return redirect()->route('tags.index');
        }
        return view('tags.search', [
            'tag' => $tag,
            'projects' => $tag->projects,
            'quests' => $tag->quests
        ]);
    }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
    public function edit($id)
    {
        $tag = Tag::find($id);
        if (is_null($tag) || (Auth::user()->id != $tag->author_id)) {
            return redirect()->route('tags.create');
        }
        return view(
            'tags.edit',
            ['tag' => $tag ]
        );
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
        $tag = Tag::find($id);
        if (is_null($tag) || ($request->user()->id != $tag->author_id)) {
            return redirect()->route('tags.create');
        }
        $this->validate($request, Tag::getValidationRules());
        Tag::find($id)->update($request->all());
        return redirect()->route(
            'tags.show',
            ['id' => $tag->id]
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
        $tag = Tag::find($id);
        if (is_null($tag) || (Auth::user()->id != $tag->author_id)) {
            return redirect()->route('tags.create');
        }
        Tag::find($id)->delete();
        return redirect()->route('tags.index');
    }
}
