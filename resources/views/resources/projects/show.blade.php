@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline list-inline--right">
                    @if (Auth::user()->id == $project->user_id)
                        <li>
                            <a href="{{ route('projects.edit', ['id' => $project->id]) }}" class="btn btn-primary btn-sm">Update project</a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('projects.create')}}" class="btn btn-sm btn-success">Create new project</a>
                    </li>
                </ul>
                <ul class="list-inline list-inline--left">
                    <li>
                        <a href="{{ route('projects.index') }}" class="btn btn-sm cut"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>Show all projects</a>
                        {{-- <a href="{{ URL::previous() }}" class="btn btn-sm cut"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>Back</a> --}}
                    </li>
                </ul>
            </div>
        </nav>
    @endif
@endsection

@section('content')
<main class="main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $project->name }}</h1>
                @if ($project->description)
                    <p><strong>Project owner</strong>: <br> <a href="{{ route('users.show', ['id' => $project->user_id]) }}">{{ $project->user()->username }}</a></p>
                @endif
                @if ($project->description)
                    <p><strong>Description</strong>: <br> {{ $project->description }}</p>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
