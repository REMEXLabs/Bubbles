@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline list-inline--right">
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
                <section class="section" tabindex="0">
                    <h3>{{ count($resources) }} Resources</h3>
                    @if(count($resources))
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="15%">Type</th>
                                    <th width="45%">Data</th>
                                    <th width="20%"></th>
                                    <th width="20%"></th>
                                </tr>
                            </thead>
                            @foreach ($resources as $resource)
                                <tr>
                                    <td>
                                        @if ($resource->type == 'img')
                                            <i class="fa fa-picture-o" aria-hidden="true"></i> Image
                                        @elseif ($resource->type == 'git')
                                            <i class="fa fa-git" aria-hidden="true"></i> Repository
                                        @elseif ($resource->type == 'url')
                                          <i class="fa fa-link" aria-hidden="true"></i> URL
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ $resource->data }}">{{ ((strlen($resource->data) > 40) ? '...' : '') }}{{ substr($resource->data, -40) }}</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('resources.show', ['id' => $resource->id]) }}" class="btn btn-default btn-sm">Open Details</a>
                                    </td>
                                    <td class="text-right">
                                        <time class="js_moment" datetime="{{ date_format($resource->created_at, 'Y-m-d H:i:s') }}" data-time="{{ date_format($resource->created_at, 'Y-m-d H:i:s') }}">{{ date_format($resource->created_at, 'd.m.Y') }}</time>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <br><a href="{{ route('resources.create')}}" class="btn btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create New Resource</a>
                    @endif
                </section>
            </div>
        </div>
    </div>
</main>
@endsection
