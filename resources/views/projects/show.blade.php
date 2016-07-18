@extends('layouts.app')

@section('css')
.content h1 {
    padding-bottom: 10px;
}
@endsection

@section('content')
<div class="container content">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $project->name }}</h1>
            <p>
                Project owner: <a href="{{ route('users.show', ['id' => $project->user_id]) }}">{{ $project->user()->username }}</a>
            </p>
            @if ($project->description)
            <div class="description">
                {{ $project->description }}
            </div>
            @endif

            @if (Auth::check() && Auth::user()->id == $project->user_id)
            <hr>
            <a href="{{ route('projects.edit', ['id' => $project->id]) }}" class="btn btn-primary">Update project</a>

            {!! Form::open(array('method' => 'DELETE', 'route' => array('projects.destroy', $project->id), 'style' => 'display: inline;')) !!}
                {{ Form::submit('Delete project', array('class' => 'btn btn-danger')) }}
            {!! Form::close() !!}
            @endif

            <hr>
            <a href="{{ route('projects.index') }}">List all projects</a>
        </div>
    </div>
</div>
@endsection
