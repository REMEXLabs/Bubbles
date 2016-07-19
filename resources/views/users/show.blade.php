@extends('layouts.app')

@section('css')
.content .actions {
    border-bottom: 1px solid #eee;
    padding-top: 4px;
    padding-bottom: 10px;
    margin-bottom: 30px;
}
@endsection

@section('content')
<div class="content container">
    <div class="row">
        <div class="col-md-12">
            @if (Auth::check() && Auth::user()->id == $user->id)
            <div class="actions">
                <ul class="list-inline">
                  <li>Actions:</li>
                  <li>
                      <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-primary btn-sm">Update profile</a>
                  </li>
                  <li>
                      {!! Form::open(array('method' => 'DELETE', 'route' => array('users.destroy', $user->id), 'style' => 'display: inline;')) !!}
                          {{ Form::submit('Delete account', array('class' => 'btn btn-danger btn-sm')) }}
                      {!! Form::close() !!}
                  </li>
                </ul>
            </div>
            @endif

            <h1>{{ $user->username }}</h1>
            @if ($user->name)
              <p>Name: {{ $user->name }}</p>
            @endif
            @if ($user->bio)
              <p>{{ $user->bio }}</p>
            @endif
        </div>
    </div>
</div>
@endsection
