@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">User: {{ $user->username }}</div>
                <div class="panel-body">
                    <p>{{ $user->email }}</p>
                    @if ($user->name)
                      <p>{{ $user->name }}</p>
                    @endif
                    @if ($user->bio)
                      <p>{{ $user->bio }}</p>
                    @endif
                    <a href="{{ route('users.index') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
