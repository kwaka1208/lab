<?php
	$voice_data_url = "";
	if (   isset($_GET['who'])
		|| isset($_GET['what'])
		|| isset($_GET['how'])
		|| isset($_GET['long']))
	{
		// API + 認証情報
		$WebAPI_url = "http://tts.exaitalk.net/webtts/tts/ttsget.php";
		$username = "hmTeam2";
		$password = "NR5bx1lP";

		// 出力ファイル名と形式(mp3)
		$ext = "mp3";
		$outfile_name = "tmp/voice-" . $_GET['who'] . "." . $ext;
		$outfile = "./" . $outfile_name;
		$voice_data_url = "http://kwaka1208.net/talk/" . $outfile_name;

		$load_data = "pattern/";
		if (isset($_GET['who']))	$load_data = $load_data . $_GET['who'];
/*
		if (isset($_GET['what']))	$load_data = $load_data . $_GET['what'];
		if (isset($_GET['how']))	$load_data = $load_data . $_GET['how'];
		if (isset($_GET['long']))	$load_data = $load_data . $_GET['long'];
*/
		$load_data = $load_data . ".php";
		include($load_data);

		$doUrl = $WebAPI_url;
		$data = array(
			'username' => $username, 'password' => $password, 'speaker_id' => $speaker_id, 'text' => $inputText, 'ext' => $ext, 'volume' => $volume, 'speed' => $speed, 'pitch' => $pitch, 'range' => $range
		);
		$requestData = http_build_query($data, "", "&");

		$sess = curl_init($doUrl);
		curl_setopt($sess, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($sess, CURLOPT_HEADER, TRUE);
		curl_setopt($sess, CURLOPT_POSTFIELDS, $requestData);
		$response_data = curl_exec($sess);
		if (curl_errno($sess)) {
			$response = "通信失敗(" . curl_error($sess) . ")";
		}
		else
		{
			//"通信成功"
			$hd = curl_getinfo($sess);
			$retcode = $hd['http_code'];
			curl_close($sess);

			$pos_start = strpos($response_data, "<code>");
			$pos_end = strpos($response_data, "</code>");

			if ($pos_start !== false && $pos_end !== false) { //"合成失敗"
				$errcode = substr($response_data, $pos_start + 6, $pos_end - $pos_start - 6 );
				$response = $response_data;
				if (file_exists($outfile)) {
					unlink( $outfile );
				}
			}
			else { //"合成成功"
				if ($ext === "ogg") {
					$fh = fopen($outfile, 'w');
					$mstart = strpos($response_data, "OggS");
					$mdata = substr($response_data, $mstart);
					fwrite($fh, $mdata);
					fclose($fh);
				}
				elseif ($ext === "wma") {
					$fh = fopen($outfile, 'w');
					$mstart = strpos($response_data, "Content-Type: application/octet-stream");
					$mdata = substr($response_data, $mstart + strlen("Content-Type: application/octet-stream"));
					fwrite($fh, $mdata);
					fclose($fh);
				}
				elseif ($ext === "mp3") {
					$fh = fopen($outfile, 'w');
					$mstart = strpos($response_data, "Content-Type: application/octet-stream");
					$mdata = substr($response_data, $mstart + strlen("Content-Type: application/octet-stream"));
					fwrite($fh, $mdata);
					fclose($fh);
				}
				$response = $response_data;
			}
		}
	}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>世紀末電文生成システム「Genesys Ver.1.5.3」</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->

<div align="center">
世紀末電文生成システム<br />「Genesys Ver.1.5.3」
<hr>
<form action="http://kwaka1208.net/talk/single-call.php" method="post">
<select name="who" class="select">
	<option value="0">このバージョンでは一番上のメニューだけ有効です</option>
	<option value="1">誘拐犯-振り込め</option>
	<option value="2">父親-声を聞かせろ</option>
	<option value="3">娘</option>
	<option value="4">誘拐犯-制止する</option>
	<option value="5">刑事-踏み込め</option>
</select>
<br />
<select name="what" class="select">
	<option value="0">何を</option>
	<option value="1">振り込め</option>
	<option value="2">声を聞かせろ</option>
	<option value="3">制止する</option>
	<option value="4">踏み込め</option>
</select>
<br />
<select name="tone" class="select">
	<option value="0">どんな風に</option>
	<option value="1">下手な感じで</option>
	<option value="2">上から目線で</option>
	<option value="3">真顔で</option>
	<option value="4">おちゃらけた感じで</option>
</select>
<br />
<select name="long" class="select">
	<option value="0">どれぐらい</option>
	<option value="1">こんこんと語る</option>
	<option value="2">言葉数少なめに</option>
</select>
<br />
	<input class="submit" type="submit" value="Speak!"></input>
</form>
<?php
	if ($voice_data_url != "")
	{
		echo "<audio src='";
		echo $voice_data_url;
		echo "' type='audio/mp3' id='voice' autoplay></audio>";
		echo $loda_data;
	}
?>
</div>
    </body>
</html>
