<?PHP 

class User {
	
	public $name;
	public $role;
	
	/**
	 * Checks if a md5 converted string from the entered password exists in the database.
	 */
	public function checkPassword($password){
		global $dbconnection;
		global $dbprefix;
		
		$password = mysqli_real_escape_string($dbconnection, trim($password));
		$name = mysqli_real_escape_string($dbconnection, trim($this->name));
		// count 
		$query = "SELECT COUNT(*) FROM ".$dbprefix."user 
		WHERE name = '".$name."' AND password = '".md5($password)."'";		
		$result = mysqli_query($dbconnection, $query);
		
		$row = mysqli_fetch_row($result);
		//print_r($row);
		// A user has to be unique.
		return $row[0] == 1;
	}
	
	
	public function login($name,$password) {
		global $dbconnection;
		global $dbprefix;
		
		$password = mysqli_real_escape_string($dbconnection, trim($password));
		// Set user name
		$this->name = mysqli_real_escape_string($dbconnection, trim($name));
		if($this->checkPassword($password)) {
			return TRUE;
		}
		else {
			echo "password wrong";
			return FALSE;
		}
	}
	
	
	public function logout() {
		session_destroy();
	}
	
	/**
	 * Get the User ID
	 */ 
	public function getUserID($name) {
		global $dbconnection;
		global $dbprefix;
		
		$this->name = mysqli_real_escape_string($dbconnection, trim($name));
		
		$query = "SELECT id FROM ".$dbprefix."user 
		WHERE name = '".$this->name."'";		
		
		$result = mysqli_query($dbconnection, $query);
		
		$row = mysqli_fetch_row($result);
		return $row[0];		
	}
	
	// public function getAllUser(){
	 	// global $dbconnection;
		// global $dbprefix;
// 		
		// $query = "SELECT * FROM ".$dbprefix."user ORDER by name"; 
// 			
		// $result = mysqli_query($dbconnection, $query);
// 		
// 		
// 		
	    // $users = $GLOBALS['db']->ReadRows("SELECT * FROM {'dbprefix'}user ORDER by name");
	    // foreach($users as $user){
	      // $newUser = new User();
	      // $newUser->id   = $user->id;
	      // $newUser->name = $user->name;
	      // $newUser->role = new Role();
	      // $newUser->role->load($user->role);
	      // $res[] = $newUser;
	    // }
	    // return $res;
	// }
	
	
	/**
	 * Returns the role of a user with an valid user name 
	 */
	public function getUserRole($id) {
		global $dbconnection;
		global $dbprefix;
		
		$name = mysqli_real_escape_string($dbconnection, $id);
		
		// get user role
		$query = "SELECT role FROM ".$dbprefix."user WHERE id = '".$id."'"; 
		$result = mysqli_query($dbconnection, $query);
		$row = mysqli_fetch_row($result);
		
		$role = $row[0];	
		$this->role = $role;
		return $role;
		
	}
	
	/**
	 * Register new users and store them in database.
	 */
	public function registerNewUser() {
		// check if user name already exists.
		//checkNewUserName()
	}
	
	/**
	 * If the current user is admin, the function will return true.
	 */
	public function isAdmin($name) {
		global $dbconnection;
		global $dbprefix;
		
		$name = mysqli_real_escape_string($dbconnection, $name);
		
		//echo $this->getUserRole($this->getUserID($name));
		if($this->getUserRole($this->getUserID($name)) === "admin") {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
}

?>
