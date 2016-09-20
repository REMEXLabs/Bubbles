@extends('layouts.app')

@section('content')
<main class="site_main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h3>Scan repository</h3>
                    {!! Form::open(array('route' => 'repo.parse', 'role' => 'form', 'class'=>'form-horizontal')) !!}
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
                            {{ Form::label('repo', 'Repository:', ['class'=>'col-md-2 control-label']) }}
                            <div class="col-md-10">
                                {{ Form::text('repo', null, array('class'=>'form-control', 'placeholder'=>'https://github.com/REMEXLabs/Bubbles')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <ul class="list-inline">
                                    <li>{{ Form::submit('Scan Repository', array('class' => 'btn btn-primary')) }}</li>
                                    <li><a class="btn btn-default btn-close" href="{{ route('quests.index') }}">Cancel</a></li>
                                </ul>
                            </div>
                        </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</main>
@endsection
