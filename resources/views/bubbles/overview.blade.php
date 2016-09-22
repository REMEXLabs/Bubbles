@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline list-inline--right">
                    <li>
                        <a href="{{ route('repo.scan')}}" class="btn btn-sm btn-success"><i class="fa fa-search" aria-hidden="true"></i> Scan GitHub Repository</a>
                    </li>
                    <li>
                        <a href="{{ route('bubbles.create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create New Bubble</a>
                    </li>
                    <li>
                        <a href="{{ route('my-bubbles')}}" class="btn btn-sm btn-success"><i class="fa fa-list" aria-hidden="true"></i> List Bubbles</a>
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
<main class="site_main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="stage">
                    <h3>Dashboard</h3>
                    <hr>
                </div>
            </div>
            <a href="{{ route('users.show', ['id' => $user->id]) }}">
                <div class="col col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="bubble">
                        <header>
                            <div class="info">
                                <div class="user-avatar">
                                  @if($user->image_url)
                                      <img src="{{ $user->image_url }}" class="profile-image img-circle" style="width: 150px; height: 150px;">
                                  @else
                                      <i class="fa fa-user" aria-hidden="true"></i>
                                  @endif
                                </div>
                                <h2>{{ $user->username }}</h2>
                            </div>
                            <div class="info">
                              <div class="user-level">
                                {{ $user->level() }}
                              </div>
                              <h3 class="subline">Level</h3>
                            </div>
                            <div class="info">
                              <div class="user-bar">
                                  <span class="user-bar-text">{{ $user->points }} / {{ $user->pointsToLevelUp() }} <i class="fa fa-star" aria-hidden="true"></i></span>
                                  <?php $percent = (($user->points == 0) ? 0 : intval($user->points / $user->pointsToLevelUp() * 100)); ?>
                                  <span class="user-bar-bg" style="width: {{ $percent }}%"></span>
                              </div>
                              <h3 class="subline">Experience Points</h3>
                            </div>
                        </header>
                    </div>
                </div>
            </a>
            @foreach ($user->bubbles as $bubble)
                @if($bubble->type == 'project')
                    <a href="{{ route('projects.show', ['id' => $bubble->project()->id]) }}">
                @else
                    <a href="{{ route('quests.show', ['id' => $bubble->quest()->id]) }}">
                @endif
                    <div class="col col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="bubble">
                            @if($bubble->type == 'project')
                                <header class="info">
                                    <div class="type-icon">
                                        <i class="fa fa-code" aria-hidden="true"></i>
                                    </div>
                                    <div class="type-subline">
                                        Project
                                    </div>
                                    <h2>{{ $bubble->project()->name }}</h2>
                                </header>
                                @if($bubble->project()->description)
                                   <div class="info type-description">
                                      {{ $bubble->project()->description }}
                                   </div>
                                @endif
                            @endif
                            @if($bubble->type == 'quest')
                                <header class="info">
                                    <div class="type-icon">
                                        <i class="fa fa-bolt" aria-hidden="true"></i>
                                    </div>
                                    <div class="type-subline">
                                        {{ $bubble->quest()->points }} <i class="fa fa-star" aria-hidden="true"></i> Quest
                                    </div>
                                    <h2>{{ $bubble->quest()->name }}</h2>
                                </header>
                                <div class="info">
                                  @if ($bubble->quest()->state != 'open')
                                      <div class="state--{{ $bubble->quest()->state }}"><span class="quest-state">{{ $bubble->quest()->state }}</span></div>
                                  @else
                                      <div class="state--{{ $bubble->quest()->state }}"><span class="quest-state--active">{{ $bubble->quest()->state }}</span></div>
                                  @endif
                                </div>
                                @if($bubble->quest()->description)
                                   <div class="info type-description">
                                      {{ $bubble->quest()->description }}
                                   </div>
                                @endif

                            @endif
                            <footer class="footer">
                                <time class="js_moment" datetime="{{ date_format($bubble->created_at, 'Y-m-d H:i:s') }}" data-time="{{ date_format($bubble->created_at, 'Y-m-d H:i:s') }}">{{ date_format($bubble->created_at, 'd.m.Y') }}</time>
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
