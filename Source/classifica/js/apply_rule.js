$JQ.extend($JQ.noah, {
    addInlineWarningOnFocus: function(attr, text)
    {
        $JQ('.cell [name="' + attr + '"]').focus(function() {
            var cell = $JQ(this).closest('.cell');
            if( cell.find('.ruleWarning').length==0 )
            {
                $JQ(this).closest('.cell').append('<br><span class="ruleWarning">' + text + '</span>');
            }
        });
    },
    addInlineWarningOnChange: function(attr, value, text)
    {
        var action = function() {
            var displayRule = function(obj, value, text) {
                var cell = $JQ(obj).closest('.cell');
                if( cell.find('#ruleWarning_'+value).length==0 )
                {
                    $JQ(obj).closest('.cell').append('<br><span class="ruleWarning" id="ruleWarning_' + value + '">' + text + '</span>');
                }
            }
            if( $JQ(this).getValue()==value ) displayRule(this, value, text);
            else
            {
                var y = $JQ(this).fieldArray();
                for( var key in y )
                {
                    if( y[key]==value )
                    {
                        displayRule(this, value, text);
                        break;
                    }
                }
            }
        }
        $JQ('.cell input[name="' + attr + '"]').click(action);
        $JQ('.cell select[id="' + attr + '"]').change(action);
    },
    popupOverlayOnLoad: function(overlaySelector)
    {
        $JQ(overlaySelector).overlay().load();
    },
    popupOverlayOnSubmit: function(overlaySelector)
    {
        $JQ('div[id$=item-modify_form], div[id$=item-create_form]').closest('form').submit( function() {
            $JQ(overlaySelector).overlay().load();
            return false;
        });                               
    }
});
