@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline list-inline--right">
                    @if (Auth::user()->id == $project->user_id)
                        <li>
                            <a href="{{ route('projects.edit', ['id' => $project->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Update Project</a>
                        </li>
                        <li>
                            <a href="{{ route('projects.add_resource', ['id' => $project->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add Resource</a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('projects.create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create New Project</a>
                    </li>
                    <li>
                        <a href="{{ route('projects.index')}}" class="btn btn-sm btn-success"><i class="fa fa-chevron-left" aria-hidden="true"></i> All Projects</a>
                    </li>
                    <li aria-hidden="true">
                        <a href="{{ url('/')}}" class="btn btn-sm btn-success"><i class="fa fa-home" aria-hidden="true"></i></a>
                    </li>
                </ul>
                {{--
                <ul class="list-inline list-inline--left">
                    <li>
                        <a href="{{ route('projects.index') }}" class="btn btn-sm cut"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>Show All Projects</a>
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
                    <h1>{{ $project->name }}</h1>
                    @if ($project->description)
                        <p><strong>Project owner</strong>: <br> <a href="{{ route('users.show', ['id' => $project->user_id]) }}">{{ $project->user()->username }}</a></p>
                    @endif
                    @if ($project->description)
                        <p><strong>Description</strong>: <br> {{ $project->description }}</p>
                    @endif
                </section>
                <section class="section" tabindex="0">
                    <h3>Resources ({{ count($project->resources) }})</h3>
                    @if (count($project->resources))
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
                            @foreach ($project->resources as $resource)
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
                                        <a href="{{ route('resources.show', ['id' => $resource->id]) }}" class="btn btn-default btn-sm">Open Details</a> <a href="{{ route('projects.delete_resource', ['project_id' => $project->id, 'resource_id' => $resource->id ]) }}" class="btn btn-warning btn-sm">Remove</a>
                                    </td>
                                    <td class="text-right">
                                        <time class="js_moment" datetime="{{ date_format($resource->created_at, 'Y-m-d H:i:s') }}" data-time="{{ date_format($resource->created_at, 'Y-m-d H:i:s') }}">{{ date_format($resource->created_at, 'd.m.Y') }}</time>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                    @if (Auth::check() && Auth::user()->id == $project->user_id)
                        <a href="{{ route('projects.add_resource', ['id' => $project->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add Resource</a>
                    @endif
                </section>
                @if (Auth::check() && $project->user_id == Auth::user()->id)
                    <section class="section tags" tabindex="0">
                        <h3>Tags ({{ count($project->tags) }})</h3>
                        @foreach ($project->tags as $tag)
                            <div class="tag--delete" style="padding-right: 8px; display: inline-block;">
                                <a href="{{ route('tags.show', ['id' => $tag->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-tag" aria-hidden="true" style="color: {{ $tag->color }};"></i> {{ $tag->name }}</a>
                                <a href="{{ route('projects.delete_tag', ['project_id' => $project->id, 'tag_id' => $tag->id]) }}" class="btn btn-default btn-sm" style="margin-left: -1px;"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </div>
                        @endforeach
                        @if (count(Auth::user()->tags))
                            <hr>
                            <p>Add new tag by clicking on one of the following tags:</p>
                            @foreach (Auth::user()->tags as $user_tag)
                                <?php
                                    $show = true;
                                foreach ($project->tags as $i => $project_tag) {
                                    if ($user_tag->id == $project_tag->pivot->tag_id) {
                                        $show = false;
                                        break;
                                    }
                                }
                                ?>
                                @if ($show)
                                    <a href="{{ route('projects.store_tag', ['project_id' => $project->id, 'tag_id' => $user_tag->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-tag" aria-hidden="true" style="color: {{ $user_tag->color }};"></i> {{ $user_tag->name }}</a>
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
