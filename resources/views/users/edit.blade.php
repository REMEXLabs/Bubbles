@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Update profile</h2>
            {!! Form::model($user, array('method' => 'PATCH', 'route' => array('users.update', $user->id), 'class'=>'form-horizontal')) !!}
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
                        {{ Form::text('name', $user->name, array('class'=>'form-control', 'placeholder'=>'Name')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('bio', 'Biography:', ['class'=>'col-md-2 control-label']) }}
                    <div class="col-md-10">
                        {{ Form::textarea('bio', $user->bio, array('class'=>'form-control', 'placeholder'=>'Bio')) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="container col-md-offset-2">
                        <div class="checkbox">
                            <label>
                                {{ Form::checkbox('email_public', 1, $user->email_public) }} Make your e-mail {{$user->email}} public?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        {{ Form::submit('Update profile', array('class' => 'btn btn-block btn-primary')) }}
                    </div>
                </div>
            {!! Form::close() !!}
            {{-- <a href="{{ route('users.show', ['id' => $user->id]) }}">Back to user profile</a> or <a href="{{ route('users.index') }}">back to list</a> --}}
            {!! Form::open(array('method' => 'DELETE', 'route' => array('users.destroy', $user->id), 'style' => 'margin-top: 20px; display: inline; float: right;')) !!}
                {{ Form::submit('Delete account', array('class' => 'btn btn-danger btn-sm')) }}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
