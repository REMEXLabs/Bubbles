@extends('layouts.app')

@section('content')
<main class="site_main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="registration social-registration" style="overflow: hidden;">
                    <h3>Social Connect</h3>
                    <p>
                        <a class="btn btn-block btn-social btn-github" href="{{ route('github.authorize') }}">
                            <span class="fa fa-github"></span> Sign up with GitHub
                        </a>
                    </p>
                    <p>
                        <a class="btn btn-block btn-social btn-openid" href="{{ route('iam.authorize') }}">
                            <span class="fa fa-key"></span> Login with Identity and Access Management (IAM)
                        </a>
                    </p>
                </div>
                <hr>
                <div class="registration regular-registration">
                    <h3>Regular Registration</h3>
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
                            {{ Form::label('username', 'Username:', ['class'=>'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::text('username', '', array('class'=>'form-control', 'placeholder'=>'anna')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', 'E-Mail Address', ['class'=>'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::email('email', '', array('class'=>'form-control', 'placeholder'=>'anna@example.com')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('password', 'Password', ['class'=>'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::password('password', array('class'=>'form-control')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('password_confirmation', 'Confirm Password', ['class'=>'col-md-3 control-label']) }}
                            <div class="col-md-9">
                                {{ Form::password('password_confirmation', array('class'=>'form-control')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="container col-md-offset-3">
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('terms', 0) }} Yes, I accept the <a href="{{ route('terms') }}">Terms and Conditions</a>.
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {{-- <div class="col-md-offset-3 col-md-9"> --}}
                                {{ Form::submit('Sign Up', array('class' => 'btn btn-block btn-primary')) }}
                            {{-- </div> --}}
                        </div>
                        {{-- {{ Form::token() }} --}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
