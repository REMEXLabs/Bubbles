@extends('layouts.app')

@section('content')
<main class="site_main" role="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Login via GitHub</h3>
                <div class="alert alert-danger">
                    <ul>
                        <li>
                        	<p>Your GitHub username is already taken. This is sad. You can't login with our GitHub account.</p>
                        	<p>Please create a new Bubbles user with a different username. Sorry. :(</p>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</main>
@endsection
