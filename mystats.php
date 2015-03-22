<?php
session_start();

include 'db_connect.php';



function clearFormInput($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = strip_tags($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
		<title>Summoners War - Halls drop rates</title>
<style>
	body {
		font-family: Arial,Verdana,sans-serif;
	}
	table {
		border-collapse: collapse;
	}
	thead {
		background-color: #EEE;
	}
	td, th {
		border: 1px solid black;
		padding: 2px 4px;
	}
	tbody tr:hover {
		background-color: #DDD;
	}
	#login_form {
		margin: 20px 0;
	}
</style>
    </head>
	<body>
		<h1>Summoners War - Halls drop rates</h1>
<?php include 'login.php'; ?>

<h2><a href="index.php">Back to statistics</a></h2>
<?php
if (isset($_SESSION['ID'])) {
	$reqsql_mystats = "SELECT t_loot.loot_datetime, t_hall.hall_name, t_hall.hall_code, t_drop.drop_name, t_drop.drop_code, t_loot.drop_qty, t_loot.floor_nb FROM t_loot, t_hall, t_drop WHERE t_loot.id_acc=".$_SESSION['ID']." AND t_loot.id_hall=t_hall.id_hall AND t_loot.id_drop=t_drop.id_drop ORDER BY t_loot.loot_datetime DESC";
	$ressql_mystats = mysqli_query($link, $reqsql_mystats) or die(mysqli_error($link));
?>
<textarea style="width:100%; min-height: 250px;">
<?php
	echo "date time";
	echo " ; ";
	echo "timestamp";
	echo " ; ";
	echo "Hall";
	echo " ; ";
	echo "hall code";
	echo " ; ";
	echo "floor";
	echo " ; ";
	echo "drop";
	echo " ; ";
	echo "drop code";
	echo " ; ";
	echo "quantity";
	echo "\n";
	
	while ($row_mystats = mysqli_fetch_array($ressql_mystats)) {
		echo date('d/m/Y H:i:s',$row_mystats['loot_datetime']);
		echo " ; ";
		echo $row_mystats['loot_datetime'];
		echo " ; ";
		echo stripslashes($row_mystats['hall_name']);
		echo " ; ";
		echo $row_mystats['hall_code'];
		echo " ; ";
		echo $row_mystats['floor_nb'];
		echo " ; ";
		echo stripslashes($row_mystats['drop_name']);
		echo " ; ";
		echo $row_mystats['drop_code'];
		echo " ; ";
		echo $row_mystats['drop_qty'];
		echo "\n";
	}
?>
</textarea>
<?php
	mysqli_data_seek($ressql_mystats,0);
?>
<table>
	<thead>
		<tr>
			<th>Date time</th>
			<th>timestamp</th>
			<th>Hall</th>
			<th>hall code</th>
			<th>Floor</th>
			<th>Drop</th>
			<th>drop code</th>
			<th>Quantity</th>
		</tr>
	</thead>
	<tbody>
<?php
	while ($row_mystats = mysqli_fetch_array($ressql_mystats)) {
?>
		<tr>
			<td><?php echo date('d/m/Y H:i:s',$row_mystats['loot_datetime']); ?></td>
			<td><?php echo $row_mystats['loot_datetime']; ?></td>
			<td><?php echo stripslashes($row_mystats['hall_name']); ?></td>
			<td><?php echo $row_mystats['hall_code']; ?></td>
			<td><?php echo $row_mystats['floor_nb']; ?></td>
			<td><?php echo stripslashes($row_mystats['drop_name']); ?></td>
			<td><?php echo $row_mystats['drop_code']; ?></td>
			<td><?php echo $row_mystats['drop_qty']; ?></td>
		</tr>
<?php 
	}
?>
	</tbody>
</table>

<?php
}
?>
	</body>
</html>
<?php
	mysqli_close($link);
?>