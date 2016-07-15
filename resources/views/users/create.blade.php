@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
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

                    {!! Form::open(array('route' => 'users.store', 'role' => 'form')) !!}
                    <div class="form-group">
                        {{ Form::label('username', 'Username:') }}
                        {{ Form::text('username', '', array('class'=>'form-control', 'placeholder'=>'Username')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('email', 'E-Mail Address') }}
                        {{ Form::text('email', '', array('class'=>'form-control', 'placeholder'=>'my@example.com')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('password', 'Password') }}
                        {{ Form::password('password', '', array('class'=>'form-control', 'placeholder'=>'')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('password_confirmation', 'Confirm Password') }}
                        {{ Form::password('password_confirmation', '', array('class'=>'form-control', 'placeholder'=>'')) }}
                    </div>
                    <div>
                        {{ Form::submit('Register now', array('class' => 'btn btn-primary')) }}
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
                <div class="panel-footer">
                    <a href="{{ route('users.index') }}">Back to all users</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
