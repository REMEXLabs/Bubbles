@extends('layouts.app')

@section('content')
<main class="main" role="main">
    <div class="container">
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">User: {{ $project->name }}</div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {!! Form::model($project, array('method' => 'PATCH', 'route' => array('projects.update', $project->id))) !!}
                    <div class="form-group">
                        {{ Form::label('name', 'Name:') }}
                        {{ Form::text('name', $project->name, array('class'=>'form-control', 'placeholder'=>'Name')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('description', 'Description:') }}
                        {{ Form::textarea('description', $project->description, array('class'=>'form-control', 'placeholder'=>'Bio')) }}
                    </div>
                    <div class="form-group">
                		{{ Form::submit('Update project', array('class' => 'btn btn-primary')) }}
                	 </div>
                    {!! Form::close() !!}

                    {!! Form::open(array('method' => 'DELETE', 'route' => array('projects.destroy', $project->id), 'style' => 'display: inline;')) !!}
                        {{ Form::submit('Delete project', array('class' => 'btn btn-danger')) }}
                    {!! Form::close() !!}

                </div>
                <div class="panel-footer">
                    <a href="{{ route('projects.show', ['id' => $project->id]) }}">Show project</a> or <a href="{{ route('projects.index') }}">all projects</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
