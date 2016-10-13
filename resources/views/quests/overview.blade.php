@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline list-inline--right">
                    <li>
                        <a href="{{ route('quests.create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create New Quest</a>
                    </li>
                    <li>
                        <a href="{{ route('quests.index')}}" class="btn btn-sm btn-success"><i class="fa fa-chevron-left" aria-hidden="true"></i> All Quests</a>
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
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <section class="section" tabindex="0">
                    <h3>All Tags</h3>
                    <p>
                    @foreach (Auth::user()->tags as $user)
                        <a href="{{ route('tags.show', ['id' => $user->id]) }}#quests" class="btn btn-default btn-sm"><i class="fa fa-tag" aria-hidden="true" style="color: {{ $user->color }};"></i> {{ $user->name }}</a>
                    @endforeach
                    </p>
                    <br><a href="{{ route('tags.create')}}" class="btn btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create New Tag</a>
                </section>

                {{-- Created quests: --}}
                <section class="section" tabindex="0">
                    <h3>{{ count($created_quests) }} created Quests</h3>
                    @if(count($created_quests))
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
                          @foreach ($created_quests as $quest)
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
                    @endif
                </section>

                {{-- Accepted quests: --}}
                <section class="section" tabindex="0">
                    <h3>{{ count($accepted_quests) }} accepted Quests</h3>
                    @if(count($accepted_quests))
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
                          @foreach ($accepted_quests as $quest)
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
                    @endif
                </section>

                {{-- Checking quests: --}}
                <section class="section" tabindex="0">
                    <h3>{{ count($checking_quests) }} to be checked Quests</h3>
                    @if(count($checking_quests))
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
                          @foreach ($checking_quests as $quest)
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
                    @endif
                </section>

                {{-- Resolved quests: --}}
                <section class="section" tabindex="0">
                    <h3>{{ count($resolved_quests) }} resolved Quests</h3>
                    @if(count($resolved_quests))
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
                          @foreach ($resolved_quests as $quest)
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
                    @endif
                </section>

            </div>
        </div>
    </div>
</main>
@endsection
