@extends('layouts.app')

@section('content')
<main class="main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Create new bubble</h3>
                    {!! Form::open(array('route' => 'bubbles.store', 'role' => 'form', 'class'=>'form-horizontal')) !!}
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
                                {{ Form::select('type', Bubble::getTypes(), 'quest', ['class' =>
'form-control', 'id' => 'bubble_type_selection']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('quest_id', 'Quest:', ['class'=>'col-md-2 control-label']) }}
                            <div class="col-md-10">
                                {{ Form::select('quest_id', $quests, null, ['class' =>
'form-control']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('project_id', 'Project:', ['class'=>'col-md-2 control-label']) }}
                            <div class="col-md-10">
                                {{ Form::select('project_id', $projects, null, ['class' =>
'form-control', 'disabled'=>'disabled']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('order', 'Order:', ['class'=>'col-md-2 control-label']) }}
                            <div class="col-md-10">
                                {{ Form::number('order', 0, array('class'=>'form-control')) }}
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            {{ Form::label('name', 'Name:') }}
                            {{ Form::text('name', '', array('class'=>'form-control', 'placeholder'=>'Name')) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('description', 'Description:') }}
                            {{ Form::textarea('description', '', array('class'=>'form-control', 'placeholder'=>'Description')) }}
                        </div> --}}
                        {{-- <div>
                            {{ Form::submit('Create new project', array('class' => 'btn btn-primary')) }}
                        </div> --}}
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <ul class="list-inline">
                                    <li>{{ Form::submit('Create bubble', array('class' => 'btn btn-primary')) }}</li>
                                    <li><a class="btn btn-default btn-close" href="{{ route('bubbles.index') }}">Cancel</a></li>
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
