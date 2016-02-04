<h1>Bubbles</h1>

<?PHP

	/**
	 * $bubbles contains all bubbles from a user 
	 */
	
	// Bubbles output
	if ($bubbles != NULL) {
		
		// while bubbles in bubbles
		while ($bubble = $bubbles -> fetch_row()) {
				//echo $bubble->id;
			echo "<div>";
			
			// Bubble title
			echo "<h1>'".Bubble::getBubbleContent($bubble)."'</h1>";
			
			// check bubble type
			switch (Bubble::getBubbleType($bubble)) {
				case 'project' :
					// Bubble Type is project:
					// load template for a projectbubble
	
					echo "project bubble";
					break;
			
				case 'chat' :
					echo "chat bubble";
					break;
	
				case 'quest' :
					echo "quest bubble";
					break;
					
				case 'userinfo' :	
					echo "userinfo bubble";
					sys::includeComponent('bubble-userinfo');
					break;
			}
			
			//close container
			echo "</div>";
	
		}
	}

	//creatProjectBubble
?>