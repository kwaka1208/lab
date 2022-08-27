<html>
	<head>
		<title>データを表示する(MySQL)</title>
	</head>
	<body>
		<h3>データを表示する(MySQL)</h3>
<?php
			require "./config.php";
			$enc_disp = "UTF-8";
			$enc_db = "UTF-8";
			
			function cnv_enc($string, $to, $from)
			{
				$det_enc = mb_detect_encoding($string) /*, $from . ", " . $to)*/;
				if ($det_enc and $enc_disp != $to)
				{
					return mb_convert_encoding($string, $to, $det_enc);
				}
				else
				{
					return $string;
				}
			}
			
			$conn = mysql_connect($db_server, $db_user, $db_pass) or die("接続エラー1");
			mysql_select_db($db_name) or die("接続エラー2");
			
			$sql = "SELECT ID, post_title FROM ken_wp_posts ORDER BY id";
			$res = mysql_query($sql, $conn) or die("データ抽出エラー");
			
			echo "<table border=\"1\">";
			echo "<tr>";
			echo "<td>ID</td>";
			echo "<td>タイトル</td>";
			echo "</tr>";
			
			while($row = mysql_fetch_array($res, MYSQL_ASSOC))
			{
				echo "<tr>";
				echo "<td>".$row["ID"]."</td>";
				echo "<td>".cnv_enc($row["post_title"], $enc_disp, $enc_db)."</td>";
				echo "</tr>";
			}
			echo "</table>";
			mysql_close($conn);
?>
	</body>
</html>