@extends('layouts.app')

@section('subnav')
    @if (Auth::check())
        <nav class="navbar subnav" role="navigation">
            <div class="container">
                <ul class="list-inline list-inline--right">
                    @if (Auth::user()->id == $bubble->user_id)
                        <li>
                            <a href="{{ route('bubbles.edit', ['id' => $bubble->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Update Bubble</a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('bubbles.create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Create New Bubble</a>
                    </li>
                    <li>
                        <a href="{{ route('my-bubbles')}}" class="btn btn-sm btn-success"><i class="fa fa-list" aria-hidden="true"></i> List Bubbles</a>
                    </li>
                </ul>
                {{--
                <ul class="list-inline list-inline--left">
                    <li>
                        <a href="{{ route('bubbles.index') }}" class="btn btn-sm cut"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>Show All Bubbles</a>
                    </li>
                </ul>
                --}}
            </div>
        </nav>
    @endif
@endsection

@section('content')
<main class="site_main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12 single">
                @if($bubble->type == 'project')
                    <h1>{{ $bubble->project()->name }}</h1>
                @endif
                @if($bubble->type == 'quest')
                    <h1>{{ $bubble->quest()->name }}</h1>
                @endif

                <section class="section">
                    <h3>Details</h3>
                    @if($bubble->type == 'project')
                        <p><a href="{{ route('projects.show', ['id' => $bubble->project()->id ]) }}">Open Project Details</a>.</p>
                    @endif
                    @if($bubble->type == 'quest')
                        <p><a href="{{ route('quests.show', ['id' => $bubble->quest()->id ]) }}">Open Quest Details</a>.</p>
                    @endif
                    <p><strong>Type</strong>: <br> {{ Bubble::getTypes()[$bubble->type] }}</p>
                    <p><strong>Order</strong>: <br> {{ $bubble->order }}</p>
                </section>

                <section class="section sharing">
                  <h3>Bubble Sharing</h3>
                  <p>Share your bubble by using the following iframe on your site:</p>
                  <p>
                    <textarea class="form-control" name="name" rows="1" cols="150" style="overflow:hidden; resize:none;">
<iframe src="{{ route('embed-bubble', ['id' => $bubble->id]) }}" width="208" height="58" frameborder="0"></iframe>
                    </textarea>
                  </p>
                  <p>The result looks like that:</p>
                  <div class="embedding">
                      <iframe src="{{ route('embed-bubble', ['id' => $bubble->id]) }}" width="208" height="58" frameborder="0"></iframe>
                  </div>
                </section>

            </div>
        </div>
    </div>
</main>
@endsection
