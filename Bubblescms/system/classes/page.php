<?PHP

class Page {
	
	var $id = -1;
	var $alias = '';
	var $title= '';
	
	/**
	 * Load all information about the current page. 
	 */
	function loadProperties($alias) {
		global $dbprefix;
		global $dbconnection;
		
		$query = "SELECT id,title FROM ".$dbprefix."pages WHERE alias ='".$alias."'";
		
		//echo "Site alias: ".$alias;
		$result = mysqli_query($dbconnection, $query);
		
		if($row = mysqli_fetch_row($result)) {
			echo "";
			$this->id = $row[0];
      		$this->title = $row[1];
      		$this->alias = $alias;
		} else {
			// Debug Info
			echo "<p> page not found in database </p>";
		}
	}
	
	/**
	 * Check if the called page alias is a registered site.
	 */
	function isSite($alias) {
		global $dbprefix;
		global $dbconnection;
		
		$query = "SELECT id,title FROM ".$dbprefix."pages WHERE alias ='".$alias."'";
		$result = mysqli_query($dbconnection, $query);
		$row = mysqli_fetch_row($result);
		
		// Get number of rows (results).
		if ($row[0] > 0) {
			return true;
			
		} else {	
			return false;	
		}
	}
	
	/**
	 * Load content page from articles into current site.  
	 */
	function getContent(){
		//echo "Willkommen auf ".$this->alias. " mit dem Titel ".$this->title." und der ID ".$this->id;
		
    	// Check if site exist.
    	if ($this->isSite($this->alias)) {
    		include(filterfilename("../content/articles/".$this->alias));
		} else {
			// Error resource does not exist.
			include(filterfilename("../content/articles/errors/404"));
		}
  	}
	
	function getComponent($componentName){
		include(filterfilename("../content/articles/".$componentName));
	}
}

?>