@extends('layouts.app')

@section('content')
<main class="main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Update project</h3>
                {!! Form::model($bubble, array('method' => 'PATCH', 'route' => array('bubbles.update', $bubble->id), 'class'=>'form-horizontal')) !!}
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
                        {{ Form::label('type', 'Type:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            {{ Form::select('type', Bubble::getTypes(), $bubble->type, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('quest_id', 'Quest:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            {{ Form::select('quest_id', $quests, null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('project_id', 'Project:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            {{ Form::select('project_id', $projects, null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('order', 'Order:', ['class'=>'col-md-2 control-label']) }}
                        <div class="col-md-10">
                            {{ Form::number('order', $bubble->order, array('class'=>'form-control')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <ul class="list-inline">
                                <li>{{ Form::submit('Update bubble', array('class' => 'btn btn-primary')) }}</li>
                                <li><a class="btn btn-default btn-close" href="{{ route('bubbles.show', $bubble->id) }}">Cancel</a></li>
                            </ul>
                        </div>
                    </div>
                {!! Form::close() !!}
                {{-- <a href="{{ route('bubbles.show', ['id' => $bubble->id]) }}">Back to user profile</a> or <a href="{{ route('bubbles.index') }}">back to list</a> --}}
                {!! Form::open(array('method' => 'DELETE', 'route' => array('bubbles.destroy', $bubble->id), 'style' => 'margin-top: 20px; display: inline; float: right;')) !!}
                    {{ Form::submit('Delete bubble', array('class' => 'btn btn-danger btn-sm')) }}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</main>
@endsection
