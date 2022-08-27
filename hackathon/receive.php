<?php
	// API + 認証情報
	$WebAPI_url = "http://tts.exaitalk.net/webtts/tts/ttsget.php";
	$username = "hmTeam2";
	$password = "NR5bx1lP";

	// 出力ファイル名と形式(mp3)
	$ext = "mp3";
	$outfile_name = "tmp/voice-" . $_GET['who'] . "." . $ext;
	$outfile = "./" . $outfile_name;
	$voice_data_url = "http://kwaka1208.net/talk/" . $outfile_name;

	$load_data = "pattern/" . $_GET['who'] . ".php";
	echo $loda_data;
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
	<audio src="<?php echo $voice_data_url ?>" type="audio/mp3" id="voice"></audio>
	<div align="center">
		世紀末電文生成システム<br />「Genesys Ver.1.5.3」<br />
	<img src="<?php echo $image_url ?>" >
	<!-- p class="speak-button"><a href="javascript:voice.play();">話す</a></p -->
	<p><?php echo $inputText ?></p>
	<input type="button" value="話す" class="submit" onclick="javascript:voice.play();">
	</div>
	</body>
</html>
