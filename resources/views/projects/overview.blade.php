@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline list-inline--right">
                    <li>
                        <a href="{{ route('projects.create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create New Project</a>
                    </li>
                    <li>
                        <a href="{{ route('projects.index')}}" class="btn btn-sm btn-success"><i class="fa fa-chevron-left" aria-hidden="true"></i> All Projects</a>
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
                        <a href="{{ route('tags.show', ['id' => $user->id]) }}#projects" class="btn btn-default btn-sm"><i class="fa fa-tag" aria-hidden="true" style="color: {{ $user->color }};"></i> {{ $user->name }}</a>
                    @endforeach
                    </p>
                </section>
                <section class="section" tabindex="0">
                    <h3>{{ count($projects) }} Projects</h3>
                    @if(count($projects))
                        <table class="table">
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
                                    <td>
                                        <time class="js_moment" datetime="{{ date_format($project->created_at, 'Y-m-d H:i:s') }}" data-time="{{ date_format($project->created_at, 'Y-m-d H:i:s') }}">{{ date_format($project->created_at, 'd.m.Y') }}</time>
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
