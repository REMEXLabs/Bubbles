<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Project;
use App\Http\Requests;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('projects.index', [
          'projects' => Project::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
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
            'name' => 'required|alpha_num|max:255',
        ]);
        $input = $request->all();
        $project = Project::create([
            'name' => $input['name'],
            'description' => $input['description'],
            'user_id' => $request->user()->id
        ]);
        $project->save();
        // return view('projects.show', ['project' => $project]);
        return redirect()->route('projects.show', ['id' => $project->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        if (is_null($project)) {
            return redirect()->route('projects.index');
        }
        return view('projects.show',
            ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        if (is_null($project) || (Auth::user()->id != $project->user_id)) {
            return redirect()->route('projects.create');
        }
        return view('projects.edit',
            ['project' => $project ]);
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
        $project = Project::find($id);
        if (is_null($project) || ($request->user()->id != $project->user_id)) {
            return redirect()->route('projects.create');
        }
        $this->validate($request, [
            'name' => 'alpha_num|max:255',
        ]);
        Project::find($id)->update($request->all());
        return redirect()->route('projects.show',
            ['id' => $project->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        if (is_null($project) || (Auth::user()->id != $project->user_id)) {
            return redirect()->route('projects.create');
        }
        Project::find($id)->delete();
		return redirect()->route('projects.index');
    }
}
