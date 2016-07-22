<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Resource;
use App\Http\Requests;

class ResourceController extends Controller
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
      return view('resources.index', [
        'resources' => Resource::orderBy('id', 'DESC')->get()
      ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('resources.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $this->validate($request, Resource::getValidationRules());
      $input = $request->all();
      $resource = Resource::create([
          'type' => $input['type'],
          'data' => $input['data'],
          'description' => $input['description'],
          'author_id' => $request->user()->id,
      ]);
      $resource->save();
      return view('resources.show',
          ['resource' => $resource]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $resource = Resource::find($id);
      if (is_null($resource)) {
          return redirect()->route('resources.index');
      }
      return view('resources.show',
          ['resource' => $resource]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      $resource = Resource::find($id);
      if (is_null($resource) || (Auth::user()->id != $resource->author_id)) {
          return redirect()->route('resources.create');
      }
      return view('resources.edit',
          ['resource' => $resource ]);
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
      $resource = Resource::find($id);
      if (is_null($resource) || ($request->user()->id != $resource->author_id)) {
          return redirect()->route('resources.create');
      }
      $this->validate($request, Resource::getValidationRules());
      Resource::find($id)->update($request->all());
      return redirect()->route('resources.show',
          ['id' => $resource->id]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      $resource = Resource::find($id);
      if (is_null($resource) || (Auth::user()->id != $resource->author_id)) {
          return redirect()->route('resources.create');
      }
      Resource::find($id)->delete();
      return redirect()->route('resources.index');
  }
}
