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
                        <a href="{{ route('bubbles.create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Bubble</a>
                    </li>
                    <li>
                        <a href="{{ route('quests.create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Quest</a>
                    </li>
                    <li>
                        <a href="{{ route('projects.create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Project</a>
                    </li>
                    <li>
                        <a href="{{ route('resources.create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Resource</a>
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
@endsection

@section('content')
<main class="site_main" role="main">
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
                    <div class="grid-item col col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="bubble" tabindex="0">
                            <header>
                                <div class="info">
                                    <div class="user-avatar">
                                        @if($user->image_url)
                                            <img src="{{ $user->image_url }}" class="profile-image img-circle" style="width: 150px; height: 150px;">
                                        @else
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                        @endif
                                    </div>
                                    <h2><a href="{{ route('users.show', ['id' => $user->id]) }}">{{ $user->username }}</a></h2>
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
                <div class="grid-item col col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="bubble fix" tabindex="0">
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
                            <footer style="text-align: left;">
                                <a href="{{ route('tags.create')}}" class="btn btn-sm btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Create New Tag</a>
                            </footer>
                        </div>
                    </div>
                </div>
                <div class="grid-item col col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="bubble fix" tabindex="0">
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
                                <a href="{{ route('my-quests')}}" class="btn btn-sm btn-default"><i class="fa fa-list" aria-hidden="true"></i> My Quests</a>
                                <a href="{{ route('quests.create')}}" class="btn btn-sm btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Create Quest</a>
                            </footer>
                        </div>
                    </div>
                </div>
                <div class="grid-item col col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="bubble fix" tabindex="0">
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
                                <a href="{{ route('my-quests')}}" class="btn btn-sm btn-default"><i class="fa fa-list" aria-hidden="true"></i> My Quests</a>
                                <a href="{{ route('quests.index')}}" class="btn btn-sm btn-default"><i class="fa fa-search" aria-hidden="true"></i> Search New Quest</a>
                            </footer>
                        </div>
                    </div>
                </div>
                <div class="grid-item col col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="bubble fix" tabindex="0">
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
                                <a href="{{ route('my-projects')}}" class="btn btn-sm btn-default"><i class="fa fa-list" aria-hidden="true"></i> My Projects</a>
                                <a href="{{ route('projects.create')}}" class="btn btn-sm btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Create Project</a>
                            </footer>
                        </div>
                    </div>
                </div>
                @foreach ($user->bubbles as $bubble)
                <div class="grid-item col col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    @if($bubble->type == 'project')
                    <div class="bubble project" id="b{{ $bubble->id }}" tabindex="0">
                    @else
                    <div class="bubble quest" id="b{{ $bubble->id }}" tabindex="0">
                    @endif
                        @if($bubble->type == 'project')
                            <header class="info">
                                <div class="type-icon"><i class="fa fa-code" aria-hidden="true"></i></div>
                                <h2><a href="{{ route('projects.show', ['id' => $bubble->project()->id]) }}" tabindex="0">{{ $bubble->project()->name }}</a></h2>
                                <div class="type-subline">Project</div>
                            </header>
                            @if($bubble->project()->description)
                               <div class="info type-description">{{ $bubble->project()->description }}</div>
                            @endif
                        @endif
                        @if($bubble->type == 'quest')
                            <header class="info">
                                <div class="type-icon"><i class="fa fa-bolt" aria-hidden="true"></i></div>
                                <h2><a href="{{ route('quests.show', ['id' => $bubble->quest()->id]) }}" tabindex="0">{{ $bubble->quest()->name }}</a></h2>
                                <div class="type-subline">{{ $bubble->quest()->points }} <i class="fa fa-star" aria-hidden="true"></i> Quest</div>
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
                            @if($bubble->type == 'quest')
                                <a href="{{ route('quests.add_resource', ['id' => $bubble->quest()->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Resource</a>
                            @else
                                <a href="{{ route('projects.add_resource', ['id' => $bubble->project()->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Resource</a>
                            @endif
                            <a href="{{ route('bubbles.show', ['id' => $bubble->id]) }}#sharing" class="btn btn-default btn-sm"><i class="fa fa-share-alt" aria-hidden="true"></i> Share</a>
                            <time class="js_moment" datetime="{{ date_format($bubble->created_at, 'Y-m-d H:i:s') }}" data-time="{{ date_format($bubble->created_at, 'Y-m-d H:i:s') }}">{{ date_format($bubble->created_at, 'd.m.Y') }}</time>
                        </footer>
                    </div>
                </div>
                @endforeach
            <div>
        </div>

    </div>
</main>
@endsection
