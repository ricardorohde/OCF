 <SCRIPT language="JavaScript">
document.write('<table width="234" height="110" border="1" cellspacing="0" cellpadding="0" bordercolor="#CCCCCC" bgcolor="#FFFFFF"><tr><td>');
document.write('<table><tr>');
document.write('<td rowspan="2" width="100" align="center" valign="middle">');
if (navigator.appName=="Netscape"){
document.write('<img src="http://pms.mercadolibre.com/cgi/pms/ban?id=20672&site=328736" width="90" height="90"></td>');} else {
document.write('<a NAME=anchor328736 href="http://www.mercadolivre.com.br/jm/pms?site=328736&id=20672&as_opt=http://www.mercadolivre.com.br/" target="_blank"><img name =img328736 src="http://pms.mercadolibre.com/cgi/pms/ban?id=20672&site=328736" width="90" height="90" border=0 ></a></td>');}
document.write('<td width="100"><div align="center"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="120" height="70" ID=swf328736>');
document.write('<param name=movie value="http://www.mercadolibre.com/org-img/ticker/FLASH/institucional_bra.swf?cust_id=16573659&aff_site=328736">');
document.write('<param name=quality value=high>');
document.write('<embed NAME=swf328736 swLiveConnect="true" src="http://www.mercadolibre.com/org-img/ticker/FLASH/institucional_bra.swf?cust_id=16573659&aff_site=328736" quality=high pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="120" height="70"></embed>');
document.write('</object></div></td></tr>');
document.write('<tr><td align="center" valign="middle"><img src="http://www.mercadolibre.com/org-img/ticker/FLASH/logo_bra.gif" width="86" height="20"></td>');
document.write('</tr></table></td></tr></table>');


function swf328736_DoFSCommand(command, args)
{                
  if ( command == "foto" ) {                            
      document["img328736"].src= args;}
  if ( command == "link" ) {                          
     for(a=0;a<=document.links.length-1;a++) {  
         if(document.links[a].name == "anchor328736"){
  	    document.links[a].href=args; } } }
}
</SCRIPT>

<SCRIPT LANGUAGE="VBScript">
Sub swf328736_FSCommand(ByVal command, ByVal args)
    call swf328736_DoFSCommand(command, args)
end sub
</SCRIPT> 
