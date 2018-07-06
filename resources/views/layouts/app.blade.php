<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (!empty($title))
      <title>Bubbles - {{ $title }}</title>
    @else
      <title>Bubbles</title>
    @endif
    <link rel="stylesheet" href="/assets/css/google_fonts.css" media="screen">
    <link rel="stylesheet" href="/assets/css/main.css" media="screen">
    @if (Auth::check() && Auth::user()->theme != 'blue')
        <link rel="stylesheet" href="/assets/css/theme_{{ Auth::user()->theme }}.css" media="screen">
    @endif
    @if (trim($__env->yieldContent('css')))
        <style media="screen">
            @yield('css')
        </style>
    @endif
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
</head>
@if (!empty($controller))
  <body id="app-layout" class="section-{{ $controller }}">
@else
  <body id="app-layout">
@endif
    <nav class="navbar navbar-default navbar-static-top mainnav" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
                    Bubbles
                </a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                {{-- Left Sidebar --}}
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('quests.index') }}" class="is-quest">Quests</a></li>
                    <li><a href="{{ route('projects.index') }}" class="is-project">Projects</a></li>
                    <li><a href="{{ route('users.index') }}" class="is-user">Users</a></li>
                </ul>

                {{-- Search Bar --}}
                @if (Auth::check())
                    {!! Form::open(array('route' => 'search', 'role' => 'search', 'class'=>'navbar-form navbar search_form')) !!}
                        <div class="form-group">
                            {{ Form::text('search', Request::input('search', ''), array('class'=>'form-control', 'placeholder'=>'Searchword')) }}
                        </div>
                        <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                    {!! Form::close() !!}
                @endif

                {{-- Right Sidebar --}}
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}" class="is-login"><i class="fa fa-btn fa-sign-in"></i>Login</a></li>
                        <li><a href="{{ url('/register') }}" class="is-sign-up"><i class="fa fa-btn fa-user"></i>Sign Up</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                @if (Auth::user()->image_url)
                                    <img src="{{ Auth::user()->image_url }}" class="profile-image img-circle" style="width: 38px; height: 38px; margin-right: 7px;">
                                @endif
                                {{ Auth::user()->username }} <span class="caret" aria-hidden="true"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li class="dropdown-header">Signed in as <strong>{{ Auth::user()->username }}</strong></li>
                                <li><a href="{{ route('users.show', Auth::user()->id) }}"><i class="fa fa-btn fa-user" aria-hidden="true"></i>Profile</a></li>
                                <li role="separator" class="divider"></li>
                                {{-- <li class="dropdown-header">Actions</strong></li> --}}
                                <li><a href="{{ route('my-bubbles') }}"><i class="fa fa-btn fa-circle-o" aria-hidden="true"></i>Bubbles</a></li>
                                <li><a href="{{ route('my-quests') }}"><i class="fa fa-btn fa-code" aria-hidden="true"></i>Quests</a></li>
                                <li><a href="{{ route('my-projects') }}"><i class="fa fa-btn fa-list-ul" aria-hidden="true"></i>Projects</a></li>
                                <li><a href="{{ route('my-resources') }}"><i class="fa fa-btn fa-file-o" aria-hidden="true"></i>Resources</a></li>
                                <li><a href="{{ route('my-tags') }}"><i class="fa fa-tags" aria-hidden="true"></i> Tags</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out" aria-hidden="true"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('subnav')
    @yield('content')

    <footer class="site_footer">
      <div class="container">
        <div class="info">
          <a href="http://www.prosperity4all.eu/">
              <img src="/assets/img/p4a-logo.png" alt="Logo of Prosperity 4All" />
          </a>
        </div>
        <div class="info">
          <a href="https://www.hdm-stuttgart.de/">
              <img src="/assets/img/hdm-logo.gif" alt="Logo of the Stuttgart Media University" />
          </a>
        </div>
        <a href="{{ route('imprint') }}" class="imprint">Imprint</a>
      </div>
    </footer>
    <script src="/assets/js/main.js" charset="utf-8"></script>
    <script src="/assets/js/remex-cookies.min.js" charset="utf-8"></script>
    <script>remex_cookies_wp_language = 'en';</script>
</body>
</html>
