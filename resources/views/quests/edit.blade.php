@extends('layouts.app')

@section('content')
<main class="main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Update project</h3>
                {!! Form::model($quest, array('method' => 'PATCH', 'route' => array('quests.update', $quest->id), 'class'=>'form-horizontal')) !!}
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
                            {{ Form::text('name', $quest->name, array('class'=>'form-control', 'placeholder'=>'Name')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('description', 'Description:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            {{ Form::textarea('description', $quest->description, array('class'=>'form-control', 'placeholder'=>'Description')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('language', 'Language:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            {{ Form::text('language', $quest->language, array('class'=>'form-control', 'placeholder'=>'Java, PHP, C ...')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('difficulty', 'Difficulty:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            {{ Form::select('difficulty', Quest::getDifficulties(), $quest->difficulty, ['class' =>
'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <ul class="list-inline">
                                <li>{{ Form::submit('Update quest', array('class' => 'btn btn-primary')) }}</li>
                                <li><a class="btn btn-default btn-close" href="{{ route('quests.show', $quest->id) }}">Cancel</a></li>
                            </ul>
                        </div>
                    </div>
                {!! Form::close() !!}
                {{-- <a href="{{ route('quests.show', ['id' => $quest->id]) }}">Back to user profile</a> or <a href="{{ route('quests.index') }}">back to list</a> --}}
                {!! Form::open(array('method' => 'DELETE', 'route' => array('quests.destroy', $quest->id), 'style' => 'margin-top: 20px; display: inline; float: right;')) !!}
                    {{ Form::submit('Delete quest', array('class' => 'btn btn-danger btn-sm')) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</main>
@endsection
