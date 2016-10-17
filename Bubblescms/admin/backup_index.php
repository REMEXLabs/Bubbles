<?PHP
	include("../system/dbconnect.php");
	include("../system/settings.php");
	include("../system/classes/user.php");

?>

<!DOCTYPE html>

<html lang="de">
  <head>
    <title>Admin-Bereich</title>
  </head>
  <body>
  	  <?PHP
  	  	$user = new User();
	  
  	  	if (isset($_POST['user'])) {
  	  		
			$user->name = $_POST['user'];
			// Call function from class User.
			$user->checkPassword($_POST['password']);
			
			if($user->checkPassword($_POST['password'])) {
				// GET ACCESS
				echo "<h4>password correct!</h4>";
			} else {
				// ACCESS DENIED
				echo "<h4>password wrong!</h4>";
			}
				
  	  	}
	 
  	  ?>
  	
  	
      <form action="index.php" method="post">
        Benutzer: <input name="user" /><br />
        Passwort: <input name="password" type="password"><br />
        <input type="submit" value="Login" />
      </form>
  </body>
</html>