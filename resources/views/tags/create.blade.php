@extends('layouts.app')

@section('content')
<main class="site_main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Create a new Tag</h3>
                    {!! Form::open(array('route' => 'tags.store', 'role' => 'form', 'class'=>'form-horizontal')) !!}
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
                                {{ Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'Important')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('color', 'Color:', ['class'=>'col-md-2 control-label']) }}
                            <div class="col-md-10">
                                {{ Form::text('color', null, array('class'=>'form-control', 'placeholder'=>'#ff0000')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <ul class="list-inline">
                                    <li>{{ Form::submit('Create Tag', array('class' => 'btn btn-primary')) }}</li>
                                    <li><a class="btn btn-default btn-close" href="{{ route('tags.index') }}">Cancel</a></li>
                                </ul>
                            </div>
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
        </div>
    </div>
</main>
@endsection
