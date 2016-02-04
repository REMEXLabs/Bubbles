
<?PHP

class Bubble {
	
	/**
	 * @param string $username name of the user read from URL
	 * @param object $user instance of user created on pageload (userbubbles / landingbubbles)
	 */
	static function getBubbles($username,$user) {
		global $dbprefix;
		global $dbconnection;
		
		$username = mysqli_real_escape_string($dbconnection, trim($username));
		
		$query = "SELECT * FROM ".$dbprefix."bubbles WHERE user_id ='".$user->getUserID($username)."' ORDER BY order_num";
		
		if ($result = mysqli_query($dbconnection, $query)) {
		
			// if ($row = mysqli_fetch_row($result)){
				// echo $row[1];
			// }
			
			return $result;
			
			$result->close();
		}
		
	}
	
	static function createBubble() {
		
	}
	
	static function createProjectBubble() {
		
	}
	

	static function getBubbleID($bubble) {
		return $bubble[0];
	}
	
	static function getBubbleContent($bubble) {
		return $bubble[1];
	}
	
	static function getBubbleProjectIDs($bubble) {
		return $bubble[2];
	}
	
	static function getBubbleOwnerID($bubble) {
		return $bubble[3];
	}
	
	static function getBubbleType($bubble) {
		return $bubble[4];
	}
}

?>