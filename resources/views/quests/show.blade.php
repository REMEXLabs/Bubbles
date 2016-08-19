@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline list-inline--right">
                    @if (Auth::user()->id == $quest->author_id)
                        <li>
                            <a href="{{ route('quests.edit', ['id' => $quest->id]) }}" class="btn btn-default btn-sm">Update quest</a>
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
                    <p>
                        The quest is open.
                    </p>
                    @if (Auth::check())
                        @if (Auth::user()->id != $quest->author_id)
                            <p>
                                If you solve the quest, you will get <strong>{{ $quest->points }} points</strong>.
                            </p>
                            <p>
                                <a href="{{ route('quests.accept', ['id' => $quest->id]) }}" class="btn btn-primary">Accept the quest!</a>
                            </p>
                        @endif
                    @endif
                @elseif ($quest->state == 'wip')
                    <p>
                        The quest is running.
                    </p>
                    @if ($quest->editor_id == Auth::user()->id)
                        <p>
                            <a href="{{ route('quests.finish', ['id' => $quest->id]) }}" class="btn btn-primary">Mark quest as done!</a>
                            <a href="{{ route('quests.reopen', ['id' => $quest->id]) }}" class="btn btn-default">Reopen quest.</a>
                        </p>
                    @else
                        <p>
                            The editor is <a href="{{ route('users.show', ['id' => $quest->editor_id]) }}">{{ $quest->editor()->username }}</a>.
                        </p>
                    @endif
                @elseif ($quest->state == 'check')
                  <p>
                      The editor <a href="{{ route('users.show', ['id' => $quest->editor_id]) }}">{{ $quest->editor()->username }}</a> has finished the quest.
                  </p>
                  @if ($quest->author_id == Auth::user()->id)
                      <p>
                          <a href="{{ route('quests.close', ['id' => $quest->id]) }}" class="btn btn-primary">Mark quest as done!</a>
                          <a href="{{ route('quests.reopen', ['id' => $quest->id]) }}" class="btn btn-default">Reopen quest.</a>
                      </p>
                  @else
                    <p>
                        Now the quest owner <a href="{{ route('users.show', ['id' => $quest->author_id]) }}">{{ $quest->author()->username }}</a> has to check the result.
                    </p>
                  @endif
                @else
                    <p>
                        The quest was successfully resolved by <a href="{{ route('users.show', ['id' => $quest->editor_id]) }}">{{ $quest->editor()->username }}</a>.
                    </p>
                @endif
                </p>
            </div>
        </div>
    </div>
</main>
@endsection
