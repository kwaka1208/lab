<?php

	$id = urldecode($_GET["id"]);
	$id = strip_tags($id);
	if(0 == strlen($id))
	{
		die("Please assign ID.");
	}
	require "./config.php";

	$connect = mysql_connect($db_server, $db_user, $db_pass) or die("Connection ERROR : ");
	mysql_select_db($db_name) or die("Database selecion ERROR : ");
	$sql = "SELECT * FROM adtbl WHERE id = '" . $id . "'";
	$result = mysql_query($sql, $connect) or die(mysql_error());
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		print($row["code"]);
	}
	mysql_close($connect);
?>