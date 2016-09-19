@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline list-inline--right">
                    <li>
                        <a href="{{ route('repo.scan')}}" class="btn btn-sm btn-success">Scan GitHub Repository</a>
                    </li>
                    <li>
                        <a href="{{ route('quests.create')}}" class="btn btn-sm btn-success">Create New Quest</a>
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
            <div class="stage">
            @if(Auth::check())
              <h3>{{ count($quests) }} quests</h3>
            @else
              <h3>{{ count($quests) }} public quests</h3>
            @endif
            <hr>
            </div>
            @if(count($quests))
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="35%">Name</th>
                            <th width="15%">Language</th>
                            <th width="10%">Level</th>
                            <th class="text-center" width="10%">Points</th>
                            <th class="text-center" width="10%">Status</th>
                            <th class="text-right" width="20%"></th>
                        </tr>
                    </thead>
                    @foreach ($quests as $quest)
                        @if ($quest->state != 'open')
                            <tr class="quest--inactive">
                        @else
                            <tr>
                        @endif
                        <td><a href="{{ route('quests.show', ['id' => $quest->id]) }}">{{ $quest->name }}</a></td>
                        <td><span class="language {{$quest->language}}"></span> {{ Quest::getLanguage($quest->language) }}</td>
                        <td class="icon-swords state--{{ $quest->difficulty }}">
                            <span class="icon-swords-child st"></span>
                            <span class="icon-swords-child nd"></span>
                            <span class="icon-swords-child td"></span>
                        </td>
                        <td class="text-center">
                          <strong>{{ $quest->points }}</strong>
                        </td>
                        @if ($quest->state != 'open')
                            <td class="text-center"><span class="quest-state">{{ $quest->state }}</span></td>
                        @else
                            <td class="text-center"><span class="quest-state--active">{{ $quest->state }}</span></td>
                        @endif
                        <td class="text-right">
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
