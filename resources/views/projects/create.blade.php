@extends('layouts.app')

@section('content')
<main class="main" role="main">
    <div class="container">
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Create new project</div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {!! Form::open(array('route' => 'projects.store', 'role' => 'form')) !!}
                    <div class="form-group">
                        {{ Form::label('name', 'Name:') }}
                        {{ Form::text('name', '', array('class'=>'form-control', 'placeholder'=>'Name')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('description', 'Description:') }}
                        {{ Form::textarea('description', '', array('class'=>'form-control', 'placeholder'=>'Description')) }}
                    </div>
                    <div>
                        {{ Form::submit('Create project', array('class' => 'btn btn-primary')) }}
                    </div>
                    {!! Form::close() !!}


                    {{-- {!! Form::model($user, array('method' => 'PATCH', 'route' => array('users.update', $user->id))) !!}
                    <div class="form-group">
                        {{ Form::label('name', 'Name:') }}
                        {{ Form::text('name', $user->name, array('class'=>'form-control', 'placeholder'=>'Name')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('bio', 'Bio:') }}
                        {{ Form::textarea('bio', $user->bio, array('class'=>'form-control', 'placeholder'=>'Bio')) }}
                    </div>
                    <div class="form-group">
                		    {{ Form::submit('Update profile', array('class' => 'btn btn-info')) }}
                	</div>
                    {!! Form::close() !!} --}}


                </div>
                <div class="panel-footer">
                    <a href="{{ route('projects.index') }}">Back to all projects</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
