@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline list-inline--right">
                    @if (Auth::user()->id == $quest->author_id)
                        <li>
                            <a href="{{ route('quests.edit', ['id' => $quest->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Update Quest</a>
                        </li>
                        <li>
                            <a href="{{ route('quests.add_resource', ['id' => $quest->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add Resource</a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('quests.create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create New Quest</a>
                    </li>
                    <li>
                        <a href="{{ route('quests.index')}}" class="btn btn-sm btn-success"><i class="fa fa-chevron-left" aria-hidden="true"></i> All Quests</a>
                    </li>
                    <li aria-hidden="true">
                        <a href="{{ url('/')}}" class="btn btn-sm btn-success"><i class="fa fa-home" aria-hidden="true"></i></a>
                    </li>
                </ul>
                {{--
                <ul class="list-inline list-inline--left">
                    <li>
                        <a href="{{ route('quests.index') }}" class="btn btn-sm cut"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>All Quests</a>
                    </li>
                </ul>
                --}}
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
                    <h1>{{ $quest->name }}</h1>
                    @if ($quest->description)
                        <p><strong>Quest owner</strong>: <br> <a href="{{ route('users.show', ['id' => $quest->author_id]) }}">{{ $quest->author()->username }}</a></p>
                    @endif
                    @if ($quest->description)
                        <p><strong>Description</strong>: <br> {{ $quest->description }}</p>
                    @endif
                    @if ($quest->language)
                        <p><strong>Language</strong>: <br> <span class="language {{$quest->language}}"></span> {{ Quest::getLanguage($quest->language) }}</p>
                    @endif
                    @if ($quest->difficulty)
                        <div>
                          <p>
                            <strong>Difficulty</strong>:
                          </p>
                          <div class="icon-swords state--{{ $quest->difficulty }}">
                              <span class="icon-swords-child st"></span>
                              <span class="icon-swords-child nd"></span>
                              <span class="icon-swords-child td"></span>
                          </div>
                        </div>
                    @endif
                </section>
                <section class="section" tabindex="0">
                    <h3>Resources ({{ count($quest->resources) }})</h3>
                    @if (count($quest->resources))
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="15%">Type</th>
                                <th width="45%">Data</th>
                                <th width="20%"></th>
                                <th width="20%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quest->resources as $resource)
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
                                        <a href="{{ route('resources.show', ['id' => $resource->id]) }}" class="btn btn-default btn-sm">Open Details</a> <a href="{{ route('quests.delete_resource', ['quest_id' => $quest->id, 'resource_id' => $resource->id ]) }}" class="btn btn-warning btn-sm">Remove</a>
                                    </td>
                                    <td class="text-right">
                                        <time class="js_moment" datetime="{{ date_format($resource->created_at, 'Y-m-d H:i:s') }}" data-time="{{ date_format($resource->created_at, 'Y-m-d H:i:s') }}">{{ date_format($resource->created_at, 'd.m.Y') }}</time>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                    @if (Auth::user()->id == $quest->author_id)
                        <a href="{{ route('quests.add_resource', ['id' => $quest->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add Resource</a>
                    @endif
                </section>
                <section class="section" tabindex="0">
                    <h3>Status</h3>
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
                                    <a href="{{ route('quests.accept', ['id' => $quest->id]) }}" class="btn btn-success">Accept the quest!</a>
                                </p>
                            @endif
                        @endif
                    @elseif ($quest->state == 'wip')
                        <p>
                            The quest is running.
                        </p>
                        @if ($quest->editor_id == Auth::user()->id)
                            <p>
                                <a href="{{ route('quests.finish', ['id' => $quest->id]) }}" class="btn btn-success">Mark quest as done!</a>
                                <a href="{{ route('quests.reopen', ['id' => $quest->id]) }}" class="btn btn-default">Reopen quest.</a>
                            </p>
                        @else
                            <p>
                                The editor is <a href="{{ route('users.show', ['id' => $quest->editor_id]) }}">{{ $quest->editor()->username }}</a>.
                            </p>
                        @endif
                    @elseif ($quest->state == 'check')
                        @if ($quest->editor_id == Auth::user()->id)
                            <p>
                                You have finished the quest.
                            </p>
                        @else
                            <p>
                                The editor <a href="{{ route('users.show', ['id' => $quest->editor_id]) }}">{{ $quest->editor()->username }}</a> has finished the quest.
                            </p>
                        @endif
                        @if ($quest->author_id == Auth::user()->id)
                            <p>
                                <a href="{{ route('quests.close', ['id' => $quest->id]) }}" class="btn btn-success">Mark quest as done</a>
                                <a href="{{ route('quests.reopen', ['id' => $quest->id]) }}" class="btn btn-default">Reopen quest</a>
                            </p>
                        @else
                            <p>
                                Now the quest owner <a href="{{ route('users.show', ['id' => $quest->author_id]) }}">{{ $quest->author()->username }}</a> has to check the result.
                            </p>
                        @endif
                    @else
                        @if ($quest->editor_id == Auth::user()->id)
                            <p>
                                You resolved the quest successfully.
                            </p>
                        @else
                            <p>
                                The quest was successfully resolved by <a href="{{ route('users.show', ['id' => $quest->editor_id]) }}">{{ $quest->editor()->username }}</a>.
                            </p>
                        @endif
                    @endif
                </section>
                @if ($quest->author_id == Auth::user()->id)
                    <section class="section tags" tabindex="0">
                        <h3>Tags ({{ count($quest->tags) }})</h3>
                        @foreach ($quest->tags as $tag)
                            <div class="tag--delete" style="padding-right: 8px; display: inline-block;">
                                <a href="{{ route('tags.show', ['id' => $tag->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-tag" aria-hidden="true" style="color: {{ $tag->color }};"></i> {{ $tag->name }}</a>
                                <a href="{{ route('quests.delete_tag', ['quest_id' => $quest->id, 'tag_id' => $tag->id]) }}" class="btn btn-default btn-sm" style="margin-left: -1px;"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </div>
                        @endforeach
                        @if (count(Auth::user()->tags))
                            <hr>
                            <p>Add new tag by clicking on one of the following tags:</p>
                            @foreach (Auth::user()->tags as $user_tag)
                                <?php
                                    $show = true;
                                foreach ($quest->tags as $i => $quest_tag) {
                                    if ($user_tag->id == $quest_tag->pivot->tag_id) {
                                        $show = false;
                                        break;
                                    }
                                }
                                ?>
                                @if ($show)
                                    <a href="{{ route('quests.store_tag', ['quest_id' => $quest->id, 'tag_id' => $user_tag->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-tag" aria-hidden="true" style="color: {{ $user_tag->color }};"></i> {{ $user_tag->name }}</a>
                                @endif
                            @endforeach
                        @endif
                    </section>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
