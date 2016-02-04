<!-- MAIN MENU -->

<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		
		<div class="navbar-header">
			<!-- button for mobile menu -->
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="landingbubbles">
				<img src=<?PHP echo sys::getSkinPath()."/images/bubbles_logo.png"?> alt="Back to Landingpage" /> 
			</a>
		</div> <!-- /.navbar-header -->
		
		<div id="navbar" class="navbar-collapse collapse">
			
			<!-- MENU -->
			<ul class="nav navbar-nav navbar-right">

				<li>
					<!-- SEARCH -->
					<!-- <form class="navbar-form navbar-right" role="search">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Search">
						</div>
						<button type="submit" class="btn btn-default">
							Search
						</button>
					</form> -->
				</li>
				<li>
					<a href="landingbubbles">Overview</a>
				</li>
				
				<?PHP
					// Create link to my bubbles and dropdown user menu
					if (isset($_SESSION['username'])) {
				?>
				
						<li>
							<a href="?bubblemaster=<?PHP echo $_SESSION['username']; ?>">My Bubbles</a>
						</li>
			
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?PHP echo $_SESSION['username']; ?> <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li>
									<a href="#">Settings</a>
								</li>
								<li>
									<a href="#">Profile</a>
								</li>
		
								<li role="separator" class="divider"></li>
		
								<li>
									<a href="#">Separated link</a>
								</li>
							</ul>
						</li>
				<?PHP
					} // end if
				?>

				<li>
					<!-- LOGIN BUTTON -->
					<form class="navbar-form navbar-right" role="login">
						<?PHP
						// Create login and logout buttons
							if (!isset($_SESSION['username'])) {
						?>
								
								<button id="btn_signin" type="submit" class="btn btn-default">
									Login
								</button>
						<?PHP 
							} else { 
						?>
								<button id="btn_signout" class="btn btn-default">
									Logout
								</button>	
						<?PHP 
							} // end else
						?> 
								
					</form>
				</li>

			
			<!-- LOGIN -->
			<!-- Moved to dialog
				<li>
					<form class="navbar-form navbar-right">
						<div class="form-group">
							<input placeholder="Email" class="form-control" type="text">
						</div>
						<div class="form-group">
							<input placeholder="Password" class="form-control" type="password">
						</div>
						<button type="submit" class="btn btn-success">
							Sign in
						</button>
					</form> 
				</li> 
			-->
			
			</ul>
			
		</div><!--/#navbar -->
	</div>
</nav> <!-- /MAIN MENU -->
