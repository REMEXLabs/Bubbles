@extends('layouts.app')

@section('content')
<main class="main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Update profile</h3>
                {!! Form::model($user, array('method' => 'PATCH', 'route' => array('users.update', $user->id), 'class'=>'form-horizontal')) !!}
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="form-group">
                        {{ Form::label('name', 'Name:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            {{ Form::text('name', $user->name, array('class'=>'form-control', 'placeholder'=>'Name')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('bio', 'Biography:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            {{ Form::textarea('bio', $user->bio, array('class'=>'form-control', 'placeholder'=>'Bio')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="container col-md-offset-2">
                            <div class="checkbox">
                                <label>
                                    {{ Form::checkbox('quests_public', 1, $user->quests_public) }} Make my created quests public.
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="container col-md-offset-2">
                            <div class="checkbox">
                                <label>
                                    {{ Form::checkbox('email_public', 1, $user->email_public) }} Make my private e-mail (<i>{{$user->email}}</i>) public?
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <ul class="list-inline">
                                <li>{{ Form::submit('Update profile', array('class' => 'btn btn-primary')) }}</li>
                                <li><a class="btn btn-default btn-close" href="{{ route('users.show', $user->id) }}">Cancel</a></li>
                            </ul>
                        </div>
                    </div>
                {!! Form::close() !!}
                {{-- <a href="{{ route('users.show', ['id' => $user->id]) }}">Back to user profile</a> or <a href="{{ route('users.index') }}">back to list</a> --}}
                {!! Form::open(array('method' => 'DELETE', 'route' => array('users.destroy', $user->id), 'style' => 'margin-top: 20px; display: inline; float: right;')) !!}
                    {{ Form::submit('Delete account', array('class' => 'btn btn-default btn-sm btn-danger')) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</main>
@endsection
