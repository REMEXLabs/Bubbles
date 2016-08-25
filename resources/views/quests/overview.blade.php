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
@endsection

@section('content')
<main class="main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

            {{-- Accepted quests: --}}
            <h3>{{ count($accepted_quests) }} accepted quests</h3>
            @if(count($accepted_quests))
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
                    @foreach ($accepted_quests as $quest)
                        <tr>
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

            <hr>

            {{-- Checking quests: --}}
            <h3>{{ count($checking_quests) }} to be checked quests</h3>
            @if(count($checking_quests))
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
                    @foreach ($checking_quests as $quest)
                        <tr>
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

            <hr>

            {{-- Resolved quests: --}}
            <h3>{{ count($resolved_quests) }} resolved quests</h3>
            @if(count($resolved_quests))
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
                    @foreach ($resolved_quests as $quest)
                        <tr>
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

            <hr>

            {{-- Created quests: --}}
            <h3>{{ count($created_quests) }} created quests</h3>
            @if(count($created_quests))
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
                    @foreach ($created_quests as $quest)
                        <tr>
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
