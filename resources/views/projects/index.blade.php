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
                        <a href="{{ route('my-projects')}}" class="btn btn-sm btn-success"><i class="fa fa-chevron-right" aria-hidden="true"></i> My Projects</a>
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
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="stage">
            <h3>{{ count($projects) }} Projects</h3>
            <hr>
            </div>
            @if(count($projects))
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="80%">Name</th>
                            <th width="20%"></th>
                        </tr>
                    </thead>
                    @foreach ($projects as $project)
                        @if(Auth::check() && ($project->user_id == Auth::user()->id))
                            <tr class="info">
                        @else
                            <tr>
                        @endif
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
                <br><a href="{{ route('projects.create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create New Project</a>
            @endif
        </div>
    </div>
</main>
@endsection
