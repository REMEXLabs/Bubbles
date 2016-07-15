@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">User</div>
                <div class="panel-body">
                    <h3>{{ $user->username }}</h3>
                    @if ($user->email_public)
                      <p>{{ $user->email }}</p>
                    @endif
                    @if ($user->name)
                      <p>{{ $user->name }}</p>
                    @endif
                    @if ($user->bio)
                      <p>{{ $user->bio }}</p>
                    @endif


                    @if (Auth::user())
                    <hr>
                    <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-primary">Update profile</a>
                    
                    {!! Form::open(array('method' => 'DELETE', 'route' => array('users.destroy', $user->id), 'style' => 'display: inline;')) !!}
                        {{ Form::submit('Delete account', array('class' => 'btn btn-danger')) }}
                    {!! Form::close() !!}
                    @endif

                </div>
                <div class="panel-footer">
                    <a href="{{ route('users.index') }}">Back to all users</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
