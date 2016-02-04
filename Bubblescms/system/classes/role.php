<?PHP

/**
 * 
 */
class Role {
	
	//public $name = "";
	public $ID =  -1;
	
	/**
	 * Returns the role of a user with an valid user id 
	 */
	public function load($id) {
		global $dbconnection;
		global $dbprefix;
		
		$id = mysqli_real_escape_string($dbconnection, $id);
		
		// get user role
		$query = "SELECT role FROM ".$dbprefix."user WHERE id = '".$id."'"; 
		$result = mysqli_query($dbconnection, $query);
		$row = mysqli_fetch_row($result);
		
		$role = $row[0];	
		
		if($role) {
			//$this->name = 
		} 
		return $role;
		
	}
}
	

?>