@extends('layouts.app')

@section('css')
.content .actions {
    float: right;
    padding-top: 20px;
}
dt, dd {
    padding-bottom: 3px;
}
@endsection

@section('content')
<div class="content container">
    <div class="row">
        <div class="col-md-12">
            {{-- @if (Auth::check() && Auth::user()->id == $user->id)
            <div class="actions clearfix">
                <ul class="list-inline">
                    <li>
                        <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-primary btn-sm">Update profile</a>
                    </li>
                </ul>
            </div>
            @endif --}}

            @if (Auth::check() && Auth::user()->id == $user->id)
            <div class="actions">
                <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-primary btn-sm">Update profile</a>
            </div>
            @endif

            <h2>{{ $user->username }}</h2>
            <dl class="dl-horizontal">
                @if ($user->name)
                    <dt>Name</dt>
                    <dd>{{ $user->name }}</dd>
                @endif
                @if ($user->email_public == 1)
                    <dt>E-Mail</dt>
                    <dd><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></dd>
                @endif
                @if ($user->bio)
                    <dt>Biography</dt>
                    <dd>{{ $user->bio }}</dd>
                @endif
            </dl>
        </div>
    </div>
</div>
@endsection
