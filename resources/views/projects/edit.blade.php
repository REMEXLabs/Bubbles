@extends('layouts.app')

@section('content')
<main class="site_main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Update Project</h3>
                {!! Form::model($project, array('method' => 'PATCH', 'route' => array('projects.update', $project->id), 'class'=>'form-horizontal')) !!}
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="form-group">
                        {{ Form::label('name', 'Name:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            {{ Form::text('name', $project->name, array('class'=>'form-control', 'placeholder'=>'Name')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('description', 'Description:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            {{ Form::textarea('description', $project->description, array('class'=>'form-control', 'placeholder'=>'Description')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <ul class="list-inline">
                                <li>{{ Form::submit('Update Project', array('class' => 'btn btn-primary')) }}</li>
                                <li><a class="btn btn-default btn-close" href="{{ route('projects.show', $project->id) }}">Cancel</a></li>
                            </ul>
                        </div>
                    </div>
                {!! Form::close() !!}
                {{-- <a href="{{ route('projects.show', ['id' => $project->id]) }}">Back to user profile</a> or <a href="{{ route('projects.index') }}">back to list</a> --}}
                {!! Form::open(array('method' => 'DELETE', 'route' => array('projects.destroy', $project->id), 'style' => 'margin-top: 20px; display: inline; float: right;')) !!}
                    {{ Form::submit('Delete Project', array('class' => 'btn btn-danger btn-sm')) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</main>
@endsection
