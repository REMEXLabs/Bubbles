@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline list-inline--right">
                    <li>
                        <a href="{{ route('bubbles.create')}}" class="btn btn-sm btn-success">Create new bubble</a>
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
            <div class="col-md-6">
                <div class="bubble">
                    <header>
                        <h2>{{ $user->username }}</h2>
                        <dl>
                            @if($user->name)
                                <dt>Name</dt>
                                <dd>{{ $user->name }}</dd>
                            @endif
                            <dt>Level</dt>
                            <dd>{{ $user->level() }}</dd>
                            <dt>Experience points</dt>
                            <dd>{{ $user->points }} / {{ $user->pointsToLevelUp() }}</dd>
                        </dl>
                    </header>
                </div>
            </div>
            @foreach ($user->bubbles as $bubble)
                @if($bubble->type == 'project')
                    <a href="{{ route('projects.show', ['id' => $bubble->project()->id]) }}">
                @else
                    <a href="{{ route('quests.show', ['id' => $bubble->quest()->id]) }}">
                @endif
                    <div class="col-md-6">
                        <div class="bubble">
                            @if($bubble->type == 'project')
                                <header>
                                    <h2>{{ $bubble->project()->name }}</h2>
                                    <div class="type">
                                        <i class="fa fa-code" aria-hidden="true"></i> Project
                                    </div>
                                </header>
                                <dl>
                                    <dt>Description</dt>
                                    <dd>{{ $bubble->project()->description }}</dd>
                                </dl>
                            @endif
                            @if($bubble->type == 'quest')
                                <header>
                                    <h2>{{ $bubble->quest()->name }}</h2>
                                    <div class="type">
                                        <i class="fa fa-bolt" aria-hidden="true"></i> Quest
                                    </div>
                                </header>
                                <main>
                                    <dl>
                                        <dt>Description</dt>
                                        <dd>{{ $bubble->quest()->description }}</dd>
                                        <dt>Status</dt>
                                        @if ($bubble->quest()->state != 'open')
                                            <dd class="state--{{ $bubble->quest()->state }}"><span class="quest-state">{{ $bubble->quest()->state }}</span></dd>
                                        @else
                                            <dd class="state--{{ $bubble->quest()->state }}"><span class="quest-state--active">{{ $bubble->quest()->state }}</span></dd>
                                        @endif
                                    </dl>
                                </main>
                            @endif
                            <footer>
                              <dl>
                                  <dt>Created at</dt>
                                  <dd>
                                      <time class="js_moment" datetime="{{ date_format($bubble->created_at, 'Y-m-d H:i:s') }}" data-time="{{ date_format($bubble->created_at, 'Y-m-d H:i:s') }}">{{ date_format($bubble->created_at, 'd.m.Y') }}</time>
                                  </dd>
                              </dl>
                            </footer>
                        </div>
                    </div>
            </a>
            @endforeach
        </div>

        {{-- <div class="row">
            <div class="col-md-12">
                <h3>{{ $user->username }}</h3>
                <hr>
                <h3>{{ count($user->bubbles) }} bubbles</h3>
                @if(count($user->bubbles))
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Order</th>
                                <th>Created at</th>
                            </tr>
                        </thead>
                        @foreach ($user->bubbles as $bubble)
                            <tr>
                                @if($bubble->type == 'project')
                                    <td><a href="{{ route('bubbles.show', ['id' => $bubble->id]) }}">{{ $bubble->project()->name }}</a></td>
                                @endif
                                @if($bubble->type == 'quest')
                                    <td><a href="{{ route('bubbles.show', ['id' => $bubble->id]) }}">{{ $bubble->quest()->name }}</a></td>
                                @endif
                                <td>{{ $bubble->type }}</td>
                                <td>{{ $bubble->order }}</td>
                                <td>{{ date_format($bubble->created_at, 'd.m.Y') }}</td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>
        </div> --}}

    </div>
</main>
@endsection
