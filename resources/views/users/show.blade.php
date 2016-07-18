@extends('layouts.app')

@section('content')
<div class="content container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $user->username }}</h1>

            @if ($user->name)
              <p>Name: {{ $user->name }}</p>
            @endif
            @if ($user->bio)
              <p>{{ $user->bio }}</p>
            @endif

            @if (Auth::check() && Auth::user()->id == $user->id)
            <hr>
            <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-primary">Update profile</a>

            {!! Form::open(array('method' => 'DELETE', 'route' => array('users.destroy', $user->id), 'style' => 'display: inline;')) !!}
                {{ Form::submit('Delete account', array('class' => 'btn btn-danger')) }}
            {!! Form::close() !!}
            @endif

            <hr>
            <a href="{{ route('users.index') }}">List all users</a>
        </div>
    </div>
</div>
@endsection
