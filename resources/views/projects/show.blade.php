@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline list-inline--right">
                    @if (Auth::user()->id == $project->user_id)
                        <li>
                            <a href="{{ route('projects.edit', ['id' => $project->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Update Project</a>
                        </li>
                    @endif
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
                {{--
                <ul class="list-inline list-inline--left">
                    <li>
                        <a href="{{ route('projects.index') }}" class="btn btn-sm cut"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>Show All Projects</a>
                    </li>
                </ul>
                --}}
            </div>
        </nav>
    @endif
@endsection

@section('content')
<main class="site_main" role="main">
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
