

	<?PHP
		// every script used on this site has to be included here:
		include("system/dbconnect.php");
		include("system/settings.php");
		include("system/classes/skincontroller.php");
		include("system/classes/page.php");
		include("system/classes/user.php");
		include("system/classes/bubble.php");
		
		
		include("system/filterfilename.php");
		include("system/sys.php");
		//sys::includeContent();
		//sys::includeHeader();
		
		
		
		/*
		 * Creates an instance of Page() and load the properties.
		 */
		$currentpage = new Page();
		$currentpage->loadProperties($_GET['include']);
		
			
		
		/*
		 * Creates a user.
		 */
		$user = new User();
		session_start();
		
		// Load index.php of the current skin.
		include(SkinController::getCurrentSkinPath()."/index.php");
		
		// set user and session variables before loading the site!!!
		include("system/sessionmanager.php");
		
		
		
	
		
	?>

