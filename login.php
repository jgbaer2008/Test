<div id="login_form">
<?php

if (!(isset($_SESSION['ID']))) {

	if (isset($_POST['form_login_submit'])) {
		//connecting
		$form_login_name = addslashes(clearFormInput($_POST['form_login_name']));
		$form_login_password = md5($_POST['form_login_password']);
		
		$reqsql_searchacc = "SELECT * FROM t_acc WHERE acc_name='".$form_login_name."'";
		$ressql_searchacc = mysqli_query($link, $reqsql_searchacc) or die(mysqli_error($link));
		if (mysqli_num_rows($ressql_searchacc)>0) {
			//acc exist
			$row_searchacc = mysqli_fetch_array($ressql_searchacc);
			if ($row_searchacc['acc_pwd']==$form_login_password) {
				$_SESSION['ID']=$row_searchacc['id_acc'];
				echo "Logged in as ".stripslashes($row_searchacc['acc_name']).' - <a href="mystats.php">my Drop Statistics</a> - <a href="logout.php">Logout</a>';
			} else {
				echo "<b>Invalid password, try again!</b>";
?>
<form method="post" action="">
	<input type="text" id="form_login_name" name="form_login_name" placeholder="Account name" value="<?php echo stripslashes($form_login_name); ?>" />
	<input type="password" id="form_login_password" name="form_login_password" placeholder="Password" />
	<input type="submit" id="form_login_submit" name="form_login_submit" value="Login / Subscribe" />
</form>
<?php
			}
		} else {
			//create account
			$reqsql_accacc = "INSERT INTO t_acc VALUES(NULL,'".$form_login_name."','".md5($form_login_password)."')";
			mysqli_query($link, $reqsql_accacc) or die(mysqli_error($link));
			$_SESSION['ID']=mysqli_insert_id($link);
			echo "Logged in as ".stripslashes($form_login_name).' - <a href="mystats.php">my Drop Statistics</a> - <a href="logout.php">Logout</a>';
		}
	} else {
		//connect form
?>
<form method="post" action="">
	<input type="text" id="form_login_name" name="form_login_name" placeholder="Account name" />
	<input type="password" id="form_login_password" name="form_login_password" placeholder="Password" />
	<input type="submit" id="form_login_submit" name="form_login_submit" value="Login / Subscribe" />
</form>
<?php
	}
} else {
	//connected
	$reqsql_acc = "SELECT acc_name FROM t_acc WHERE id_acc=".$_SESSION['ID'];
	$ressql_acc = mysqli_query($link, $reqsql_acc) or die(mysqli_error($link));
	$row_acc = mysqli_fetch_array($ressql_acc);
	echo "Logged in as ".stripslashes($row_acc['acc_name']).' - <a href="mystats.php">my Drop Statistics</a> - <a href="logout.php">Logout</a>';
}
?>
</div>