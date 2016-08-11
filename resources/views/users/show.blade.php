@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                @if (Auth::user()->id == $user->id)
                    <ul class="list-inline list-inline--right">
                        <li>
                            <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-default btn-sm">Update profile</a>
                        </li>
                    </ul>
                @endif
                <ul class="list-inline list-inline--left">
                    <li>
                        <a href="{{ route('users.index') }}" class="btn btn-sm cut"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>Show all users</a>
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
                <h2>{{ $user->username }}</h2>
                @if ($user->email_public == 1)
                    <p><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                @endif
                @if ($user->name)
                    <p><strong>Name</strong>: <br> {{ $user->name }}</p>
                @endif
                @if ($user->bio)
                    <p><strong>Biography</strong>: <br> {{ $user->bio }}</p>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
