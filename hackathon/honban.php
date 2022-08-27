<?php
	$voice_data_url = "";
	$select_value ="0";
	if (isset($_GET['selector']))
	{
		// API + 認証情報
		$WebAPI_url = "http://tts.exaitalk.net/webtts/tts/ttsget.php";
		$username = "hmTeam2";
		$password = "NR5bx1lP";

		// 出力ファイル名と形式(mp3)
		$ext = "mp3";
/*
		if (isset($_GET['cp']))	$filename = $_GET['cp'];
		if (isset($_GET['np']))	$filename = $_GET['np'];
		if (isset($_GET['a']))	$filename = $_GET['a'];
		if (isset($_GET['fc']))	$filename = $_GET['fc'];
		if (isset($_GET['ac']))	$filename = $_GET['ac'];
*/
		$select_value = $_GET['selector'];
		$filename = $_GET['selector'];
		$outfile_name = "tmp/voice-" . $filename . "." . $ext;
		$outfile = "./" . $outfile_name;
		$voice_data_url = "http://kwaka1208.net/talk/" . $outfile_name;
		$load_data = "pattern/" . $filename . ".php";
		include($load_data);
		
		if (!strstr($_GET['inputText'], "お金")
		 && !strstr($_GET['inputText'], "おかね")
		   )
		{
			$inputText = $_GET['inputText'];
		}

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
	$inputText = "";
	if (isset($_GET['inputText']))
	{
		$inputText = $_GET['inputText'];
		
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
        <title>Genesys Ver.0.9.9</title>
        <meta name="description" content="">
<meta name="viewport"
content="width=device-width
, initial-scale=1.0
, maximum-scale=1.0
, user-scalable=no">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-capable" content="yes">
<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon.png"> 
<link rel="apple-touch-startup-image" href="img/apple-touch-startup-image.png">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/ui.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
<form action="http://kwaka1208.net/talk/honban.php" method="get">
<div class="container">
	<div class="title">Genesys Ver.0.9.9</div>
	<input type="text" class="word" name="inputText" placeholder="どんなことを？" value="<?php echo $inputText; ?>"></input>
	<ul>
		<li>
			<input type="radio" id="cp" name="selector" value="1" <?php if ($select_value =="1") echo "checked"; ?>>
			<label for="cp">父の様に</label>
		</li>
		<li>
			<input type="radio" id="np" name="selector" value="2" <?php if ($select_value =="2") echo "checked"; ?>>
			<label for="np">母の様に</label>
		</li>
		<li>
			<input type="radio" id="a" name="selector" value="3" <?php if ($select_value =="3") echo "checked"; ?>>
			<label for="a">普通の大人の様に</label>
		</li>
		<li>
			<input type="radio" id="ac" name="selector" value="4" <?php if ($select_value =="4") echo "checked"; ?>>
			<label for="ac">素直な子の様に</label>
		</li>
		<li>
			<input type="radio" id="fc" name="selector" value="5" <?php if ($select_value =="5") echo "checked"; ?>>
			<label for="fc">わがままな子の様に</label>
		</li>
		<li>
			<input class="submit" type="submit" value="話す"></input>
		</li>
	</ul>
</div>
<br />
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
    </body>
</html>
