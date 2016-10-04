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
                <h3>Add Resource</h3>
                @if(count($resources))
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">Type</th>
                                <th width="30%">Data</th>
                                <th width="20%"></th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                        @foreach ($resources as $resource)
                            <tr>
                                <td><a href="{{ route('resources.show', ['id' => $resource->id]) }}">{{ $resource->id }}</a></td>
                                <td>{{ $resource->type }}</td>
                                <td>{{ $resource->data }}</td>
                                <td>
                                    <time class="js_moment" datetime="{{ date_format($resource->created_at, 'Y-m-d H:i:s') }}" data-time="{{ date_format($resource->created_at, 'Y-m-d H:i:s') }}">{{ date_format($resource->created_at, 'd.m.Y') }}</time>
                                </td>
                                <td>
                                  <a href="{{ route('projects.store_resource', ['project_id' => $project->id, 'resource_id' => $resource->id ]) }}">Add</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <br><a href="{{ route('resources.create')}}" class="btn btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create New Resource</a>
                @endif
            <div>
        </div>
    </div>
</main>
@endsection
