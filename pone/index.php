<?php
/**
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require '../facebook-php-sdk/src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '518769081487145',
  'secret' => '68bf938084c864b535707a2107e93212',
));

// Get User
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
    $birthday = $user_profile['birthday'];
    $username = $user_profile['name'];

/*
    if (strlen($birthday) < 10)
    {
    	// year not included
    	$byear	= null;
    	$bmonth	= substr($birthday, 1-1, 2);
    	$bdate	= substr($birthday, 3-1, 2);
    }
    else
    {
    	// year included
    	$byear	= substr($birthday, 1-1, 2);
    	$bmonth	= substr($birthday, 6-1, 2);
    	$bdate	= substr($birthday, 8-1, 2);
    }
*/    

  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }

// Login or logout url will be needed depending on current user state.
	if ($user) {
		$logoutUrl = $facebook->getLogoutUrl();
	} else {
		$par = array('scope' => 'publish_stream, user_birthday');
		$loginUrl = $facebook->getLoginUrl($par);
	}
	
	$byear	 = "1967";
	$bmonth	 = "12";
	$bdate	 = "08";
	$apibase = "http://www.mizunotomoaki.com/wikipedia_daytopic/api.cgi/";
	$requri = $apibase . $bmonth . $bdate;
	$str  = null;
	$xmlstr = simplexml_load_file($requri);
	$result = null;
	$blist  = array();

	//var_dump($xmlstr);
	foreach ($xmlstr->tanjyoubi->item as $item )
	{
//		$blist = explode(" - ", %item);
		if ( strpos($item, $byear) !== false)
		{
			// print $item . "\n";
			$result .= "<span class='person'>" . $item ."</span><br />";
		}
	}
}
?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF8"> 
    <title>あなたの誕生日は</title>
	<link href="style.css" type="text/css" rel="STYLESHEET" />
  </head>
  <body>
    <?php if ($user): ?>
      <a href="<?php echo $logoutUrl; ?>">Logout</a>
      <img src="https://graph.facebook.com/<?php echo $user; ?>/picture">
      <div class="message1">こんにちは、<?php echo $username; ?> さん(^_^)</div>
      <div class="message2">あなたの誕生日は...<?php echo $birthday; ?>ですね</div> 
	  <div class="message3">あなたと同じ誕生日の有名人は...<br />
      <?php echo $result; ?>
      です。
      </div>
    <?php else: ?>
      <div>
        Login using OAuth 2.0 handled by the PHP SDK:
        <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
      </div>
    <?php endif ?>
  </body>
</html>
