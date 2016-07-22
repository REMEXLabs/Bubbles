@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline list-inline--right">
                    <li>
                        <a href="{{ route('resources.create')}}" class="btn btn-sm btn-success">Create new resource</a>
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
            <h3>{{ count($resources) }} resources</h3>
            @if(count($resources))
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Data</th>
                            <th>Created at</th>
                        </tr>
                    </thead>
                    @foreach ($resources as $resource)
                        <tr>
                            <td><a href="{{ route('resources.show', ['id' => $resource->id]) }}">{{ $resource->id }}</a></td>
                            <td>{{ $resource->type }}</td>
                            <td>{{ $resource->data }}</td>
                            <td>{{ date_format($resource->created_at, 'd.m.Y') }}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
</main>
@endsection