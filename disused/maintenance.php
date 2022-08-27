<html>
	<head>
		<title>DB Maintenance Script</title>
	</head>
	<body>
<?php
	require "config.php";

	$connect = mysql_connect($db_server, $db_user, $db_pass) or die("Connection Error : " . mysql_error());
	mysql_select_db($db_name) or die("Database selecion error : " . mysql_error());

	$sql = "SELECT * FROM ken_wp_comments WHERE comment_approved = 'spam' OR comment_approved = '0'";
	$result = mysql_query($sql, $connect) or die("SELECT ERROR".mysql_error());
	$count = mysql_num_rows($result);
	print("Kenichi : Number of Spam Found : $count <br />\r\n");

	$sql = "SELECT * FROM hiroyo_wp_comments WHERE comment_approved = 'spam' OR comment_approved = '0'";
	$result = mysql_query($sql, $connect) or die("SELECT ERROR".mysql_error());
	$count = mysql_num_rows($result);
	print("Hiroyo : Number of Spam Found : $count <br />\n");

	$sql = "SELECT * FROM lisa_wp_comments WHERE comment_approved = 'spam' OR comment_approved = '0'";
	$result = mysql_query($sql, $connect) or die("SELECT ERROR".mysql_error());
	$count = mysql_num_rows($result);
	print("Lisa : Number of Spam Found : $count <br />\n");

	$sql = "DELETE FROM ken_wp_comments WHERE comment_approved = 'spam' OR comment_approved = '0'";
	$result = mysql_query($sql, $connect) or die("DELETE ERROR".mysql_error());
	$count = mysql_affected_rows();
	print("Kenichi : Number of Spam Deleted : $count <br />\r\n");

	$sql = "DELETE FROM hiroyo_wp_comments WHERE comment_approved = 'spam' OR comment_approved = '0'";
	$result = mysql_query($sql, $connect) or die("DELETE ERROR".mysql_error());
	$count = mysql_affected_rows();
	print("Hiroyo : Number of Spam Deleted : $count <br />\n");

	$sql = "DELETE FROM lisa_wp_comments WHERE comment_approved = 'spam' OR comment_approved = '0'";
	$result = mysql_query($sql, $connect) or die("DELETE ERROR".mysql_error());
	$count = mysql_affected_rows();
	print("Lisa : Number of Spam Deleted : $count <br />\n");

	mysql_close($connect);
?>
	</body>
</html>
