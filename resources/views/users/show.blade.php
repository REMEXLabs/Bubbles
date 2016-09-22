@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                @if (Auth::user()->id == $user->id)
                    <ul class="list-inline list-inline--right">
                        <li>
                            <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Update Profile</a>
                        </li>
                    </ul>
                @endif
                <ul class="list-inline list-inline--left">
                    <li>
                        <a href="{{ route('users.index') }}" class="btn btn-sm cut"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>Show all Users</a>
                        {{-- <a href="{{ URL::previous() }}" class="btn btn-sm cut"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>Back</a> --}}
                    </li>
                </ul>
            </div>
        </nav>
    @endif
@endsection

@section('content')
<main class="site_main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                {{-- Profile: --}}
                <section class="profile">
                    @if($user->image_url)
                        <img src="{{ $user->image_url }}" class="profile-image img-circle" style="width: 200px; height: 200px;">
                    @endif
                    <h1 class="avatar">{{ $user->username }}</h2>
                    <p>
                        <strong>Experience Points</strong>: {{ $user->points }} / {{ $user->pointsToLevelUp() }}
                    </p>
                    <p>
                        <strong>Level</strong>: {{ $user->level() }}
                    </p>
                    @if ($user->email_public == 1)
                        <p>
                            <strong>E-Mail</strong>: <br> <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                        </p>
                    @endif
                    @if ($user->name)
                        <p>
                            <strong>Name</strong>: <br> {{ $user->name }}
                        </p>
                    @endif
                    @if ($user->bio)
                        <p>
                            <strong>Biography</strong>: <br> {{ $user->bio }}
                        </p>
                    @endif
                </section>

                <section class="profile_sharing">
                  <h3>Profile Sharing</h3>
                  <p>Share your profile by using the following iframe on your site:</p>
                  <p>
                    <textarea class="form-control" name="name" rows="1" cols="150" style="overflow:hidden; resize:none;">
<iframe src="{{ route('embed-profile', ['id' => $user->id]) }}" width="208" height="58" frameborder="0"></iframe>
                    </textarea>
                  </p>
                  <p>The result looks like that:</p>
                  <div class="embedding">
                      <iframe src="{{ route('embed-profile', ['id' => $user->id]) }}" width="208" height="58" frameborder="0"></iframe>
                  </div>
                </section>


                <section class="quests">
                  <h3>Quests</h3>

                  {{-- Resolved quests: --}}
                  <h4>{{ count($user->resolvedQuests) }} resolved Quests</h4>
                  @if(count($user->resolvedQuests))
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
                          @foreach ($user->resolvedQuests as $quest)
                              <tr>
                                  <td><a href="{{ route('quests.show', ['id' => $quest->id]) }}">{{ $quest->name }}</a></td>
                                  <td>{{ Quest::getLanguage($quest->language) }}</td>
                                  <td class="icon-swords state--{{ $quest->difficulty }}">
                                      <span class="icon-swords-child st"></span>
                                      <span class="icon-swords-child nd"></span>
                                      <span class="icon-swords-child td"></span>
                                  </td>
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
                  <h4>{{ count($user->createdQuests) }} created Quests</h4>
                  @if(count($user->createdQuests))
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
                          @foreach ($user->createdQuests as $quest)
                              <tr>
                                  <td><a href="{{ route('quests.show', ['id' => $quest->id]) }}">{{ $quest->name }}</a></td>
                                  <td>{{ Quest::getLanguage($quest->language) }}</td>
                                  <td class="icon-swords state--{{ $quest->difficulty }}">
                                      <span class="icon-swords-child st"></span>
                                      <span class="icon-swords-child nd"></span>
                                      <span class="icon-swords-child td"></span>
                                  </td>
                                  <td>{{ $quest->points }}</td>
                                  <td>
                                      <time class="js_moment" datetime="{{ date_format($quest->created_at, 'Y-m-d H:i:s') }}" data-time="{{ date_format($quest->created_at, 'Y-m-d H:i:s') }}">{{ date_format($quest->created_at, 'd.m.Y') }}</time>
                                  </td>
                              </tr>
                          @endforeach
                      </table>
                  @endif

                </section>

            </div>
        </div>
    </div>
</main>
@endsection
