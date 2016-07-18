@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Project</div>
                <div class="panel-body">
                    <h3>{{ $project->name }}</h3>

                    <p>
                        Creator: <a href="{{ route('users.show', ['id' => $project->user_id]) }}">{{ $project->user()->username }}</a>
                    </p>

                    @if ($project->description)
                      <p>{{ $project->description }}</p>
                    @endif

                    @if (Auth::check())
                    <hr>
                    <a href="{{ route('projects.edit', ['id' => $project->id]) }}" class="btn btn-primary">Update project</a>

                    {!! Form::open(array('method' => 'DELETE', 'route' => array('projects.destroy', $project->id), 'style' => 'display: inline;')) !!}
                        {{ Form::submit('Delete project', array('class' => 'btn btn-danger')) }}
                    {!! Form::close() !!}
                    @endif

                </div>
                <div class="panel-footer">
                    <a href="{{ route('projects.index') }}">Back to all projects</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
