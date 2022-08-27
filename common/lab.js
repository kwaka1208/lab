//
//	Change image source
//
function ChangeImage (id, url)
{
	document.getElementById(id).src = url;
}

// Get URL
function GetURL(current, page)
{
	thisLocation = current.toString();
	chara = '/';
	index = thisLocation.lastIndexOf(chara, thisLocation.length);
	if (index != -1)
	{
		thisLocation = thisLocation.substring(0, index);
		thisLocation += page;
	}
	return thisLocation;
}
// Get Protocol and Host name
function GetProtocolAndHostName()
{
	var str = window.location.protocol + "//";
	str = str + window.location.hostname + "/";
	return str;
}


// Get Count URL
function GetNumberImageSource(number, type)
{
	if ("blank" == number)
		return "/images/count/blank.gif";

	switch(type)
	{
	case 0:
		str = new String("/images/count/g-" + number + ".gif");
		break;

	case 1:
		str = new String("/images/count/m-" + number + ".gif");
		break;

	case 2:
		str = new String("/images/count/newyear-" + number + ".gif");
		break;
	}
	return str;
}
function GetNumberImage(number, type)
{
	src = GetNumberImageSource(number, type);
	str = "<IMG SRC='" + src +"'>";		
	return str;
}

function SetAge()
{
	var today = new Date();
	var	byear = today.getYear();
	if (byear < 1900) byear+=1900;

	switch (today.getMonth())
	{
	case 2:
		if (today.getDate() < 6 )
			byear = byear - 1;
		break;
	case 1:
	case 0:
		byear = byear - 1;
	default:
	}

	var birthday =  new Date(byear,2,5,22,17,0);
	diff = today.getTime() - birthday.getTime();
	d = Math.floor(diff /(24*60*60*1000));
	byear -= 1998;
	strYear = byear.toString(10);
	strDay = d.toString(10);
	document.write(GetNumberImage(strYear.substr(0,1),0));
	document.write(GetNumberImage(strYear.substr(1,1),0));
	document.write("才と");
	document.write(GetNumberImage(strDay.substr(0,1),0));
	if (strDay.length > 1)
		document.write(GetNumberImage(strDay.substr(1,1),0));
	if (strDay.length > 2)
		document.write(GetNumberImage(strDay.substr(2,1),0));
}

//
//	時計表示用
//

function ShowClock()
{
	var currentDate = new Date();
	h = currentDate.getHours();
	m = currentDate.getMinutes();
	s = currentDate.getSeconds();

// Hour
	strHour = h.toString(10);
	ChangeImage("hour1", GetURL(GetProtocolAndHostName(),GetNumberImageSource(strHour.substr(0,1),0)));
	if (strHour.length == 2)
		ChangeImage("hour2", GetURL(GetProtocolAndHostName(),GetNumberImageSource(strHour.substr(1,1),0)));
	else
		ChangeImage("hour2", GetURL(GetProtocolAndHostName(),GetNumberImageSource("blank",0)));

// Hour
	strMinute = m.toString(10);
	if (strMinute.length == 2)
	{
		ChangeImage("minute1", GetURL(GetProtocolAndHostName(),GetNumberImageSource(strMinute.substr(0,1),0)));
		ChangeImage("minute2", GetURL(GetProtocolAndHostName(),GetNumberImageSource(strMinute.substr(1,1),0)));
	}
	else
	{
		ChangeImage("minute1", GetURL(GetProtocolAndHostName(),GetNumberImageSource("0",0)));
		ChangeImage("minute2", GetURL(GetProtocolAndHostName(),GetNumberImageSource(strMinute.substr(0,1),0)));
	}
	
// Second
	strSecond = s.toString(10);
	if (strSecond.length == 2)
	{
		ChangeImage("second1", GetURL(GetProtocolAndHostName(),GetNumberImageSource(strSecond.substr(0,1),0)));
		ChangeImage("second2", GetURL(GetProtocolAndHostName(),GetNumberImageSource(strSecond.substr(1,1),0)));
	}
	else
	{
		ChangeImage("second1", GetURL(GetProtocolAndHostName(),GetNumberImageSource("0",0)));
		ChangeImage("second2", GetURL(GetProtocolAndHostName(),GetNumberImageSource(strSecond.substr(0,1),0)));
	}
}

var AdCode1 = 99;
var NewAdCode1 = 99;
var AdCode2 = 99;
var NewAdCode2 = 99;

function GetAd(number)
{
	var str;

	switch(number)
	{
	case 0: // HMV
		str = "<a href='http://click.linksynergy.com/fs-bin/click?id=PAFZ6acEiYg&offerid=131139.10000129&type=4&subid=0'><IMG alt='HMVジャパン' border='0' src='http://img.hmv.co.jp/News/images/top/ls/ex125_125.jpg'></a><IMG border='0' width='1' height='1' src='http://ad.linksynergy.com/fs-bin/show?id=PAFZ6acEiYg&bids=131139.10000129&type=4&subid=0'>";
		str = str + "<a href='http://click.linksynergy.com/fs-bin/click?id=PAFZ6acEiYg&offerid=131139.10000114&type=4&subid=0'><IMG alt='HMVジャパン' border='0' src='http://img.hmv.co.jp/News/images/top/ls/to125_125.jpg'></a><IMG border='0' width='1' height='1' src='http://ad.linksynergy.com/fs-bin/show?id=PAFZ6acEiYg&bids=131139.10000114&type=4&subid=0'>";
		break;

	case 1: // ANA
		str = "<a href='http://click.linksynergy.com/fs-bin/click?id=PAFZ6acEiYg&offerid=119240.10000503&type=4&subid=0'><IMG alt='ANAの旅行サイト【ANA SKY WEB TOUR】' border='0' src='http://www.ana.co.jp/travel/af_banner/100_125_125.gif'></a><IMG border='0' width='1' height='1' src='http://ad.linksynergy.com/fs-bin/show?id=PAFZ6acEiYg&bids=119240.10000503&type=4&subid=0'>";
		str = str + "<a href='http://click.linksynergy.com/fs-bin/click?id=PAFZ6acEiYg&offerid=119240.10000443&type=4&subid=0'><IMG alt='ANAの旅行サイト【ANA SKY WEB TOUR】' border='0' src='http://www.ana.co.jp/travel/af_banner/ski_banner_125x125_a.jpg'></a><IMG border='0' width='1' height='1' src='http://ad.linksynergy.com/fs-bin/show?id=PAFZ6acEiYg&bids=119240.10000443&type=4&subid=0'>";
		break;

	case 2: // CUOCA
		str = "<a href='http://click.linksynergy.com/fs-bin/click?id=PAFZ6acEiYg&offerid=179433.10000127&type=4&subid=0'><IMG alt='【クオカ：生キャラメル】125×125' border='0' src='http://cuocafile.idi.jp/library/images/linkshare/banner/b_c83_125_125.jpg'></a><IMG border='0' width='1' height='1' src='http://ad.linksynergy.com/fs-bin/show?id=PAFZ6acEiYg&bids=179433.10000127&type=4&subid=0'>";
		str = str + "<a href='http://click.linksynergy.com/fs-bin/click?id=PAFZ6acEiYg&offerid=179433.10000106&type=4&subid=0'><IMG alt='クオカ／cuoca　憧れのマカロンに挑戦！' border='0' src='http://cuocafile.idi.jp/library/images/linkshare/banner/b_c72_125_125.jpg'></a><IMG border='0' width='1' height='1' src='http://ad.linksynergy.com/fs-bin/show?id=PAFZ6acEiYg&bids=179433.10000106&type=4&subid=0'>";
		break;

	case 3: // Oisix
		str = "<a href='http://click.linksynergy.com/fs-bin/click?id=PAFZ6acEiYg&offerid=185549.10000566&type=4&subid=0'><IMG alt='Ｏｉｓｉｘ（おいしっくす）/Okasix（おかしっくす）' border='0' src='http://www.oisix.com/tokubetsu/image/lsrv_125_125.jpg'></a><IMG border='0' width='1' height='1' src='http://ad.linksynergy.com/fs-bin/show?id=PAFZ6acEiYg&bids=185549.10000566&type=4&subid=0'>";
		str = str + "<a href='http://click.linksynergy.com/fs-bin/click?id=PAFZ6acEiYg&offerid=185549.10000286&type=4&subid=0'><IMG alt='Ｏｉｓｉｘ（おいしっくす）/Okasix（おかしっくす）' border='0' src='http://www.oisix.com/affiliate/image/10000286.gif'></a><IMG border='0' width='1' height='1' src='http://ad.linksynergy.com/fs-bin/show?id=PAFZ6acEiYg&bids=185549.10000286&type=4&subid=0'>";
		break;

	default: // ベルメゾン
		str = "<a href='http://click.linksynergy.com/fs-bin/click?id=PAFZ6acEiYg&offerid=47523.10009317&type=4&subid=0'><IMG alt='ベルメゾンネット' border='0' src='http://www2.bellemaison.jp/pc/premoni/ad/lsimg/bn_nyugakugift_125_125.gif'></a><IMG border='0' width='1' height='1' src='http://ad.linksynergy.com/fs-bin/show?id=PAFZ6acEiYg&bids=47523.10009317&type=4&subid=0'>";
		str = str + "<a href='http://click.linksynergy.com/fs-bin/click?id=PAFZ6acEiYg&offerid=47523.10009287&type=4&subid=0'><IMG alt='ベルメゾンネット' border='0' src='http://www2.bellemaison.jp/pc/premoni/ad/lsimg/bn_lsizetops_125_125.gif'></a><IMG border='0' width='1' height='1' src='http://ad.linksynergy.com/fs-bin/show?id=PAFZ6acEiYg&bids=47523.10009287&type=4&subid=0'>";
		break;
	}
	
	return(str);
}

function UpdateAd()
{
	var str;
	
	GetAdCode1();
	
	if ( NewAdCode1 != AdCode1)
	{
		AdCode1 = NewAdCode1;
		str = GetAd(AdCode1);
		document.getElementById("ad1").innerHTML = str;
	}
	
	GetAdCode2();
	
	if ( NewAdCode2 != AdCode2)
	{
		AdCode2 = NewAdCode2;
		str = GetAd(AdCode2);
		document.getElementById("ad2").innerHTML = str;
	}
}

function GetAdCode1()
{
	url = "/lab/adread.php?id=0";
	new Ajax.Request(url,
		{method:"get",
		onSuccess:
		function(xmlhttp)
		{
			NewAdCode1 = eval(unescape(xmlhttp.responseText));
		}
	});
	return false;
}

function GetAdCode2()
{
	url = "/lab/adread.php?id=1";
	new Ajax.Request(url,
		{method:"get",
		onSuccess:
		function(xmlhttp)
		{
			NewAdCode2 = eval(unescape(xmlhttp.responseText));
		}
	});
	return false;
}
