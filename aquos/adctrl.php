<?php
	$id = urldecode($_GET["id"]);
	$id = strip_tags($id);
	$code = urldecode($_GET["code"]);
	$code = strip_tags($code);
	if(0 == strlen($id) || 0 == strlen($code))
	{
		die("Please assign ID and CODE.");
	}
	require "./config.php";

	$connect = mysql_connect($db_server, $db_user, $db_pass) or die("Connection ERROR : ");
	mysql_select_db($db_name) or die("Database selecion ERROR : ");
	$sql = "UPDATE adtbl SET code ='" . $code. "' WHERE id = '" . $id . "'";
	$result = mysql_query($sql, $connect) or die(mysql_error());
	mysql_close($connect);
?>