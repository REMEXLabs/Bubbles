@extends('layouts.app')

@section('content')
<main class="main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Update project</h3>
                {!! Form::model($resource, array('method' => 'PATCH', 'route' => array('resources.update', $resource->id), 'class'=>'form-horizontal')) !!}
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
                        {{ Form::label('type', 'Type:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            {{ Form::select('type', Resource::getTypes(), $resource->type, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('data', 'Data:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            {{ Form::text('data', $resource->data, array('class'=>'form-control', 'placeholder'=>'https://github.com/REMEXLabs/Bubbles.git')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('description', 'Description:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            {{ Form::textarea('description', $resource->description, array('class'=>'form-control', 'placeholder'=>'Description')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <ul class="list-inline">
                                <li>{{ Form::submit('Update resource', array('class' => 'btn btn-primary')) }}</li>
                                <li><a class="btn btn-default btn-close" href="{{ route('resources.show', $resource->id) }}">Cancel</a></li>
                            </ul>
                        </div>
                    </div>
                {!! Form::close() !!}
                {{-- <a href="{{ route('resources.show', ['id' => $resource->id]) }}">Back to user profile</a> or <a href="{{ route('resources.index') }}">back to list</a> --}}
                {!! Form::open(array('method' => 'DELETE', 'route' => array('resources.destroy', $resource->id), 'style' => 'margin-top: 20px; display: inline; float: right;')) !!}
                    {{ Form::submit('Delete quest', array('class' => 'btn btn-danger btn-sm')) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</main>
@endsection
