@extends('layouts.app')

@section('css')
.content ul {
    padding: 0;
    list-style: none;
}
.content h2{
    padding-bottom: 10px;
}
@endsection

@section('content')
<div class="container content">
    <div class="row">
        <div class="col-md-12">
            <h2>{{ count($projects) }} projects</h2>
            @if(count($projects))
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                        </tr>
                    </thead>
                    @foreach ($projects as $project)
                        <tr>
                            <td>
                                <a href="{{ route('projects.show', ['id' => $project->id]) }}">{{ $project->name }}</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
            @if (Auth::check())
                <hr>
                <a href="{{ route('projects.create')}}" class="btn btn-success">Create new project</a>
            @endif
        </div>
    </div>
</div>
@endsection
