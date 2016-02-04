<div id="templates">
	
		<!-- DIALOGS -->

		<div id="dbx_signin" class="container" title="Login">
			
			
			<form class="form-signin" method="post" role="login" action="userbubbles">
				<h2 class="form-signin-heading">Please sign in</h2>
				<label for="ip_email" class="sr-only">Email address</label>
				<!-- type="email" to validate-->
				<input id="ip_email" class="form-control" placeholder="Email or Username" name="user" required autofocus>
				<label for="ip_password" class="sr-only">Password</label>
				<input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
				<div class="checkbox">
					<label>
						<input type="checkbox" value="remember-me">
						Remember me 
					</label>
				</div>
				
				<button class='btn btn-lg btn-primary btn-block' type='submit'> 
					Sign in
				</button>
				
			</form>
			
			
			<!-- <form action="userbubbles" method="post" role="login">
				<label for="ip_username"></label>
				Username:
				<input id="ip_username" name="user" class="form-control"/>
				<br />
				Password:
				<label for="ip_password"></label>
				<input id="ip_password" name="password" type="password" class="form-control">
				<br />
				<input type="submit" value="Login" class="btn btn-default"/>
			</form> -->
			
		</div> <!-- /#dbx_signin -->

		<form id="dbx_addProject" class="form">
			<div class="form-group">
				<h2>Add a project</h2>
				<label for="projectTitle">Title of the Project :</label>
				<input id="projectTitle" type="text" class="form-control" placeholder="Project title">
			</div>
			<textarea rows="4" name="description" form="dbx_addProject" placeholder="Your project description and link"></textarea>
			<br>
			<!-- <button type="submit" class="btn btn-default">
			Ok
			</button> -->
		</form>

</div> 