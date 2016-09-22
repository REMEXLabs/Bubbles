@extends('layouts.app')

@section('content')
<main class="site_main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <section class="section quests">
                    <h4>Found {{ $n_quests }} quests</h4>
                    @if($n_quests)
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
                                  <strong>{{ $quest->points }} <i class="fa fa-star" aria-hidden="true"></i></strong>
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
                    @else
                        <p>Found no matches.</p>
                    @endif
                </section>
                <section class="section projects">
                    <h4>Found {{ $n_projects }} projects</h4>
                    @if($n_projects)
                      <table class="table table-hover">
                          <thead>
                              <tr>
                                  <th width="80%">Name</th>
                                  <th width="20%"></th>
                              </tr>
                          </thead>
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
                    @else
                        <p>Found no matches.</p>
                    @endif
                </section>
                <section class="section users">
                    <h4>Found {{ $n_users }} users</h4>
                    @if($n_users)
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="70%">Username</th>
                                    <th class="text-center" width="10%">Level</th>
                                    <th class="text-center" width="10%">Points</th>
                                </tr>
                            </thead>
                            @foreach ($users as $key => $user)
                            <tr>
                                <td>
                                    @if ($user->image_url)
                                        <a href="{{ route('users.show', ['id' => $user->id]) }}"><img src="{{ $user->image_url }}" width="22px" height="22px" style="float: left; margin: 0 6px 0 0; border-radius: 2px;"/> {{ $user->username }}</a>
                                    @else
                                        <a href="{{ route('users.show', ['id' => $user->id]) }}"><span style="width: 22px; height: 22px; float: left; margin: 0 6px 0 0; border-radius: 2px; background: #ddd; text-align:center; line-height: 22px; color: black; font-size: 13px;"><i class="fa fa-user" aria-hidden="true"></i></span> {{ $user->username }}</a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ $user->level() }}
                                </td>
                                <td class="text-center">
                                    <strong>{{ $user->points }} <i class="fa fa-star" aria-hidden="true"></i></strong>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    @else
                        <p>Found no matches.</p>
                    @endif
                </section>
            </div>
        </div>
    </div>
</main>
@endsection
