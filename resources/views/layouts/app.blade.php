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
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="/assets/css/main.css" media="screen">
    @if (trim($__env->yieldContent('css')))
        <style media="screen">
            @yield('css')
        </style>
    @endif
</head>
<body id="app-layout" class="{{ $controller }}">
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
                    @if (!Auth::guest())
                        <li><a href="{{ route('quests.index') }}">Quests</a></li>
                    @endif
                    <li><a href="{{ route('projects.index') }}">Projects</a></li>
                    <li><a href="{{ route('users.index') }}">Users</a></li>
                </ul>
                {{-- Right Sidebar --}}
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}"><i class="fa fa-btn fa-sign-in"></i>Login</a></li>
                        <li><a href="{{ url('/register') }}"><i class="fa fa-btn fa-user"></i>Sign up</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->username }} <span class="caret" aria-hidden="true"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li class="dropdown-header">Signed in as <strong>{{ Auth::user()->username }}</strong></li>
                                <li><a href="{{ route('users.show', Auth::user()->id) }}"><i class="fa fa-btn fa-user" aria-hidden="true"></i>Your profile</a></li>
                                <li role="separator" class="divider"></li>
                                <li class="dropdown-header">Actions</strong></li>
                                <li><a href="{{ route('my-bubbles') }}"><i class="fa fa-btn fa-circle-o" aria-hidden="true"></i>Your bubbles</a></li>
                                <li><a href="{{ route('my-quests') }}"><i class="fa fa-btn fa-code" aria-hidden="true"></i>Your quests</a></li>
                                <li><a href="{{ route('my-projects') }}"><i class="fa fa-btn fa-list-ul" aria-hidden="true"></i>Your projects</a></li>
                                <li><a href="{{ route('my-resources') }}"><i class="fa fa-btn fa-file-o" aria-hidden="true"></i>Your resources</a></li>
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

    <footer class="footer">
        <div class="container">© Stuttgart Media University, 2016</div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
