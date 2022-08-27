<html lang="ja">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
		<title>おみくじデータ</title>
	</head>
	<body>
	<table border="1">
<?php
	require "../common/config.php";
	$connect = mysql_connect($db_server, $db_user, $db_pass) or die("Connection Error : " . mysql_error());
	mysql_select_db($db_name) or die("Database selecion error : " . mysql_error());

	$sql = "SELECT * FROM fortune ORDER BY date";
	$result = mysql_query($sql, $connect) or die("SELECT ERROR".mysql_error());
	print("件数:".mysql_num_rows($result)."<br />");
	print("<tr><td>日付</td><td>名前</td><td>ハッシュ値</td></tr>");
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
//		$name = urldecode($row["name"]);
		$name = $row["name"];
		$date = $row["date"];
		$hash = $row["hash"];
		print ("<tr><td>$date</td><td>$name</td><td>$hash</td></tr>");
	}

	mysql_close($connect);
?>
	</table>
	</body>
</html>
