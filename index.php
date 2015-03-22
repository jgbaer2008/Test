<?php
session_start();

include 'db_connect.php';



//Test the input
function clearFormInput($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = strip_tags($data);
	$data = htmlspecialchars($data);
	return $data;
}

if (isset($_POST['submit_stats'])) {

	$id_hall = clearFormInput($_POST['drop_hall']);
	$floor_nb = clearFormInput($_POST['drop_floor']);
	$id_drop = clearFormInput($_POST['drop_drop']);
	$drop_qty = clearFormInput($_POST['drop_qty']);
	
	//check quantity
	$reqsql_maxqty = "SELECT drop_max FROM t_drop WHERE id_drop=".$id_drop;
	$ressql_maxqty = mysqli_query($link, $reqsql_maxqty) or die(mysqli_error($link));
	$row_maxqty = mysqli_fetch_array($ressql_maxqty);
	if ($drop_qty > $row_maxqty['drop_max']) {
		$drop_qty = $row_maxqty['drop_max'];
	}
	if ($drop_qty<=0) {
		$drop_qty=1;
	}
	
	$id_acc = 0;
	if (isset($_SESSION['ID'])) {
		$id_acc = $_SESSION['ID'];
	}
	
	if ((is_numeric($id_hall)) && (is_numeric($floor_nb)) && (is_numeric($id_drop)) && (is_numeric($drop_qty))) {
		$reqsql_addloot = "INSERT INTO t_loot VALUES(NULL,".time().",".$id_hall.",".$floor_nb.",".$id_drop.",".$drop_qty.",".$id_acc.")";
		mysqli_query($link, $reqsql_addloot) or die(mysqli_error($link));
	}
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
		<title>Summoners War - Halls drop rates</title>
		<script>
function show(obj){
	window.document.getElementById(obj).style.display = "inline-block";
}

function hide(obj){
	window.document.getElementById(obj).style.display = "none";
}

function showhall(hall_code){
	//list_drops_hall_
<?php
	$reqsql_hall_js = "SELECT hall_code FROM t_hall";
	$ressql_hall_js = mysqli_query($link, $reqsql_hall_js) or die(mysqli_error($link));
	while ($row_hall_js = mysqli_fetch_array($ressql_hall_js)) {
		echo "hide('list_drops_hall_".$row_hall_js['hall_code']."');";
	}
?>
	show('list_drops_hall_'+hall_code);
}
		</script>
<style>
	body {
		font-family: Arial,Verdana,sans-serif;
	}
	img {
		max-width: 32px;
		max-height: 32px;
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
	
	tbody#table_form tr:hover {
		background-color: transparent;
	}
	
	#table_form td {
		vertical-align: top;
	}
	
	ul {
		list-style:none;
		padding: 0;
		margin: 0;
	}
	
	li {
		padding: 8px 0;
	}
	label {
		padding: 8px 16px;
	}
	li:hover {
		background-color: #DDD;
	}
	#login_form {
		margin: 20px 0;
	}
	
</style>
    </head>
	<body>
		<h1>Summoners War - Halls drop rates</h1>
<?php include 'login.php' ?>
		<form method="post" action="">
		
			<table>
				<thead>
					<tr>
						<td><h3>Hall</h3></td>
						<td><h3>Floor</h3></td>
						<td><h3>Loot</h3></td>
						<td><h3>Quantity</h3></td>
						<td></td>
					</tr>
				</thead>
				<tbody id="table_form">
					<tr>
<td>
<ul><?php
	$reqsql_hall = "SELECT * FROM t_hall";
	$ressql_hall = mysqli_query($link, $reqsql_hall) or die(mysqli_error($link));
	while ($row_hall = mysqli_fetch_array($ressql_hall)) {
		?><li onclick="showhall('<?php echo $row_hall['hall_code']; ?>');">
		<input type="radio" name="drop_hall" id="drop_hall_<?php echo $row_hall['id_hall']; ?>" value="<?php echo $row_hall['id_hall']; ?>"
		<?php if (isset($_POST['submit_stats'])) { if ($id_hall==$row_hall['id_hall']) { echo 'checked="checked"'; } } else { echo $row_hall['id_hall']; } ?>>
		<label for="drop_hall_<?php echo $row_hall['id_hall']; ?>"><?php echo '<img src="img/'.$row_hall['hall_code'].'.png" />'; ?> <?php echo stripslashes($row_hall['hall_name']); ?></label>
		</li><?php
	}
?></ul>
</td>

<td>
<ul><?php
	$reqsql_floor = "SELECT * FROM t_floor";
	$ressql_floor = mysqli_query($link, $reqsql_floor) or die(mysqli_error($link));
	while ($row_floor = mysqli_fetch_array($ressql_floor)) {
		?><li><input type="radio" name="drop_floor" id="drop_floor_<?php echo $row_floor['floor_nb']; ?>" value="<?php echo $row_floor['floor_nb']; ?>" <?php if (isset($_POST['submit_stats'])) { if ($floor_nb==$row_floor['floor_nb']) { echo 'checked="checked"'; } } ?>><label for="drop_floor_<?php echo $row_floor['floor_nb']; ?>"><?php echo $row_floor['floor_nb']; ?></label></li><?php
	}
?></ul>
</td>

<td>
<?php
	mysqli_data_seek($ressql_hall,0);
	while ($row_hall = mysqli_fetch_array($ressql_hall)) {
?><ul id="list_drops_hall_<?php echo $row_hall['hall_code']; ?>" <?php if (isset($_POST['submit_stats'])) { if ($id_hall==$row_hall['id_hall']) { echo 'style="display:inline-block;"'; } else { echo 'style="display:none;"'; } } else { echo 'style="display:none;"'; } ?>><?php
		//Get drop list for each hall
		$reqsql_hall_drops = "SELECT t_drop.drop_name, t_drop.drop_code, t_drop.id_drop FROM t_drop, t_hall_drop WHERE t_drop.drop_code=t_hall_drop.drop_code AND t_hall_drop.hall_code='".$row_hall['hall_code']."'";
		$ressql_hall_drops = mysqli_query($link, $reqsql_hall_drops) or die(mysqli_error($link));
		while ($row_hall_drop = mysqli_fetch_array($ressql_hall_drops)) {
			?><li><input type="radio" name="drop_drop" id="drop_drop_<?php echo $row_hall['id_hall']; ?>_<?php echo $row_hall_drop['id_drop']; ?>" value="<?php echo $row_hall_drop['id_drop']; ?>"><label for="drop_drop_<?php echo $row_hall['id_hall']; ?>_<?php echo $row_hall_drop['id_drop']; ?>"><?php echo '<img src="img/'.$row_hall_drop['drop_code'].'.png" />'; ?> <?php echo stripslashes($row_hall_drop['drop_name']); ?></label></li><?php
		}
?></ul><?php
	}
?>
</td>

<td>
<ul id="drop_qty_list">
	<li><input type="radio" name="drop_qty" id="drop_qty_1" value="1"><label for="drop_qty_1">1</label></li>
	<li><input type="radio" name="drop_qty" id="drop_qty_2" value="2"><label for="drop_qty_2">2</label></li>
	<li><input type="radio" name="drop_qty" id="drop_qty_3" value="3"><label for="drop_qty_3">3</label></li>
	<li><input type="radio" name="drop_qty" id="drop_qty_4" value="4"><label for="drop_qty_4">4</label></li>
	<li><input type="radio" name="drop_qty" id="drop_qty_5" value="5"><label for="drop_qty_5">5</label></li>
</ul>
</td>

<td>
<input type="submit" id="submit_stats" name="submit_stats" />
</td>

					</tr>
				</tbody>
			</table>
		</form>
		
		<div id="stats">
<?php

$reqsql_halls = "SELECT * FROM t_hall";
$ressql_halls = mysqli_query($link, $reqsql_halls) or die(mysqli_error($link));
while ($row_hall = mysqli_fetch_array($ressql_halls)) {
	echo '<h2><img src="img/'.$row_hall['hall_code'].'.png" /> '.stripslashes($row_hall['hall_name']).' <img src="img/'.$row_hall['hall_code'].'.png" /></h2>';
	
	//drops linked
	$reqsql_hall_drops = "SELECT * FROM t_drop, t_hall_drop WHERE t_drop.drop_code = t_hall_drop.drop_code AND t_hall_drop.hall_code='".$row_hall['hall_code']."'";
	$ressql_hall_drops = mysqli_query($link, $reqsql_hall_drops) or die(mysqli_error($link));
?>
<table>
	<caption>Possible drops</caption>
	<thead>
		<tr>
			<th></th>
			<th>Name</th>
			<th>Min</th>
			<th>Max</th>
		</tr>
	</thead>
	<tbody>
<?php
	while ($row_hall_drops = mysqli_fetch_array($ressql_hall_drops)) {
?>
		<tr>
			<td><img src="img/<?php echo $row_hall_drops['drop_code']; ?>.png" /></td>
			<td><?php echo stripslashes($row_hall_drops['drop_name']); ?></td>
			<td><?php echo $row_hall_drops['drop_min']; ?></td>
			<td><?php echo $row_hall_drops['drop_max']; ?></td>
		</tr>
<?php
	}
?>
	</tbody>
</table>

<?php
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
		$reqsql_countloot = "SELECT count(id_loot) AS nb FROM t_loot WHERE t_loot.id_hall=".$row_hall['id_hall']." AND t_loot.floor_nb=".$row_floor['floor_nb'];
		$ressql_countloot = mysqli_query($link, $reqsql_countloot) or die(mysqli_error($link));
		$row_countloot = mysqli_fetch_array($ressql_countloot);
		echo "<td>".$row_countloot['nb']."</td>";
	
		//stats by drop
		foreach ($arr_hall_droplist as $droplist_id) {
			$reqsql_loot = "SELECT COUNT(id_loot) as nb_loot, AVG(drop_qty) as avg_drop_qty FROM t_loot WHERE t_loot.id_hall=".$row_hall['id_hall']." AND t_loot.floor_nb=".$row_floor['floor_nb']." AND t_loot.id_drop=".$droplist_id;
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
	</body>
</html>
<?php
	mysqli_close($link);
?>