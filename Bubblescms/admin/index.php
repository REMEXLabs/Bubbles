<?PHP

	session_start();
	include("../system/dbconnect.php");
	include("../system/settings.php");
	include("../system/classes/user.php");
	include("../system/filterfilename.php");

?>

<!DOCTYPE html>

<html lang="de">
  <head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	
    <title>Admin-Bereich</title>
  </head>
  <body>
  	  
  	  <?PHP
  	  /*
  	   * user: admin
  	   * pass: p4all
  	   */
  	   
  	  	$user = new User();
	  
  	  	if (isset($_POST['user'])) {
			
			if($user->login($_POST['user'],$_POST['password']) && $user->isAdmin($_POST['user'])) {
				// Set session username
				$_SESSION['username'] = $_POST['user'];
				// GET ACCESS
				echo "<h4>password correct!</h4> </br>";
				echo "<h4>login successful!</h4> </br>";
				echo "<p>Hallo ".$_SESSION['username']."!</p>";
				echo "<p>User role: ".$user->getUserRole($user->getUserID($_SESSION['username'])."</p>");
				echo "<p>User ID: ".$user->getUserID($_SESSION['username']."</p>");
			} else {
				// ACCESS DENIED
				echo "<h4>password wrong!</h4>";
				echo "<h4>login failed</h4>";
				// Include login form.	
				include('includes/login.php');
			}		
  	  	}
		if(isset($_SESSION['username'])) {
			include('includes/menu.php');
			
			
			if(isset($_GET['page'])) {
					include(filterfilename("includes/".$_GET['page']));
			}
		} 
		else if (!isset($_SESSION['username']) && !isset($_POST['user'])) {
			// Include login form.
			include('includes/login.php');
		}
		
	 
  	  ?>
  </body>
</html>