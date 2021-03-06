@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline list-inline--right">
                    @if (Auth::user()->id == $resource->author_id)
                        <li>
                            <a href="{{ route('resources.edit', ['id' => $resource->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Update Resource</a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('resources.create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create New Resource</a>
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
                <p><strong>Resource Owner</strong>: <br> <a href="{{ route('resources.show', ['id' => $resource->author_id]) }}">{{ $resource->author()->username }}</a></p>
                @if ($resource->type)
                    <p><strong>Type</strong>: <br> {{ Resource::getTypes()[$resource->type] }}</p>
                @endif
                @if ($resource->data)
                    <p><strong>Data</strong>:<br>
                    @if ($resource->type == 'git' || $resource->type == 'url')
                        <a href="{{ $resource->data }}" target="_resource_{{ $resource->id }}">{{ $resource->data }}</a>
                    @elseif ($resource->type == 'img')
                        <img src="{{ $resource->data }}" alt="{{ $resource->description }}" style="width: 200px;"/>
                    @endif
                    </p>
                @endif
                @if ($resource->description)
                    <p><strong>Description</strong>: <br> {{ $resource->description }}</p>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
