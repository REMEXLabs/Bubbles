<h1>Landingpage</h1>



<?PHP
	/**
	 * The landingpage is for authentificated and anonymous users. It contains all infos about latest 
	 * activities and bubbles, a search field for searching for users and projects and a login form.
	 */


	global $user;
	
	////////////////////////
	// CHECK LOGIN STATUS //
	////////////////////////
  
	if(isset($_SESSION['username'])) {
		//include('includes/menu.php');
		
		//echo "Logged in </br>";
		//sys::includeComponent("component-login");
		
		
		if(isset($_GET['bubblemaster'])) {
			//echo "<b>page is set!</b> </br>";
			
			// Load content of the user
			
			// there is no static userbublle in articles !!!
			//include(filterfilename("../content/articles/".$_GET['page']));
			
		}
	} 
	else if (!isset($_SESSION['username']) && !isset($_POST['user'])) {
		// Include login form.
		//sys::includeComponent("component-login");
		
	}
	
?>

<?PHP		
	
	//////////////////
	// LOAD BUBBLES //
	////////////////// 
	
	include("content-bubblesoverview.php");

?>