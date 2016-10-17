<?php
global $dbprefix;
global $dbconnection;
?>
<table>
	<thead>
		<tr>
			<td><strong>Titel</strong></td>
			<td><strong>Alias</strong></td>
			<td><strong>Aktionen</strong></td>
		</tr>
	</thead>
	<tbody>
		<?PHP
		// Get all sites from database from 0 to 30.
		$res = mysqli_query($dbconnection, "SELECT * FROM " . $dbprefix . "pages 
                          ORDER BY title LIMIT 0,30");
		while ($row = mysqli_fetch_assoc($res)) {
			echo "<tr>
	                <td>" . $row['title'] . "</td>
	                <td>" . $row['alias'] . "</td>
	                <td>
		                <a	title='Edit' href='index.php?page=site-edit&site='". $row['alias'] ."'>
		                	<img src='../content/images/icons/page_edit.png' />
		                </a>
						<a title='Delete' href='index.php?page=site-delete&site='". $row['alias'] ."'> 
							<img src='../content/images/icons/cross.png' /> 
						</a>
					</td>
				</tr>";
		}
		?>
	</tbody>
</table>

