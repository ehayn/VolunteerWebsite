<?php
	require_once "dbconnect.php";
	require_once "header.php";

?>
<?php
	$sql = "SELECT * FROM DATABASE_USER";
	$result = mysql_query($sql, $conn) or die(mysql_error());
	$tableh = "";
	
	while($field = mysql_fetch_field($result)){
		if ($field->name != "userID" && $field->name != "password" && $field->name != "permission" && $field->name != "permissionSite"){
			$tableh .= "<th>$field->name</th>\n";
		}
	}
	$tableh .= "<th>Admin</th>\n";
	$tbody = "";
	
	while($row = mysql_fetch_assoc($result)){
		$tbody .= "<tr = ".$row['userID'].">\n";
		
		foreach($row as $key=>$value){
			if ($key != "userID" && $key != "password" && $key != "permission" && $key != "permissionSite"){
				$tbody .= "<td>$value</td>\n";
			}
		}
		$tbody .= "<td><a href = 'editAdmin.php?id=".$row['userID']."'>Edit</a>/<a href = 'delete.php?type=Admin&id=".$row['userID']."'>Delete</a></td>";
		$tbody .= "</tr>\n";
	}
?>
    
      <div class="jumbotron">
        <h1>Search Admin Records</h1>
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
		oTable.$('td').editable( '../examples_support/editable_ajax.php', {
        		"callback": function( sValue, y ) {
           			 var aPos = oTable.fnGetPosition( this );
           			 oTable.fnUpdate( sValue, aPos[0], aPos[1] );
       			 },
        		"submitdata": function ( value, settings ) {
            			return {
                			"row_id": this.parentNode.getAttribute('id'),
                			"column": oTable.fnGetPosition( this )[2]
            			};
       			 },
        		"height": "14px",
        		"width": "100%"
    } );
	});
</script>	