@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline list-inline--right">
                    <li>
                        <a href="{{ route('resources.create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create New Resource</a>
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
            <h3>{{ count($resources) }} Resources</h3>
            @if(count($resources))
                <table class="table">
                    <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="20%">Type</th>
                            <th width="50%">Data</th>
                            <th width="20%"></th>
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
                        </tr>
                    @endforeach
                </table>
            @else
                <br><a href="{{ route('resources.create')}}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create New Resource</a>
            @endif
        </div>
    </div>
</main>
@endsection
