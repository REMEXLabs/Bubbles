@extends('layouts.app')

@section('content')
<main class="site_main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Create a new Quest</h3>
                    {!! Form::open(array('route' => 'quests.store', 'role' => 'form', 'class'=>'form-horizontal')) !!}
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
                                {{ Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'Name')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('description', 'Description:', ['class'=>'col-md-2 control-label']) }}
                            <div class="col-md-10">
                                {{ Form::textarea('description', null, array('class'=>'form-control', 'placeholder'=>'Description')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('language', 'Language:', ['class'=>'col-md-2 control-label']) }}
                            <div class="col-md-10">
                                {{ Form::select('language', Quest::getLanguages(), Quest::getDefaultLanguage(), ['class' =>
'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('difficulty', 'Difficulty:', ['class'=>'col-md-2 control-label']) }}
                            <div class="col-md-10">
                                {{ Form::select('difficulty', Quest::getDifficulties(), Quest::getDefaultDifficulty(), ['class' =>
'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="create_bubble" checked> Create Bubble
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <ul class="list-inline">
                                    <li>{{ Form::submit('Create Quest', array('class' => 'btn btn-primary')) }}</li>
                                    <li><a class="btn btn-default btn-close" href="{{ route('quests.index') }}">Cancel</a></li>
                                </ul>
                            </div>
                        </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</main>
@endsection
