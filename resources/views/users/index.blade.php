@extends('layouts.app')

{{-- @section('subnav')
    @if (Auth::guest())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline">
                    <li>
                        <a href="{{ route('users.create')}}" class="btn btn-success">Join the community!</a>
                    </li>
                </ul>
            </div>
        </nav>
    @endif
@endsection --}}

@section('content')
<main class="main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="stage">
                    <h3>{{ count($users) }} users</h3>
                    <hr>
                </div>
                @if(count($users))
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="10%">Ranking</th>
                                <th width="70%">Username</th>
                                <th width="10%">Level</th>
                                <th width="10%">Points</th>
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
                                {{ $idx }}
                                <?php $idx++; ?>
                                <?php $prev_pts = $user->points; ?>
                            </td>
                            @else
                                <?php $line = "dashed"; ?>
                                <td style="border-top-style: {{ $line }};"></td>
                            @endif
                            <td style="border-top-style: {{ $line }};">
                                <a href="{{ route('users.show', ['id' => $user->id]) }}">{{ $user->username }}</a>
                            </td>
                            <td style="border-top-style: {{ $line }};">
                                {{ $user->level() }}
                            </td>
                            <td style="border-top-style: {{ $line }};">
                                {{ $user->points }}
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
