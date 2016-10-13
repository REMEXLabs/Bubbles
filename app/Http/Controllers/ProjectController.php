<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use View;
use App\Bubble;
use App\Project;
use App\Quest;
use App\Resource;
use App\Tag;
use App\Http\Requests;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        View::share('controller', 'project');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('created_at', 'DESC')->get();
        return view('projects.index', [
          'projects' => $projects
        ]);
    }

    /**
     * Display a listing of the personal resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function overview()
    {
        return view('projects.overview', [
          'projects' => Auth::user()->projects,
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
            'name' => 'required|max:255',
        ]);
        $input = $request->all();
        $project = Project::create([
            'name' => $input['name'],
            'description' => $input['description'],
            'user_id' => $request->user()->id
        ]);
        $project->save();

        $create_bubble = ((is_null($request->input('create_bubble'))) ? 0 : 1);
        if ($create_bubble) {
            $bubble = Bubble::create([
              'type' => 'project',
              'project_id' => $project->id,
              'quest_id' => null,
              'order' => 0,
              'user_id' => $request->user()->id,
            ]);
            $bubble->save();
            return redirect()->route('bubbles.index', array('#b' . $bubble->id));
        }

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
        View::share('title', $project->name);
        return view(
            'projects.show',
            ['project' => $project]
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
        $project = Project::find($id);
        if (is_null($project) || (Auth::user()->id != $project->user_id)) {
            return redirect()->route('projects.create');
        }
        return view(
            'projects.edit',
            ['project' => $project ]
        );
    }

    public function add_resource($id)
    {
        $project = Project::find($id);
        if (is_null($project)) {
            return redirect()->route('projects.index');
        }
        if (Auth::user()->id != $project->user_id) {
            return redirect()->route('projects.index');
        }
        View::share('title', $project->name);
        return view(
            'projects.resource',
            [
                'project' => $project,
                'resources' => Auth::user()->resources
            ]
        );
    }

    public function store_resource($project_id, $resource_id)
    {
        if (Auth::guest()) {
            return redirect()->route('projects.index');
        }
        $project = Project::find($project_id);
        if (is_null($project)) {
            return redirect()->route('projects.index');
        }
        $resource = Resource::find($resource_id);
        if (is_null($resource)) {
            return redirect()->route('projects.index');
        }
        $is_resource_owner = Auth::user()->id == $resource->author_id;
        $is_project_owner = Auth::user()->id == $project->user_id;
        if ($is_resource_owner && $is_project_owner) {
            $project->resources()->save($resource);
            return redirect()->route('projects.show', ['id' => $project->id]);
        }
        return redirect()->route('projects.index');
    }

    public function delete_resource($project_id, $resource_id)
    {
        if (Auth::guest()) {
            return redirect()->route('projects.index');
        }
        $project = Project::find($project_id);
        if (is_null($project)) {
            return redirect()->route('projects.index');
        }
        $is_project_owner = Auth::user()->id == $project->user_id;
        if ($is_project_owner) {
            $project->resources()->detach($resource_id);
            return redirect()->route('projects.show', ['id' => $project->id]);
        }
        return redirect()->route('projects.index');
    }

    public function store_tag($project_id, $tag_id)
    {
        if (Auth::guest()) {
            return redirect()->route('projects.index');
        }
        $project = Project::find($project_id);
        if (is_null($project)) {
            return redirect()->route('projects.index');
        }
        $tag = Tag::find($tag_id);
        if (is_null($tag)) {
            return redirect()->route('projects.index');
        }
        $is_tag_owner = Auth::user()->id == $tag->author_id;
        $is_project_owner = Auth::user()->id == $project->user_id;
        if ($is_tag_owner && $is_project_owner) {
            $project->tags()->save($tag);
            return redirect()->route('projects.show', ['id' => $project->id]);
        }
        return redirect()->route('projects.index');
    }

    public function delete_tag($project_id, $tag_id)
    {
        if (Auth::guest()) {
            return redirect()->route('projects.index');
        }
        $project = Project::find($project_id);
        if (is_null($project)) {
            return redirect()->route('projects.index');
        }
        $is_project_owner = Auth::user()->id == $project->user_id;
        if ($is_project_owner) {
            $project->tags()->detach($tag_id);
            return redirect()->route('projects.show', ['id' => $project->id]);
        }
        return redirect()->route('projects.index');
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
        return redirect()->route(
            'projects.show',
            ['id' => $project->id]
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
        $project = Project::find($id);
        if (is_null($project) || (Auth::user()->id != $project->user_id)) {
            return redirect()->route('projects.create');
        }
        Project::find($id)->delete();
        return redirect()->route('projects.index');
    }
}
