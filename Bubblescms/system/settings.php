<?PHP

/*
 * Return the id of a property from the cms settings.
 */
function getSetting($property) {
	global $dbprefix;
	global $dbconnection;
	
	$res = mysqli_query($dbconnection, "SELECT value FROM ".$dbprefix."settings WHERE property = '".$property."'");
	
	
	$row = mysqli_fetch_row($res);
	return $row[0];
	
}

function getTitle() {
	echo getSetting("title");
}

function getSkinName() {
	global $dbprefix;
	global $dbconnection;
	
	$res = mysqli_query($dbconnection, "SELECT name FROM ".$dbprefix."skins WHERE id = '".getSetting("selectedskin")."'");
	$row = mysqli_fetch_row($res);
	return $row[0];
}

?>