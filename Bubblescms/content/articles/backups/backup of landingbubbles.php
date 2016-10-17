<h1>Landingpage</h1>



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
  
  	// if (isset($_POST['user'])) {
// 		
		// if($user->login($_POST['user'],$_POST['password']) && $user->isAdmin($_POST['user'])) {
			// // Set session username
			// $_SESSION['username'] = $_POST['user'];
			// // GET ACCESS
			// echo "<h4>password correct!</h4> </br>";
			// echo "<h4>login successful!</h4> </br>";
			// echo "<p>Hallo ".$_SESSION['username']."!</p>";
			// echo "<p>User role: ".$user->getUserRole($user->getUserID($_SESSION['username'])."</p>");
			// echo "<p>User ID: ".$user->getUserID($_SESSION['username']."</p>");
		// } else {
			// // ACCESS DENIED
			// echo "<h4>password wrong!</h4>";
			// echo "<h4>login failed</h4>";
			// // Include login form.	
// 			
			// sys::includeComponent("component-login");
		// }		
  	// }
	if(isset($_SESSION['username'])) {
		//include('includes/menu.php');
		echo "Logged in";
		sys::includeComponent("component-login");
		
		
		if(isset($_GET['page'])) {
			echo "<b>page is set!</b>";
			include(filterfilename("../content/articles/".$_GET['page']));
		}
	} 
	else if (!isset($_SESSION['username']) && !isset($_POST['user'])) {
		// Include login form.
		sys::includeComponent("component-login");
		
	}
	
			 
?>

<?PHP		
	
	//////////////////
	// LOAD BUBBLES //
	////////////////// 
	
	include("content-bubblesoverview.php");

?>