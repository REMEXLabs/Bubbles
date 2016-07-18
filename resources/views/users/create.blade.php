@extends('layouts.app')

@section('css')
.content {
    padding-top: 50px;
    padding-bottom: 50px;
}
.content hr {
    margin-top: 40px;
    margin-bottom: 40px;
}
.content h3 {
    padding-bottom: 10px;
}

@endsection

@section('content')
<div class="container content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h3>Social connect</h3>
            <p>
                Google Plus, Github, Stack Overflow
            </p>
            <hr>
            <h3>Regular registration</h3>
            {!! Form::open(array('route' => 'users.store', 'role'=>'form', 'class'=>'form-horizontal')) !!}
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
                    {{ Form::label('username', 'Username:', ['class'=>'col-md-2 control-label']) }}
                    <div class="col-md-10">
                        {{ Form::text('username', '', array('class'=>'form-control', 'placeholder'=>'anna')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'E-Mail Address', ['class'=>'col-md-2 control-label']) }}
                    <div class="col-md-10">
                        {{ Form::email('email', '', array('class'=>'form-control', 'placeholder'=>'anna@example.com')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('password', 'Password', ['class'=>'col-md-2 control-label']) }}
                    <div class="col-md-10">
                        {{ Form::password('password', array('class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('password_confirmation', 'Confirm Password', ['class'=>'col-md-2 control-label']) }}
                    <div class="col-md-10">
                        {{ Form::password('password_confirmation', array('class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        {{ Form::submit('Sign up', array('class' => 'btn btn-block btn-success')) }}
                    </div>
                </div>
                {{-- {{ Form::token() }} --}}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
