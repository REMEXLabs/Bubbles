@extends('layouts.app')

@section('content')
<main class="site_main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Create a new quest</h3>
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
                        {{-- <div class="form-group">
                            {{ Form::label('name', 'Name:') }}
                            {{ Form::text('name', '', array('class'=>'form-control', 'placeholder'=>'Name')) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('description', 'Description:') }}
                            {{ Form::textarea('description', '', array('class'=>'form-control', 'placeholder'=>'Description')) }}
                        </div> --}}
                        {{-- <div>
                            {{ Form::submit('Create new project', array('class' => 'btn btn-primary')) }}
                        </div> --}}
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <ul class="list-inline">
                                    <li>{{ Form::submit('Create quest', array('class' => 'btn btn-primary')) }}</li>
                                    <li><a class="btn btn-default btn-close" href="{{ route('quests.index') }}">Cancel</a></li>
                                </ul>
                            </div>
                        </div>
                    {!! Form::close() !!}


                    {{-- {!! Form::model($user, array('method' => 'PATCH', 'route' => array('users.update', $user->id))) !!}
                    <div class="form-group">
                        {{ Form::label('name', 'Name:') }}
                        {{ Form::text('name', $user->name, array('class'=>'form-control', 'placeholder'=>'Name')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('bio', 'Bio:') }}
                        {{ Form::textarea('bio', $user->bio, array('class'=>'form-control', 'placeholder'=>'Bio')) }}
                    </div>
                    <div class="form-group">
                		    {{ Form::submit('Update profile', array('class' => 'btn btn-info')) }}
                	</div>
                    {!! Form::close() !!} --}}

            </div>
        </div>
    </div>
</main>
@endsection
