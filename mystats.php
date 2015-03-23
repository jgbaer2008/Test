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
		<link rel="stylesheet" href="css.css" />
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


<div id="stats">
<?php

$reqsql_halls = "SELECT * FROM t_hall";
$ressql_halls = mysqli_query($link, $reqsql_halls) or die(mysqli_error($link));
while ($row_hall = mysqli_fetch_array($ressql_halls)) {
	echo '<h2><img src="img/'.$row_hall['hall_code'].'.png" /> '.stripslashes($row_hall['hall_name']).' <img src="img/'.$row_hall['hall_code'].'.png" /></h2>';

	$arr_hall_droplist = array();
?>
<table>
	<caption>Drop stats</caption>
	<thead>
		<th>Floor</th>
		<th>Runs</th>
<?php
	//Hall drops
	$reqsql_hall_droplist = "SELECT t_drop.drop_code, t_drop.drop_name, t_drop.id_drop FROM t_drop, t_hall_drop WHERE t_drop.drop_code = t_hall_drop.drop_code AND t_hall_drop.hall_code='".$row_hall['hall_code']."'";
	$ressql_hall_droplist = mysqli_query($link, $reqsql_hall_droplist) or die(mysqli_error($link));
	while ($row_hall_droplist = mysqli_fetch_array($ressql_hall_droplist)) {
		array_push($arr_hall_droplist,$row_hall_droplist['id_drop']);
		echo '<th><img src="img/'.$row_hall_droplist['drop_code'].'.png" /> '.stripslashes($row_hall_droplist['drop_name'])."</th>";
	}
?>
	</thead>
	<tbody>
<?php
	
	//Floors
	$reqsql_floors = "SELECT floor_nb FROM t_floor ORDER BY floor_nb";
	$ressql_floors = mysqli_query($link, $reqsql_floors) or die(mysqli_error($link));
	while ($row_floor = mysqli_fetch_array($ressql_floors)) {
		echo "<tr>";
		echo "<td>".$row_floor['floor_nb']."</td>";
		
		//stats for the floor
		$reqsql_countloot = "SELECT count(id_loot) AS nb FROM t_loot WHERE t_loot.id_hall=".$row_hall['id_hall']." AND t_loot.floor_nb=".$row_floor['floor_nb']." AND t_loot.id_acc=".$_SESSION['ID'];
		$ressql_countloot = mysqli_query($link, $reqsql_countloot) or die(mysqli_error($link));
		$row_countloot = mysqli_fetch_array($ressql_countloot);
		echo "<td>".$row_countloot['nb']."</td>";
	
		//stats by drop
		foreach ($arr_hall_droplist as $droplist_id) {
			$reqsql_loot = "SELECT COUNT(id_loot) as nb_loot, AVG(drop_qty) as avg_drop_qty FROM t_loot WHERE t_loot.id_hall=".$row_hall['id_hall']." AND t_loot.floor_nb=".$row_floor['floor_nb']." AND t_loot.id_drop=".$droplist_id." AND t_loot.id_acc=".$_SESSION['ID'];
			$ressql_loot = mysqli_query($link, $reqsql_loot) or die(mysqli_error($link));
			$row_loot = mysqli_fetch_array($ressql_loot);
			
			$loot_rate=0;
			if ($row_countloot['nb']!=0) {
				$loot_rate=round($row_loot['nb_loot']/$row_countloot['nb']*100,2);
			}
			$average_drop = 0;
			if ($row_loot['avg_drop_qty']!=null) {
				$average_drop=round($row_loot['avg_drop_qty'],2);
			}
			
			echo "<td>".$loot_rate."% (".$average_drop.") </td>";
		}
		echo "</tr>";
	}
?>
	</tbody>
</table>
<?php
}
?>
</div>

<h2>Raw Data CSV formatted</h2>
<textarea style="width:100%; min-height: 250px;">
<?php
	echo "date time (d/m/y h:m:s)";
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
	<caption><h2>Raw Data Logs</h2></caption>
	<thead>
		<tr>
			<th>Date time (d/m/y h:m:s)</th>
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