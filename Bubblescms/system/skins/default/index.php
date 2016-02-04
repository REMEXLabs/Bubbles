<!DOCTYPE html>


<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
		
		<!-- <meta http-equiv="Content-Type" content="text/html" charset=ISO-8859-8"> -->
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
		<!-- Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="Patrick Münster">
		
		
		<!-- STYLESHEETS -->
		
		<!-- <link href="css/normalize.css" rel="stylesheet" /> -->
		<link rel="stylesheet" type="text/css" href=<?PHP echo sys::getSkinPath()."/scripts/jquery-ui-1.11.4/jquery-ui.css"?> />
		<link rel="stylesheet" type="text/css" href=<?PHP echo sys::getSkinPath()."/scripts/bootstrap-3.3.4-dist/css/custom-theme/jquery-ui-1.10.0.custom.css"?> />
		<!-- <link rel="stylesheet" type="text/css" href="scripts/bootstrap-3.3.4-dist/css/custom-theme/jquery-ui-1.9.2.custom.css"/> -->
		<link rel="stylesheet" type="text/css" href=<?PHP echo sys::getSkinPath()."/scripts/bootstrap-3.3.4-dist/css/bootstrap.min.css"?> />
		<link rel="stylesheet" type="text/css" href=<?PHP echo sys::getSkinPath()."/css/styles.css"?> />
		<link rel="stylesheet" type="text/css" href=<?PHP echo sys::getSkinPath()."/css/menus.css"?> />
		<link rel="stylesheet" type="text/css" href=<?PHP echo sys::getSkinPath()."/css/bubbles.css"?> />
		<!-- Include Sidr bundled CSS theme -->
		<link rel="stylesheet" href=<?PHP echo sys::getSkinPath()."/scripts/sidr-package-1.2.1/stylesheets/jquery.sidr.dark.css" ?> />
		
		<!-- jquery scrollbar -->
		<link rel="stylesheet" href="system/js/jquery-scrollpanel-0.5.0/main.css">
		
		<!-- SCRIPTS -->
		
		<script type="text/javascript" src=<?PHP echo sys::getSkinPath()."/scripts/jquery-ui-1.11.4/external/jquery/jquery.js"?> ></script>
		<!-- load bootstrap before jquery-ui -->
		<script type="text/javascript" src=<?PHP echo sys::getSkinPath()."/scripts/bootstrap-3.3.4-dist/js/bootstrap.min.js"; ?> ></script>
		<script type="text/javascript" src=<?PHP echo sys::getSkinPath()."/scripts/jquery-ui-1.11.4/jquery-ui.js";?> ></script>
		<!-- jquery scrollbar -->
		<script type="text/javascript" src="system/js/jquery-scrollpanel-0.5.0/jquery.scrollpanel-0.5.0.min.js"></script>
		<script type="text/javascript" src="system/js/jquery-scrollpanel-0.5.0/jquery.mousewheel-3.1.3.js"></script>
		<script type="text/javascript" src="system/js/jquery-scrollpanel-0.5.0/scrollpanel.js"></script>
		
		<script type="text/javascript" src=<?PHP echo sys::getSkinPath()."/scripts/bubblesBasicFunctions.js";?> ></script>
		<script type="text/javascript" src=<?PHP echo sys::getSkinPath()."/scripts/myscript.js";?> ></script>

			
		<title>	<?PHP getTitle();?> </title>

		
		<?PHP
			//echo "</br> Load global Meta information </br>";
			//sys::includeHeader();
		?>
		
	</head>
		

	<body>
		<div id="wrapper">
			
			<header>
			
				<?PHP
					//echo "</br> Default skin index.php </br>";
					//echo "</br> Here is the main menu </br>";
					// load main menu from articles
					sys::includeComponent("component-mainmenu");
				?>
			
			</header> <!-- /header -->
		
		
			<div class="container">
				<!-- <div class="row">
					<div class="col-md-14"> -->
		
						<?PHP
						
							//echo "</br> Here are the content of the Landingpage </br>";
							sys::includeContent();				
						?>
						
						<!-- <ul id="adminmenue">
							<li>
								<a href="?page=logout">Logout</a>
							</li>
						</ul> -->
						
					<!-- </div>
				</div>	--><!-- /row -->		 
			</div> <!-- /container -->
			
			
			<footer class="footer">
				<?PHP
					//echo "</br> Here is the footer menu </br>";
					// load manin menu from articles
					sys::includeComponent("component-footermenu");
				?>
			</footer> <!-- /footer -->
		
		</div> <!-- /wrapper -->
		
		
		
		<?PHP
			// load templates from articles for dialogs with jquery
			sys::includeComponent("component-dialogtemplates");
		?>
		
	</body>

</html>