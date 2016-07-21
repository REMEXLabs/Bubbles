@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline list-inline--right">
                    @if (Auth::user()->id == $quest->author_id)
                        <li>
                            <a href="{{ route('quests.edit', ['id' => $quest->id]) }}" class="btn btn-primary btn-sm">Update quest</a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('quests.create')}}" class="btn btn-sm btn-success">Create new quest</a>
                    </li>
                </ul>
                <ul class="list-inline list-inline--left">
                    <li>
                        <a href="{{ route('quests.index') }}" class="btn btn-sm cut"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>Show all quests</a>
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
                <h1>{{ $quest->name }}</h1>
                @if ($quest->description)
                    <p><strong>Quest owner</strong>: <br> <a href="{{ route('users.show', ['id' => $quest->author_id]) }}">{{ $quest->author()->username }}</a></p>
                @endif
                @if ($quest->description)
                    <p><strong>Description</strong>: <br> {{ $quest->description }}</p>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
