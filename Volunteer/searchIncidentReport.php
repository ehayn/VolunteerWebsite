<?php
	require_once "dbconnect.php";
	require_once "header.php";

?>
<?php
	$sql = "SELECT * FROM VW_INCIDENT";
	$result = mysql_query($sql, $conn) or die(mysql_error());
	$tableh = "";
	$index = 0;
	
	while($field = mysql_fetch_field($result)){
		if ($field->name != "IID"){
			$tableh .= "<th>$field->name</th>\n";
		}
	}
	$tableh .= "<th>Admin</th>\n";
	$tbody = "";
	
	while($row = mysql_fetch_assoc($result)){
		$tbody .= "<tr id = ".$row['IID'].">\n";
		
		foreach($row as $key=>$value){
			if ($key != "IID"){
				$tbody .= "<td>$value</td>\n";
			}
		}
		$tbody .= "<td><a href = 'editIncident.php?id=".$row['IID']."'>Edit</a>/<a href = 'delete.php?type=IncidentReport&id=".$row['IID']."'>Delete</a></td>";
		$tbody .= "</tr>\n";
	}
?>
      <div class="jumbotron">
        <h1>Search Incident Records</h1>
	<img src="hopelogo.jpg" title="Hope Logo" alt="Hope Logo" width="150" height="150" border="0" />
      </div> 

		<div class="container">
			<table id="example" class="display" width="100%">
				<thead>
						<?php echo $tableh ?>
					
				</thead>
				<tfoot>
					
						<?php echo $tableh ?>
					
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