@extends('layouts.app')

{{-- @section('subnav')
    @if (Auth::guest())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline">
                    <li>
                        <a href="{{ route('users.create')}}" class="btn btn-success">Join the community!</a>
                    </li>
                </ul>
            </div>
        </nav>
    @endif
@endsection --}}

@section('content')
<main class="main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>{{ count($users) }} users</h1>
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
            </div>
        </div>
    </div>
</main>
@endsection
