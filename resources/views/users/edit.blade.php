@extends('layouts.app')

@section('content')
<main class="site_main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Update Profile</h3>
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
                        {{ Form::label('location', 'Location:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            {{ Form::text('location', $user->name, array('class'=>'form-control', 'placeholder'=>'Germany')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('bio', 'Biography:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            {{ Form::textarea('bio', $user->bio, array('class'=>'form-control', 'placeholder'=>'Bio')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('skills', 'Skills:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            {{ Form::textarea('skills', $user->skills, array('class'=>'form-control', 'placeholder'=>'Web development, Python scripting')) }}
                        </div>
                    </div>
                    <hr>
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
                        <div class="container col-md-offset-2">
                            <div class="checkbox">
                                <label>
                                    {{ Form::checkbox('quests_public', 1, $user->quests_public) }} Make my created quests public.
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="container col-md-offset-2">
                            <div class="checkbox">
                                <label>
                                    {{ Form::checkbox('dashboard_created_quests', 1, $user->dashboard_created_quests) }} Show <i>Created Quests</i> bubble on your <a href="{{ route('welcome') }}">dashboard</a>?
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="container col-md-offset-2">
                            <div class="checkbox">
                                <label>
                                    {{ Form::checkbox('dashboard_accepted_quests', 1, $user->dashboard_accepted_quests) }} Show <i>Accepted Quests</i> bubble on your <a href="{{ route('welcome') }}">dashboard</a>?
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="container col-md-offset-2">
                            <div class="checkbox">
                                <label>
                                    {{ Form::checkbox('dashboard_created_projects', 1, $user->dashboard_created_projects) }} Show <i>Created Projects</i> bubble on your <a href="{{ route('welcome') }}">dashboard</a>?
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="container col-md-offset-2">
                            <div class="checkbox">
                                <label>
                                    {{ Form::checkbox('dashboard_tagcloud', 1, $user->dashboard_tagcloud) }} Show <i>Tabcloud</i> bubble on your <a href="{{ route('welcome') }}">dashboard</a>?
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        {{ Form::label('theme', 'Theme:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            {{ Form::select('theme', array('blue' => 'Blue', 'gray' => 'Gray'), $user->theme, ['class' =>
                            'form-control']) }}
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        {{ Form::label('share_twitter', 'Twitter:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            <div style="float: left; padding: 7px 0 0 0;">https://twitter.com/</div> <div style="block; overflow: hidden; padding: 0 0 0 4px;">{{ Form::text('share_twitter', $user->share_twitter, array('class'=>'form-control', 'style'=>'display: inline-block; width: 100%;', 'placeholder'=>'your_name')) }}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('share_github', 'GitHub:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            <div style="float: left; padding: 7px 0 0 0;">https://github.com/</div> <div style="block; overflow: hidden; padding: 0 0 0 4px;">{{ Form::text('share_github', $user->share_github, array('class'=>'form-control', 'style'=>'display: inline-block; width: 100%;', 'placeholder'=>'your_name')) }}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('share_google', 'Google Plus:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            <div style="float: left; padding: 7px 0 0 0;">https://plus.google.com/</div> <div style="block; overflow: hidden; padding: 0 0 0 4px;">{{ Form::text('share_google', $user->share_google, array('class'=>'form-control', 'style'=>'display: inline-block; width: 100%;', 'placeholder'=>'your_id')) }}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('share_stackoverflow', 'Stack Overflow:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            <div style="float: left; padding: 7px 0 0 0;">http://stackoverflow.com/users/</div> <div style="block; overflow: hidden; padding: 0 0 0 4px;">{{ Form::text('share_stackoverflow', $user->share_stackoverflow, array('class'=>'form-control', 'style'=>'display: inline-block; width: 100%;', 'placeholder'=>'your_id')) }}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('share_linkedin', 'LinkedIn:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            <div style="float: left; padding: 7px 0 0 0;">https://www.linkedin.com/in/</div> <div style="block; overflow: hidden; padding: 0 0 0 4px;">{{ Form::text('share_linkedin', $user->share_linkedin, array('class'=>'form-control', 'style'=>'display: inline-block; width: 100%;', 'placeholder'=>'your_name')) }}</div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <ul class="list-inline">
                                <li>{{ Form::submit('Update Profile', array('class' => 'btn btn-primary')) }}</li>
                                <li><a class="btn btn-default btn-close" href="{{ route('users.show', $user->id) }}">Cancel</a></li>
                            </ul>
                        </div>
                    </div>
                {!! Form::close() !!}
                {!! Form::open(array('method' => 'DELETE', 'route' => array('users.destroy', $user->id), 'style' => 'margin-top: 20px; display: inline; float: right;')) !!}
                    {{ Form::submit('Delete Account', array('class' => 'btn btn-default btn-sm btn-danger')) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</main>
@endsection
