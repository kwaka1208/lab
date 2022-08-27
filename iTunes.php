<?php
	$outputData = "";
	if (isset($_GET['inputData']))
	{
		$inputData	= $_GET['inputData'];
		$pattern	= "(^.+?)\t.+";
		$replacemnt	= "\<li\>$1\<\/li\>\n"
		$outputData = preg_replace($pattern, $replacemnt, $inputData);
		$inputData;
		
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
        <title>iTunesリストコンバーター</title>
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
<form action="iTunes.php" method="get">
	<input type="textarea" name="inputData" placeholder="iTunesのプレイリストを貼付けてください。" value="<?php echo $inputData; ?>"></input>
	<input class="submit" type="submit" value="送信"></input>
</form>
<?php
	if ($outputData != "")
	{
		echo "<div>";
		echo $outputData;
		echo "</div>";
	}
?>
    </body>
</html>
