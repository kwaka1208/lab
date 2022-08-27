<?php

$byear	 = "1";
$bmonth	 = "05";
$bdate	 = "31";
$apibase = "http://www.mizunotomoaki.com/wikipedia_daytopic/api.cgi/";
$requri = $apibase . $bmonth . $bdate;
$str  = null;

$xmlstr = simplexml_load_file($requri);
//var_dump($xmlstr);

foreach ($xmlstr->tanjyoubi->item as $item )
{
	if ( strpos($item, $byear) !== false)
	{
		print $item . "\n";
	}
}

?>

