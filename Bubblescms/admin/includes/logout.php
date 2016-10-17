<h1>Goodbye</h1>

<?php
	$user->logout();
?>

<script type"text/javascript">
	//setTimeout("self.location.href='/admin/index.php'", 1000);
	setTimeout("self.location.href = window.location.href + '/admin/index.php'", 2000);
</script>
