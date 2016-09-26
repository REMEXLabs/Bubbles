@extends('layouts.app')

@section('subnav')
@if (Auth::check())
<nav class="navbar subnav" role="navigation">
    <div class="container">
        <ul class="list-inline list-inline--right">
            <li>
                <a href="{{ route('users.show', ['id' => Auth::user()->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a>
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
                <div class="stage">
                    <h3>{{ count($users) }} Users</h3>
                    <hr>
                </div>
                @if(count($users))
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="10%">Ranking</th>
                                <th width="70%">Username</th>
                                <th class="text-center" width="10%">Level</th>
                                <th class="text-center" width="10%">Points</th>
                                {{-- <th width="10%">Quests</th> --}}
                            </tr>
                        </thead>
                        <?php $idx = 1; ?>
                        <?php $prev_pts = -1; ?>
                        @foreach ($users as $key => $user)
                            @if(Auth::check() && ($user->id == Auth::user()->id))
                                <tr class="info">
                            @else
                                <tr>
                            @endif
                            <?php $line = "solid"; ?>
                            @if ($user->points != $prev_pts)
                            <td>
                                {{ $idx }}.
                                <?php $idx++; ?>
                                <?php $prev_pts = $user->points; ?>
                            </td>
                            @else
                                <?php $line = "dashed"; ?>
                                <td style="border-top-style: {{ $line }};"></td>
                            @endif
                            <td style="border-top-style: {{ $line }};">
                                @if ($user->image_url)
                                    <a href="{{ route('users.show', ['id' => $user->id]) }}"><img src="{{ $user->image_url }}" width="22px" height="22px" style="float: left; margin: 0 6px 0 0; border-radius: 2px;"/> {{ $user->username }}</a>
                                @else
                                    <a href="{{ route('users.show', ['id' => $user->id]) }}"><span style="width: 22px; height: 22px; float: left; margin: 0 6px 0 0; border-radius: 2px; background: #ddd; text-align:center; line-height: 22px; color: black; font-size: 13px;"><i class="fa fa-user" aria-hidden="true"></i></span> {{ $user->username }}</a>
                                @endif
                            </td>
                            <td class="text-center" style="border-top-style: {{ $line }};">
                                {{ $user->level() }}
                            </td>
                            <td class="text-center" style="border-top-style: {{ $line }};">
                                <strong>{{ $user->points }} <i class="fa fa-star" aria-hidden="true"></i></strong>
                            </td>
                            {{-- <td>
                              {{ count($user->resolvedQuests) }}
                            </td> --}}
                        </tr>
                        @endforeach
                    </table>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
