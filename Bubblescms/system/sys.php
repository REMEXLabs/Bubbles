<?php
/*
 * The class sys provides functions to call content and metadata informations
 */

class sys{
	
	/*
	 * Loads a content page from content/articles 
	 */
	static function includeContent() {
		
		// Not secure: can load scripts from other sites!
		//include("content/articles/".$_GET['include'])

		// Secure way to load files:
		//include (filterfilename("content/articles/" . $_GET['include']));
		// call testpage with: http://.../mycms/index.php?include=testseite
		
		//include(filterfilename("../content/articles/".$_GET['include']));
		
		// Load content from page.php
		global $currentpage;
		$currentpage->getContent();
		
	}
	
	/*
	 * Loads meta data information from database
	 */
	static function includeHeader() {
		global $dbprefix;
		global $dbconnection;
		
		 // echo "<title>Kommt in einen späteren Beitrag</title>\n
		 // <meta http-equiv='Content-Type' content='text/html;charset=iso-8859-1' />";
		
		$result = mysqli_query($dbconnection,"SELECT * FROM ".$dbprefix."meta_global");
		
		//print_r($result);
		if($result != null) {
			while($row = mysqli_fetch_row($result)) {
				//echo $row[0];
				echo "<meta name=\"".$row[0]."\" content= \"".$row[1]."\" />";
			}
			
		}
		
	}
	
	/**
	 * Loads every component into the current page 
	 * @param string $componentName component file name
	 */
	static function includeComponent($componentName) {
		global $currentpage;
		$currentpage->getComponent($componentName);
	}
	
	
	static function getSkinPath() {
		return "system/skins/" .getSkinName();
		}

	static function curPageURL() {
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
	
	static function getBasenameWithoutParam() {
		$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
		$pathFragments = explode('/', $path);
		$end = end($pathFragments);
		return $end;	
	}
	
	static function getBasename() {
		return basename($_SERVER["REQUEST_URI"]);
	}
	
}
	?>