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
                            <th width="40%">Name</th>
                            <th width="20%">Language</th>
                            <th width="10%">Level</th>
                            <th width="10%">Points</th>
                            <th width="20%"></th>
                        </tr>
                    </thead>
                    @foreach ($quests as $quest)
                      @if (Auth::check())
                          @if ($quest->author_id == Auth::user()->id)
                              <tr class="info">
                          @elseif ($quest->editor_id == Auth::user()->id)
                              <tr class="active">
                          @endif
                      @else
                          <tr>
                      @endif
                            <td><a href="{{ route('quests.show', ['id' => $quest->id]) }}">{{ $quest->name }}</a></td>
                            <td>{{ $quest->language }}</td>
                            <td>{{ $quest->difficulty }}</td>
                            <td>{{ $quest->points }}</td>
                            <td>
                                <time class="js_moment" datetime="{{ date_format($quest->created_at, 'Y-m-d H:i:s') }}" data-time="{{ date_format($quest->created_at, 'Y-m-d H:i:s') }}">{{ date_format($quest->created_at, 'd.m.Y') }}</time>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
</main>
@endsection
