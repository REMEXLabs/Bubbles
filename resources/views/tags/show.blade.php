@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline list-inline--right">
                    @if (Auth::user()->id == $tag->author_id)
                        <li>
                            <a href="{{ route('tags.edit', ['id' => $tag->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Update Tag</a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('tags.create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create New Tag</a>
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
                <section class="section center" tabindex="0">
                    <h1>Tag</h1>
                    @if ($tag->color)
                        <h4><i class="fa fa-tag" aria-hidden="true" style="color: {{ $tag->color }};"></i> {{ $tag->name }}</h4>
                    @else
                        <h4><i class="fa fa-tag" aria-hidden="true"></i> {{ $tag->name }}</h4>
                    @endif
                </section>
                <section class="section" id="quests" tabindex="0">
                    <h3>Quests</h3>
                    @if(count($quests))
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
                    @endif
                </section>
                <section class="section" id="projects" tabindex="0">
                    <h3>Projects</h3>
                    @if(count($projects))
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
                    @endif
                </section>
                <section class="section" tabindex="0">
                    <h3>All Tags</h3>
                    <p>
                    @foreach (Auth::user()->tags as $user_tag)
                        <a href="{{ route('tags.show', ['id' => $user_tag->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-tag" aria-hidden="true" style="color: {{ $user_tag->color }};"></i> {{ $user_tag->name }}</a>
                    @endforeach
                    </p>
                </section>
            </div>
        </div>
    </div>
</main>
@endsection
