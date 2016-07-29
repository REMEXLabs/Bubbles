@extends('layouts.app')

@section('content')
<main class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Welcome to Bubbles</h1>
                <p class="description">This is the HdM Bubbles project, a community to get developers connected.</p>
                <p><a href="{{ route('users.create')}}" class="btn bb-btn-primary">Join the community!</a></p>
            </div>
        </div>
    </div>
</main>
<aside class="aside" role="complementary">
    <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h2>Statistics</h2>
            <p>
              <strong>{{ $quests }}</strong> quests, <strong>{{ $projects }}</strong> projects and <strong>{{ $users }}</strong> users were created.
            </p>
          </div>
        </div>
    </div>
</aside>
@endsection
