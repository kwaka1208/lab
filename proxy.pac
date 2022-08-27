function FindProxyForURL(url, host)
{
	/* #################################################################### */
	/*				Direct													*/
	/* #################################################################### */
	if(
		/* Certificate LAN */
		shExpMatch(host,"sec-auth*.osa.sharp.co.jp")
		 || shExpMatch(host,"www.kintai.sharp.co.jp")
		 || shExpMatch(host,"toa05.oa.osa.sharp.co.jp")
		 || shExpMatch(host,"intra-web04.sharp.co.jp")
		 || shExpMatch(host,"secure.sharp.co.jp")

		/* Mail */
		 || shExpMatch(url, "pop.sharp.co.jp")
		 || shExpMatch(url, "mail.sharp.co.jp")

		/* localhost */
		 || shExpMatch(host,"localhost")
		 || shExpMatch(host,"127.0.0.1")

		/* localarea */
		 || isPlainHostName(host)
		 || shExpMatch(host, "10.*.*.*")
		 || shExpMatch(host, "192.168.*.*")
		 || shExpMatch(host, "*.osa.sharp.co.jp")
	)
	{
		return "DIRECT";
	}

	/* #################################################################### */
	/*				normal proxy											*/
	/* #################################################################### */
/*
	if(
		shExpMatch(host, "*.sharp.co.jp")
		 || shExpMatch(host,"antispam.sharp.co.jp")
		 || shExpMatch(host, "*.kuronekoyamato.co.jp")
	)
	{
		return "PROXY proxy.osa.sharp.co.jp:3080";
	}
*/
	/* #################################################################### */
	/*				special proxy											*/
	/* #################################################################### */
	if(
		shExpMatch(host, "*.playstation.com")

		 || shExpMatch(host, "mail.google.com")
		 || shExpMatch(host, "*.twitter.com")
		 || shExpMatch(host, "twitter.com")
		 || shExpMatch(host, "*.twitter.jp")
		 || shExpMatch(host, "twitter.jp")

		 || shExpMatch(host, "*.nintendo.co.jp")
		 || shExpMatch(host, "*.macromill.com")
		 || shExpMatch(host, "*.ustream.tv")
		 || shExpMatch(host, "*.youtube.com") 

		 || shExpMatch(host, "*.evernote.com")
		 || shExpMatch(host, "*.facebook.com")
		 || shExpMatch(host, "*.fbcdn.net")
		 || shExpMatch(host, "*.dogatch.jp")
		 || shExpMatch(host, "dogatch.jp")
		 || shExpMatch(host, "streaming.yahoo.co.jp")
		 || shExpMatch(host, "*.icloud.com") 
		 || shExpMatch(host, "podcastrank.jp")
		 || shExpMatch(host, "pinterest.com")
		 || shExpMatch(host, "30d.jp")
		 || shExpMatch(host, "mixi.jp")
		 || shExpMatch(host, "*.buzzlife.jp")
		 || shExpMatch(host, "*.dropbox.com")
		 || shExpMatch(host, "*.foursquare.com")
		 || shExpMatch(host, "hootsuite.com")
		 || shExpMatch(host, "*.slideshare.net")
		 || shExpMatch(host, "*.chatwork.com")
		 || shExpMatch(host, "radiko.jp")
	)
	{
		return "PROXY proxy4.sharp.co.jp:4080";
	}

	return "PROXY proxy.osa.sharp.co.jp:3080";
//	return "PROXY proxy4.sharp.co.jp:4080";

}
