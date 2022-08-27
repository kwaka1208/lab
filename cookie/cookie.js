/*
	Cookie
*/
function getCookie(key)
{
	var cookies = document.cookie.split("; ");
	for (var i = 0; i < cookies.length; i++)
	{
		var str = cookies[i].split("=");
		if (str[0] == key)
		{
			return unescape(str[1]);
		}
	}
	return("");
}

function setCookie(key, val, period)
{
	//
	//domainとpathは省略、デフォルトとする
	//
	str  = key + "=" + escape(val) + "; ";

	var nowTime = new Date().getTime();
	var expires_time = new Date(nowTime + (60 * 60 * 24 * 1000 * period));
	var expires = expires_time.toGMTString();
	str += "expires=" + expires  + "; ";
	document.cookie = str
    alert(str);

	//
	// 有効日付を別に覚える
	//

	var expires_date = expires_time.getUTCFullYear().toString();
		expires_date += (expires_time.getUTCMonth() + 1).toString();
		expires_date += expires_time.getUTCDate().toString();

	str += "expiredate=" + escape(expires_date)  + "; ";
//	str += "expires_time=" + escape(expires_time)  + "; "; // 文字列に変換する前の有効期限を計算しやすいように残しておく
	document.cookie = str;
    alert(str);
}

function loadCookie()
{
	var cookies = document.cookie.split("; ");
	alert(cookies.length);
	
	for (var i = 0; i < cookies.length; i++)
	{
		var str = cookies[i].split("=");
        document.write(str[0] + " = " + unescape(str[1]));
        document.write("<br />");
	}
}
