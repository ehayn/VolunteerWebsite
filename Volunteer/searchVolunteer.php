<?php
	require_once "dbconnect.php";
	require_once "header.php";

?>
<?php
		

	$sql = "SELECT * FROM VW_VOLUNTEER";
	$result = mysql_query($sql, $conn) or die(mysql_error());
	$tableh = "";
	
	while($field = mysql_fetch_field($result)){
		if ($field->name != "VID"){
			$tableh .= "<th>$field->name</th>\n";
		}
	}
	$tableh .= "<th>Admin</th>\n";
	$tbody = "";
	
	while($row = mysql_fetch_assoc($result)){
		$tbody .= "<tr id ".$row['VID'].">\n";
		
		foreach($row as $key=>$value){
			if ($key != "VID"){
				if ($key == "PicLink"){
					$value2 = str_split($value);
					$value2 = array_pop($value2);
					if (($value == "") || ($value2 == "/")){
						$value = "contact.png";
					}
					$tbody .= "<td><img src = '$value' height = '50' width = '50'></td>\n";
					
						
				}
				else{
					if ($key == "FirstName"){
						$tbody .= "<td><a href = 'upload/".$row['FirstName'].$row['LastName']."/files/'>$value</a></td>";
					}			
					else{
						//$tbody .= "<td><input name = 'edit' class = 'btn' type='submit' value='Edit' /><br /></td>\n";
						$tbody .= "<td>$value</td>\n";
					}
				}
			}
		}
		$tbody .= "<td><a href = 'editUser.php?id=".$row['VID']."'>Edit</a>/<a href = 'delete.php?type=Volunteer&id=".$row['VID']."'>Delete</a></td>";
		$tbody .= "</tr>\n";
	}
	
		
?>
    
      <div class="jumbotron">
        <h1>Search Volunteer Records</h1>
	<img src="hopelogo.jpg" title="Hope Logo" alt="Hope Logo" width="150" height="150" border="0" />
      </div> 
		<div class="container">
			<table id="example" class="display" width="100%">
				<thead>
					
						<?php print $tableh ?>
					
				</thead>
				<tfoot>
					
						<?php print $tableh ?>
					
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