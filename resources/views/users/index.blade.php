@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ count($users) }} Users</div>
                <div class="panel-body">
                    @foreach ($users as $user)
                      <p>
                        <a href="{{ route('users.show', ['id' => $user->id]) }}">{{ $user->username }}</a>
                      </p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
