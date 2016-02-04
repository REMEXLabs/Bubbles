<?php

class SkinController {
	
	
	/*
	 * Returns the id of the selected skin.
	 */
	public static function getCurrentSkinId() {
		// echo "Current skin id = ".getSetting("selectedskin"). "</br>";
		return getSetting("selectedskin");
	}
	
	/*
	 * Returns the name of the selected skin.
	 */
	public static function getCurrentSkinName() {
		global $dbprefix;
		global $dbconnection;
		
		//'".SkinController::getCurrentSkinId()."'
		$result = mysqli_query($dbconnection, "SELECT name FROM ".$dbprefix."skins WHERE id='".SkinController::getCurrentSkinId()."'");
		$row = mysqli_fetch_row($result);
		//echo "Row: ";
		//print_r($row);
		if($row != null) {
			//echo "Current skin name is: " .$row[0]. "</br>";
			return $row[0];
		} else {
			echo "Fallback to default skin </br>";
			return "default";
		}
	}
	
	/*
	 * Returns the path of the selected skin.
	 */
	public static function getCurrentSkinPath() {
		return "system/skins/".SkinController::getCurrentSkinName();
	}
}
