@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">User: {{ $user->username }}</div>
                <div class="panel-body">

                    {!! Form::model($user, array('method' => 'PATCH', 'route' => array('users.update', $user->id))) !!}
                    <div class="form-group">
                        {{ Form::label('name', 'Name:') }}
                        {{ Form::text('name', $user->name, array('class'=>'form-control', 'placeholder'=>'Name')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('bio', 'Bio:') }}
                        {{ Form::textarea('bio', $user->name, array('class'=>'form-control', 'placeholder'=>'Bio')) }}
                    </div>
                    {!! Form::close() !!}

                    <a href="{{ route('users.index') }}">Back</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
