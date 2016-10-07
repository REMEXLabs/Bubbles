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
                    <li aria-hidden="true">
                        <a href="{{ url('/')}}" class="btn btn-sm btn-success"><i class="fa fa-home" aria-hidden="true"></i></a>
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
    {{-- <div class="container"> --}}

    <div class="container-fluid" style="max-width: 1600px;">

        <div class="row">
          <div class="col-md-12">
              <div class="stage">
                  <h3>Dashboard</h3>
                  <hr>
              </div>
          </div>
        </div>
        <div class="row">
            <div class="grid">
                <div class="grid-sizer col-lg-4 col-md-6 col-sm-12 col-xs-12"></div>
                <a href="{{ route('users.show', ['id' => $user->id]) }}">
                    <div class="grid-item col col-lg-4 col-md-6 col-sm-12 col-xs-12">
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
                <div class="grid-item col col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="bubble">
                        <div class="tagcloud">
                            <h4>Tagcloud</h4>
                            <p>
                            @foreach (Auth::user()->tags as $tag)
                                @if ($tag->color)
                                    <a href="{{ route('tags.show', ['id' => $tag->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-tag" aria-hidden="true" style="color: {{ $tag->color }};"></i> {{ $tag->name }}</a>
                                @else
                                    <a href="{{ route('tags.show', ['id' => $tag->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-tag" aria-hidden="true"></i> {{ $tag->name }}</a>
                                @endif
                            @endforeach
                            </p>
                        </div>
                    </div>
                </div>
                <div class="grid-item col col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="bubble">
                        <div class="quests">
                            <h4>Your created <i class="fa fa-bolt" aria-hidden="true"></i> Quests</h4>
                            @if(count($created_quests))
                                <table class="table table-hover">
                                    @foreach ($created_quests as $quest)
                                        @if ($quest->state != 'open')
                                            <tr class="quest--inactive">
                                        @else
                                            <tr>
                                        @endif
                                        <td><a href="{{ route('quests.show', ['id' => $quest->id]) }}">{{ $quest->name }}</a></td>
                                        <td class="text-center">
                                          <strong>{{ $quest->points }} <i class="fa fa-star" aria-hidden="true"></i></strong>
                                        </td>
                                        <td class="text-right">
                                            <time class="js_moment" datetime="{{ date_format($quest->created_at, 'Y-m-d H:i:s') }}" data-time="{{ date_format($quest->created_at, 'Y-m-d H:i:s') }}">{{ date_format($quest->created_at, 'd.m.Y') }}</time>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            @endif
                            <footer>
                                <a href="{{ route('my-quests')}}" class="btn btn-sm btn-default"><i class="fa fa-list" aria-hidden="true"></i> All Quests</a>
                                <a href="{{ route('quests.create')}}" class="btn btn-sm btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Create New Quest</a>
                            </footer>
                        </div>
                    </div>
                </div>
                <div class="grid-item col col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="bubble">
                        <div class="quests">
                            <h4>Your accepted <i class="fa fa-bolt" aria-hidden="true"></i> Quests</h4>
                            @if(count($accepted_quests))
                                <table class="table table-hover">
                                    @foreach ($accepted_quests as $quest)
                                        @if ($quest->state != 'open')
                                            <tr class="quest--inactive">
                                        @else
                                            <tr>
                                        @endif
                                        <td><a href="{{ route('quests.show', ['id' => $quest->id]) }}">{{ $quest->name }}</a></td>
                                        <td class="text-center">
                                          <strong>{{ $quest->points }} <i class="fa fa-star" aria-hidden="true"></i></strong>
                                        </td>
                                        <td class="text-right">
                                            <time class="js_moment" datetime="{{ date_format($quest->created_at, 'Y-m-d H:i:s') }}" data-time="{{ date_format($quest->created_at, 'Y-m-d H:i:s') }}">{{ date_format($quest->created_at, 'd.m.Y') }}</time>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            @endif
                            <footer>
                                <a href="{{ route('my-quests')}}" class="btn btn-sm btn-default"><i class="fa fa-list" aria-hidden="true"></i> All Quests</a>
                            </footer>
                        </div>
                    </div>
                </div>
                <div class="grid-item col col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="bubble">
                        <div class="projects">
                            <h4>Your created <i class="fa fa-code" aria-hidden="true"></i> Projects</h4>
                            @if(count($projects))
                                <table class="table table-hover">
                                    @foreach ($projects as $project)
                                        <tr>
                                            <td>
                                                <a href="{{ route('projects.show', ['id' => $project->id]) }}">{{ $project->name }}</a>
                                            </td>
                                            <td class="text-right">
                                                <time class="js_moment" datetime="{{ date_format($project->created_at, 'Y-m-d H:i:s') }}" data-time="{{ date_format($project->created_at, 'Y-m-d H:i:s') }}">{{ date_format($project->created_at, 'd.m.Y') }}</time>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endif
                            <footer>
                                <a href="{{ route('my-projects')}}" class="btn btn-sm btn-default"><i class="fa fa-list" aria-hidden="true"></i> All Projects</a>
                                <a href="{{ route('projects.create')}}" class="btn btn-sm btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Create New Project</a>
                            </footer>
                        </div>
                    </div>
                </div>
                @foreach ($user->bubbles as $bubble)
                    @if($bubble->type == 'project')
                        <a href="{{ route('projects.show', ['id' => $bubble->project()->id]) }}">
                    @else
                        <a href="{{ route('quests.show', ['id' => $bubble->quest()->id]) }}">
                    @endif
                        <div class="grid-item col col-lg-4 col-md-6 col-sm-12 col-xs-12">
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
                                    @if($bubble->quest()->language)
                                       <div class="type-description">
                                          <span class="language {{$bubble->quest()->language}}"></span> {{ Quest::getLanguage($bubble->quest()->language) }}
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
            <div>
        </div>

        {{--
        <div class="row">
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
        </div>
        --}}

    </div>
</main>
@endsection
