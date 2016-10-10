@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline list-inline--right">
                    <li>
                        <a href="{{ route('tags.create')}}" class="btn btn-sm btn-success"><i class="fa fa-tag" aria-hidden="true"></i> Create New Tag</a>
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
                <section class="section">
                    <h3>{{ count($tags) }} Tags</h3>
                    @if(count($tags))
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="10%">ID</th>
                                    <th width="20%">Type</th>
                                    <th width="50%">Data</th>
                                    <th width="20%"></th>
                                </tr>
                            </thead>
                            @foreach ($tags as $tag)
                                <tr>
                                    <td><a href="{{ route('tags.show', ['id' => $tag->id]) }}">{{ $tag->id }}</a></td>
                                    <td>{{ $tag->type }}</td>
                                    <td>{{ $tag->data }}</td>
                                    <td>
                                        <time class="js_moment" datetime="{{ date_format($tag->created_at, 'Y-m-d H:i:s') }}" data-time="{{ date_format($tag->created_at, 'Y-m-d H:i:s') }}">{{ date_format($tag->created_at, 'd.m.Y') }}</time>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <br><a href="{{ route('tags.create')}}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create New Tag</a>
                    @endif
                </section>
            </div>
        </div>
    </div>
</main>
@endsection
