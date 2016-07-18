@extends('layouts.app')

@section('css')
.content ul {
    padding: 0;
    list-style: none;
}
.content h1 {
    padding-bottom: 10px;
}
@endsection

@section('content')
<div class="content container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ count($users) }} users</h1>
            @if(count($users))
                <table class="table">
                    <thead>
                        <tr>
                            <th>Username</th>
                        </tr>
                    </thead>
                    @foreach ($users as $user)
                    <tr>
                        <td>
                            <a href="{{ route('users.show', ['id' => $user->id]) }}">{{ $user->username }}</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            @endif
            @if (Auth::guest())
                <hr>
                <a href="{{ route('users.create')}}" class="btn btn-success">Sign up</a>
            @endif
        </div>
    </div>
</div>
@endsection
