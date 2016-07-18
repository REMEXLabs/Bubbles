@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>
                <div class="panel-body">
                    {{ count($projects) }} Projects
                    <hr>
                    @if(count($projects))
                        @foreach ($projects as $project)
                          <p>
                            <a href="{{ route('projects.show', ['id' => $project->id]) }}">{{ $project->name }}</a>
                          </p>
                        @endforeach
                        <hr>
                    @endif
                    @if (Auth::check())
                        <a href="{{ route('projects.create')}}" class="btn btn-primary">Create new project</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
