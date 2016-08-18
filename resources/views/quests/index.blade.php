@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline list-inline--right">
                    <li>
                        <a href="{{ route('quests.create')}}" class="btn btn-sm btn-success">Create new quest</a>
                    </li>
                </ul>
            </div>
        </nav>
    @endif
    {{-- @else
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline">
                    <li>
                        <a href="{{ route('users.create')}}" class="btn btn-success">Join the adventure!</a>
                    </li>
                </ul>
            </div>
        </nav>
    @endif --}}
@endsection

@section('content')
<main class="main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            @if(Auth::check())
              <h3>{{ count($quests) }} quests</h3>
            @else
              <h3>{{ count($quests) }} public quests</h3>
            @endif
            @if(count($quests))
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Language</th>
                            <th>Level</th>
                            <th>Points</th>
                            <th>Created at</th>
                        </tr>
                    </thead>
                    @foreach ($quests as $quest)
                        <tr>
                            <td><a href="{{ route('quests.show', ['id' => $quest->id]) }}">{{ $quest->name }}</a></td>
                            <td>{{ $quest->language }}</td>
                            <td>{{ $quest->difficulty }}</td>
                            <td>{{ $quest->points }}</td>
                            <td>{{ date_format($quest->created_at, 'd.m.Y') }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
</main>
@endsection
