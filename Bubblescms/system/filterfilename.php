<?php

/*
 * filterfilename() prevent abuse of the include function which gets the
 * files to load from GET.
 */
function filterfilename($filename) {
	// debug info	
	//echo "<p> filter filename: ".$filename."</p>";
	if ($filename == "content/articles/") {
		$filename .= "errors/404";
	}
	$filename = strtolower($filename);
	$filename = str_replace(".htm","",$filename);
	$filename = preg_replace("/[^a-z0-9\-\/]/i", "", $filename);
	if ($filename[0] == "/") {
		$filename = substr($filename, 1);
	}
	$filename .= ".php";
	
	
	// check if for vaild filename.
	if ($filename === "content/articles/.php") {
		echo "</br>File could not be called by URL request </br>";
		
	} else {
		return $filename;
	}
}

?>