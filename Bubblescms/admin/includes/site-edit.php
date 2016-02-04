<?php
/*
 * Provides forms for editing sites in the CMS.
 */
 
?>

<form action="/admin/index.php?page=site_edit&site=<?PHP echo $_GET['site']; ?>" method="post">
	<label for="title">Titel:</label>
	<input name="title" />
	<br />
	<label for="alias">Alias:</label>
	<input name="alias" />
	<br />
	<label for="content" />Inhalt</label> 	
	<textarea name="content"> </textarea>
	<br />	
	<input type="submit" value="&Auml;ndern" />
</form>
?>