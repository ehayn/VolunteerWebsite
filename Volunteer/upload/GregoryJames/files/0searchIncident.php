<?php
	require_once "dbconnect.php";
?>
<?php
	$sql = "SELECT * FROM VW_INCIDENT";
	$result = mysql_query($sql, $conn) or die(mysql_error());
	$tableh = "";
	
	while($field = mysql_fetch_field($result)){
		$tableh .= "<th>$field->name</th>\n";
	}
	
	$tbody = "";
	
	while($row = mysql_fetch_assoc($result)){
		$tbody .= "<tr>\n";
		
		foreach($row as $key=>$value){
			$tbody .= "<td>$value</td>\n";
		}
		
		$tbody .= "</tr>\n";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<link href="//datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css" />

		<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
		<script src="//datatables.net/download/build/nightly/jquery.dataTables.js"></script>

		<meta charset=utf-8 />
		<title>Search</title>
	</head>
	<body>
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