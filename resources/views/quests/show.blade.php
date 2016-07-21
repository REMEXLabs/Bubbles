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
                @if ($quest->language)
                    <p><strong>Language</strong>: <br> {{ $quest->language }}</p>
                @endif
                @if ($quest->difficulty)
                    <p><strong>Difficulty</strong>: <br> {{ $quest->difficulty }}</p>
                @endif
                <p>
                @if ($quest->state == 'open')
                    <i>The quest is open.</i>
                    @if (Auth::user()->id != $quest->author_id)
                        {{-- TODO: Add link to get the quest. --}}
                        <strong>Take it now!</strong>
                    @endif
                @elseif ($quest->state == 'wip')
                    The quest is running.
                    @if ($quest->editor_id)
                        The editor is <a href="{{ route('users.show', ['id' => $quest->editor_id]) }}">{{ $quest->editor()->username }}</a>
                    @endif
                @else
                    @if ($quest->editor_id)
                        The quest is closed by <a href="{{ route('users.show', ['id' => $quest->editor_id]) }}">{{ $quest->editor()->username }}</a>.
                    @endif
                @endif
                </p>


            </div>
        </div>
    </div>
</main>
@endsection
