<?PHP
	/**
	 * The landingpage is for authentificated and anonymous users. It contains all infos about latest 
	 * activities and bubbles, a search field for searching for users and projects and a login form.
	 */

	/*
	 * user: admin
	 * pass: p4all
	 */

	global $user;
	
	////////////////////////
	// CHECK LOGIN STATUS //
	////////////////////////
  
  	//#### CHECK LOGIN REQUEST ####//
  	if (isset($_POST['user'])) {
		
		if($user->login($_POST['user'],$_POST['password']) && $user->isAdmin($_POST['user'])) {
			// Set session username
			$_SESSION['username'] = $_POST['user'];
			
			// GET ACCESS
			// echo "</br>";
			// echo "<h4>password correct!</h4> </br>";
			// echo "<h4>login successful!</h4> </br>";
			// echo "<p>Hallo ".$_SESSION['username']."!</p>";
			// echo "<p>User role: ".$user->getUserRole($user->getUserID($_SESSION['username'])."</p>");
			// echo "<p>User ID: ".$user->getUserID($_SESSION['username'])."</p>";
		} else {
			// ACCESS DENIED
			
			//echo "<h4>password or username wrong!</h4>";
			//echo "<h4>login failed</h4>";
			
			// Include login form.	
			sys::includeComponent("component-loginfailed");
			// or:
			//header('location: loginfailed.php');
		}		
  	}
	
	//#### CHECK SESSION ####//
	if(isset($_SESSION['username'])) {
		//load adminmenu
		//include('includes/menu.php');
		echo "Logged in </br>";
		
		if(isset($_GET['bubblemaster'])) {
			//degug info	
			//echo "<b>Page is set!</b> </br>";
			
			// if ($_GET['page'] == "logout") {
				// include(filterfilename("../content/articles/".$_GET['page']));
			// }
	
			// Forward to userbubbles.php and load content of the user.
			//else 
			if (sys::getBasenameWithoutParam() == "landingbubbles" && $_GET['bubblemaster'] != "logout") {
				header("location: userbubbles?page=".$_GET['bubblemaster']);
			} else if ($_GET['bubblemaster'] == "logout") {
				include(filterfilename("../content/articles/".$_GET['bubblemaster']));
			}
			
			
		}
	} 
	// not used
	else if (!isset($_SESSION['username']) && !isset($_POST['user'])) {
		// Include login form.
		//sys::includeComponent("component-login");
		
	}
	
	
			 
?>