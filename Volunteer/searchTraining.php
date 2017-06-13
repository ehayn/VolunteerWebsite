<?php
	require_once "dbconnect.php";
	require_once "header.php";

?>
<?php
	$sql = "SELECT * FROM TRAINING";
	$result = mysql_query($sql, $conn) or die(mysql_error());
	$tableh = "";
	
	while($field = mysql_fetch_field($result)){
		if ($field->name != "TID"){
			$tableh .= "<th>$field->name</th>\n";
		}
	}
	$tableh .= "<th>Admin</th>\n";
	$tbody = "";
	
	while($row = mysql_fetch_assoc($result)){
		$tbody .= "<tr id = ".$row['TID'].">\n";
		
		foreach($row as $key=>$value){
			if ($key != "TID"){
				$tbody .= "<td>$value</td>\n";
			}
		}
		$tbody .= "<td><a href = 'editTraining.php?id=".$row['TID']."'>Edit</a>/<a href = 'delete.php?type=Training&id=".$row['TID']."'>Delete</a></td>";
		$tbody .= "</tr>\n";
	}
?>
    
      <div class="jumbotron">
        <h1>Search Training Records</h1>
	<img src="hopelogo.jpg" title="Hope Logo" alt="Hope Logo" width="150" height="150" border="0" />
      </div> 

		<div class="container">
			<table id="example" class="display" width="100%">
				<thead>
					<tr>
						<?php print $tableh ?>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<?php print $tableh ?>
					</tr>
				</tfoot>
				<tbody>
					<?php print $tbody ?>
				</tbody>
					
			</table>
		</div>
	</body>
</html>	
<script type = "text/javascript">
	$(document).ready(function(){
		$('#example').dataTable();
	});
</script>	