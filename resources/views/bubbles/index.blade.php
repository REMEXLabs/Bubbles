@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline list-inline--right">
                    <li>
                        <a href="{{ route('bubbles.create')}}" class="btn btn-sm btn-success">Create new bubble</a>
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
                <h3>{{ count($bubbles) }} bubbles</h3>
                @if(count($bubbles))
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="40%">Name</th>
                                <th width="20%">Type</th>
                                <th width="20%">Order</th>
                                <th width="20%"></th>
                            </tr>
                        </thead>
                        @foreach ($bubbles as $bubble)
                            <tr>
                                @if($bubble->type == 'project')
                                    <td><a href="{{ route('bubbles.show', ['id' => $bubble->id]) }}">{{ $bubble->project()->name }}</a></td>
                                @endif
                                @if($bubble->type == 'quest')
                                    <td><a href="{{ route('bubbles.show', ['id' => $bubble->id]) }}">{{ $bubble->quest()->name }}</a></td>
                                @endif
                                <td>{{ Bubble::getType($bubble->type) }}</td>
                                <td>{{ $bubble->order }}</td>
                                <td>
                                    <time class="js_moment" datetime="{{ date_format($bubble->created_at, 'Y-m-d H:i:s') }}" data-time="{{ date_format($bubble->created_at, 'Y-m-d H:i:s') }}">{{ date_format($bubble->created_at, 'd.m.Y') }}</time>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
