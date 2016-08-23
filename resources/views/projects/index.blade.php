@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline list-inline--right">
                    <li>
                        <a href="{{ route('projects.create')}}" class="btn btn-sm btn-success">Create new project</a>
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
<main class="main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <h3>{{ count($projects) }} projects</h3>
            @if(count($projects))
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
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
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
</main>
@endsection
