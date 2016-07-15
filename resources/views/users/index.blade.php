@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>
                <div class="panel-body">
                    {{ count($users) }} Users
                    <hr>
                    @foreach ($users as $user)
                      <p>
                        <a href="{{ route('users.show', ['id' => $user->id]) }}">{{ $user->username }}</a>
                      </p>
                    @endforeach
                    <hr>
                    <a href="{{ route('users.create')}}" class="btn btn-primary">Register new user</a>
                </div>
                {{-- <div class="panel-footer">
                    <a href="{{ route('users.create')}}">Register new user</a>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
