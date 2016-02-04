<h1>User Bubbles</h1>

<?PHP


	/**
	 * The Userpage provides the personal site of each user. It contains the bubbles of the user, 
	 * a search field for searching for users, and projects, the main menu and a login form.
	 */
	 
	 
	 // check if authentificated user is the owner of this page. 

?>

<?PHP
	
  	    
	global $user;
	  
	////////////////////////
	// CHECK LOGIN STATUS //
	////////////////////////
	
	
	// if(isset($_SESSION['username'])) {
		// //include('includes/menu.php');
		// //echo "Logged in </br>";
		// //sys::includeComponent("component-login");
// 		
		// // menu 
		// if(isset($_GET['bubblemaster'])) {
			// //echo "<b>page is set!</b> </br>";
// 			
			// // Load content of the user
// 			
			// // there is no static userbublle in articles !!!
			// //include(filterfilename("../content/articles/".$_GET['page']));
// 			
		// }
	// } 
	// else if (!isset($_SESSION['username']) && !isset($_POST['user'])) {
		// // Include login form.
		// //sys::includeComponent("component-login");
// 		
	// }
	
	
	//////////////////
	// LOAD BUBBLES //
	//////////////////

	/**
	 * Check if session is set and if the current user is the owner of the page.
	 */

	// Userpage from a specific user is called:
	if (isset($_GET['bubblemaster'])) {

		// userpage is called by authentificated.
		if (isset($_SESSION['username'])) {
			// user logged in.

			
			// check if user is the owner of the current bubbles
			if ($_GET['bubblemaster'] == $_SESSION['username']) {
				echo "<h3>load own bubbles with editor from " . $_GET['bubblemaster'] . "</h3>";
				
				// Get all Bubbles from the user.
				$bubbles = Bubble::getBubbles($_GET['bubblemaster'], $user);
				
				// owner
			} else {
				echo "<h3>load bubbles from " . $_GET['bubblemaster'] . " by authentificated </h3>";

				// Get all Bubbles from the user.
				$bubbles = Bubble::getBubbles($_GET['bubblemaster'], $user);
				
				//user
			}
		}
		// userpage is called by anonymous user.
		else {
			echo "<h3>load bubbles from " . $_GET['bubblemaster'] . " by anonymous user </h3>";
			
			// Get all Bubbles from the user.
			$bubbles = Bubble::getBubbles($_GET['bubblemaster'], $user);
			
			//user
		}
	}
	// Userpage without bubblesmaster is called -> own Bubbles
	else {
		// load own bubbles if possible.
		if (isset($_SESSION['username'])) {
			//user logged in
			echo "<h3>load own bubbles with editor from " . $_SESSION['username'] . "</h3>";
			
			// Get all Bubbles from the user.
			$bubbles = Bubble::getBubbles($_SESSION['username'], $user);
			
			//owner
		}
		// user has no account
		else {
			echo "<h3> You have no account at Bubbles</h3>";
			//echo $_SERVER['HTTP_HOST'];
			//echo "</br>";
			//echo $_SERVER['PHP_SELF'];
			
			$bubbles = NULL;
			
			// back to landingpage
			echo "<a href='" . dirname($_SERVER['HTTP_HOST']) . "/landingbubbles'>Zurück zur Startseite </a>";
			
		}
	}
	
	// #### CREATE BUBBLE ####//
	include("content-bubbles.php")
 
?>