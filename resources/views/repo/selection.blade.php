@extends('layouts.app')

@section('content')
<main class="main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 style="margin-bottom: 30px;">Select Quests:</h3>
                {!! Form::open(array('route' => 'repo.store', 'role' => 'form', 'class'=>'form-horizontal')) !!}
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{ Form::hidden('repository', $repo) }}

                    <?php $fileIdx = 0; ?>
                    @foreach($data as $file => $quests)
                      {{-- <p>{{ $fileIdx }}: {{ $file }}</p> --}}
                      <div class="form-group">
                          {{ Form::label('file__' . $fileIdx, 'File:', ['class'=>'col-md-2 control-label']) }}
                          <div class="col-md-10">
                              {{ Form::text('file__' . $fileIdx, $file, array('class'=>'form-control', 'style'=>'font-weight: bold; margin-bottom: 30px;' ,'disabled'=>'disabled', 'placeholder'=>'File')) }}
                          </div>
                      </div>
                      {{ Form::hidden('file__' . $fileIdx, $file) }}
                        <?php $questIdx = 0; ?>
                      @foreach($quests as $key => $quest)
                        {{-- <p>{{ $questIdx}}: {{ $quest['line'] }}: {{ $quest['text'] }}</p> --}}
                        <div class="form-group">
                            {{ Form::hidden('line__' . $fileIdx . '_' . $questIdx, $quest['line']) }}
                            <div class="col-md-2 control-label" style="font-weight: bold;">
                                Line:
                            </div>
                            <div class="col-md-10" style="margin-bottom: 0; padding-top: 7px;">
                                <a href="{{ $file }}#L{{ $quest['line'] }}" target="{{ '_L'. $fileIdx . '_' . $questIdx }}">L{{ $quest['line'] }}</a>
                            </div>
                            {{-- {{ Form::label('line__' . $fileIdx . '_' . $questIdx, 'Line:', ['class'=>'col-md-2 control-label']) }}
                            <div class="col-md-10">
                                {{ Form::text('line__' . $fileIdx . '_' . $questIdx, $quest['line'], array('class'=>'form-control', 'disabled'=>'disabled', 'placeholder'=>'Line')) }}
                            </div> --}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('name__' . $fileIdx . '_' . $questIdx, 'Name:', ['class'=>'col-md-2 control-label']) }}
                            <div class="col-md-10">
                                {{ Form::text('name__' . $fileIdx . '_' . $questIdx, $quest['text'], array('class'=>'form-control', 'placeholder'=>'Name')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('description__' . $fileIdx . '_' . $questIdx, 'Description:', ['class'=>'col-md-2 control-label']) }}
                            <div class="col-md-10">
                                {{ Form::textarea('description__' . $fileIdx . '_' . $questIdx, $quest['text'], array('class'=>'form-control', 'style'=>'max-height: 57px;', 'placeholder'=>'Description')) }}
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 40px; margin-top: -11px; margin-left: -13px;">
                            <div class="container col-md-offset-2">
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('save__' . $fileIdx . '_' . $questIdx, 0) }} Save this quest.
                                    </label>
                                </div>
                            </div>
                        </div>
                        {{--
                        <div class="form-group">
                            {{ Form::label('difficulty', 'Difficulty:', ['class'=>'col-md-2 control-label']) }}
                            <div class="col-md-10">
                                {{ Form::select('difficulty', Quest::getDifficulties(), Quest::getDefaultDifficulty(), ['class' =>  'form-control']) }}
                            </div>
                        </div>
                        --}}
                        <?php $questIdx++; ?>
                      @endforeach
                        <?php $fileIdx++; ?>
                    @endforeach

                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <ul class="list-inline">
                                <li>{{ Form::submit('Create quests', array('class' => 'btn btn-primary')) }}</li>
                                <li><a class="btn btn-default btn-close" href="{{ route('repo.scan') }}">Cancel</a></li>
                            </ul>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</main>
@endsection
