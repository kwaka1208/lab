<?php

	$name = urldecode($_GET["name"]);
	$name = strip_tags($name);
	if(0 == strlen($name))
	{
		die("名前を入力してください。");
	}
	$name2 = $name .date("Y");	// 毎年同じ結果にならない様に、年データを付与
	$hash = GetHash($name2);	// 年データ付きの文字列でHASH値を取得
	$fortune = intval(substr($hash, 0, 1), 16);	
	$message = GetFortuneMessage($name, $fortune);

/*
	print("name=" . $name . "<br />");
	print("name2=" . $name2 . "<br />");
	print("hash=" . $hash . "<br />");
	print("fortune=" . $fortune . "<br />");
*/

	print($message);
	Record($name, $fortune);	

function Record($name, $fortune)
{
	require "../common/config.php";

	$date = date("Y-m-d");
	$localtime = localtime(time(),true);
	$date .= " ".$localtime["tm_hour"]."-".$localtime["tm_min"];
//	print($date);

	$name3 = cnv_enc($name, "EUC-JP");

	$connect = mysql_connect($db_server, $db_user, $db_pass) or die("Connection ERROR : ");
	mysql_select_db($db_name) or die("Database selecion ERROR : ");
	$sql = "INSERT INTO fortune(date, name, hash) VALUES(\"$date\", \"$name3\", $fortune)";
	$result = mysql_query($sql, $connect) or die(mysql_error());
	mysql_close($connect);

//	print($sql."<br />");

}

function GetHash($name)
{
	$hash = hash("md5", $name, false);
	return $hash;
}

function GetFortuneMessage($name, $fortune)
{
	
	switch($fortune)
	{
	case 1:
		$msg = "<span class='fortune_result'>・・・・</span><br />...今回のことは無かったことにしましょう...";
		break;
	case 2:
	case 3:
	case 4:
	case 5:
	case 6:
		$msg = "<span class='fortune_result'>中吉！！</span><br />何ごともほどほどが肝心ですね！";
		break;

	case 0:
	case 7:
		$msg = "<span class='fortune_result'>大吉！！！</span><br />おめでとうございます、他ではおみくじ引かない様に！";
		break;
	case 8:
	case 9:
	case 10:
	case 11:
	case 12:
	case 13:
	case 14:
	case 15:
		$msg = "<span class='fortune_result'>小吉！</span><br />初詣でに行ってたくさんお賽銭しましょう！";
		break;
	}
	$msg = $name."さんの今年の運勢は、<br />".$msg;
	return $msg;
}

function cnv_enc($string, $dest_enc)
{
	$detect_enc = mb_detect_encoding($string);
	if ($detect_enc != $dest_enc)
	{
		return mb_convert_encoding($string, $dest_enc, $detect_enc);
	}
	else
	{
		return $string;
	}
}

?>