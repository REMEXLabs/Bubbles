@extends('layouts.app')

@section('content')
<main class="site_main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Welcome to Bubbles</h1>
                <p class="description">This is the HdM Bubbles project, a community to get developers connected.</p>
                <p><a href="{{ route('users.create')}}" class="btn btn-success">Join the community!</a></p>
            </div>
        </div>
    </div>
    <div class="water">
        <div class="bub x1"></div>
        <div class="bub x2"></div>
        <div class="bub x3"></div>
        <div class="bub x4"></div>
        <div class="bub x5"></div>
    </div>
</main>
<aside class="aside" role="complementary">
    <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="bubble" style="width: {{ $cssRadUsers }}px; height: {{ $cssRadUsers }}px; margin-top: {{ ($cssMarUsers) / 2 }}px; line-height: {{ $cssRadUsers }}px; font-size: {{ $cssFntUsers }}px;">
              {{ $numUsers }} Users
            </div>
          </div>
          <div class="col-md-4">
            <div class="bubble" style="width: {{ $cssRadQuests }}px; height: {{ $cssRadQuests }}px; margin-top: {{ ($cssMarQuests) / 2 }}px; line-height: {{ $cssRadQuests }}px; font-size: {{ $cssFntQuests }}px;">
              {{ $numQuests }} Quests
            </div>
          </div>
          <div class="col-md-4">
            <div class="bubble" style="width: {{ $cssRadProjects }}px; height: {{ $cssRadProjects }}px; margin-top: {{ ($cssMarProjects) / 2 }}px; line-height: {{ $cssRadProjects }}px; font-size: {{ $cssFntProjects }}px;">
              {{ $numProjects }} Projects
            </div>
          </div>
        </div>
    </div>
</aside>
@endsection
