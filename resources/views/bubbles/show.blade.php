@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline list-inline--right">
                    @if (Auth::user()->id == $bubble->user_id)
                        <li>
                            <a href="{{ route('bubbles.edit', ['id' => $bubble->id]) }}" class="btn btn-default btn-sm">Update bubble</a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('bubbles.create')}}" class="btn btn-sm btn-success">Create new bubble</a>
                    </li>
                </ul>
                <ul class="list-inline list-inline--left">
                    <li>
                        <a href="{{ route('bubbles.index') }}" class="btn btn-sm cut"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>Show all bubbles</a>
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
                @if($bubble->type == 'project')
                    <h1>{{ $bubble->project()->name }}</h1>
                    <p><a href="{{ route('projects.show', ['id' => $bubble->project()->id ]) }}">Go to project details</a>.</p>
                @endif
                @if($bubble->type == 'quest')
                    <h1>{{ $bubble->quest()->name }}</h1>
                    <p><a href="{{ route('quests.show', ['id' => $bubble->quest()->id ]) }}">Go to quest details</a>.</p>
                @endif
                <p><strong>Type</strong>: <br> {{ Bubble::getTypes()[$bubble->type] }}</p>
                <p><strong>Order</strong>: <br> {{ $bubble->order }}</p>
            </div>
        </div>
    </div>
</main>
@endsection
