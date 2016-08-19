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
                                <th width="10%">Ranking</th>
                                <th width="50%">Username</th>
                                <th width="20%">Points</th>
                                <th width="20%">Resolved Quests</th>
                            </tr>
                        </thead>
                        @foreach ($users as $key => $user)
                        <tr>
                            <td>
                                {{ ++$key }}
                            </td>
                            <td>
                                <a href="{{ route('users.show', ['id' => $user->id]) }}">{{ $user->username }}</a>
                            </td>
                            <td>
                                {{ $user->points }}
                            </td>
                            <td>
                              {{ count($user->resolvedQuests) }}
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
