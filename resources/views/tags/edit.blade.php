@extends('layouts.app')

@section('content')
<main class="site_main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Update Tag</h3>
                {!! Form::model($tag, array('method' => 'PATCH', 'route' => array('tags.update', $tag->id), 'class'=>'form-horizontal')) !!}
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
                            {{ Form::text('name', $tag->name, array('class'=>'form-control', 'placeholder'=>'Important')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('color', 'Color:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            {{ Form::text('color', $tag->color, array('class'=>'form-control', 'placeholder'=>'#ff0000')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <ul class="list-inline">
                                <li>{{ Form::submit('Update Tag', array('class' => 'btn btn-primary')) }}</li>
                                <li><a class="btn btn-default btn-close" href="{{ route('tags.show', $tag->id) }}">Cancel</a></li>
                            </ul>
                        </div>
                    </div>
                {!! Form::close() !!}
                {{-- <a href="{{ route('tags.show', ['id' => $tag->id]) }}">Back to user profile</a> or <a href="{{ route('tags.index') }}">back to list</a> --}}
                {!! Form::open(array('method' => 'DELETE', 'route' => array('tags.destroy', $tag->id), 'style' => 'margin-top: 20px; display: inline; float: right;')) !!}
                    {{ Form::submit('Delete Tag', array('class' => 'btn btn-danger btn-sm')) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</main>
@endsection
