
<!--#include virtual='/head.html'-->

      <span id="titform">
      	    <span>Login</span> 
      </span>
      
 <!--#include virtual='/traco.html'-->
 
 <!--#include virtual='/tophome.html'-->

  <table id="menuadm" border="0" cellspacing="0">
      <tr style="a:text-decoration:underline;">
			 <td>  
              <a href="frm_cadtimes.php?codigo=0">Inclur novo time</a>
         </td> 
	 			<td>
              <a href="menu_admin.html">Menu Principal</a>
         </td>
      </tr>
      <tr>
	 <td>
		<br>
         </td>
      </tr>

<?php 

  session_start();
  
//  $_ID = session_id();
  
  echo ("Sessão = ".$_SESSION["$_ID"]);
  
?>
      <tr>
	 <td>
		<br>
         </td>
      </tr>
      <tr>
	 <td>  
              <a href="frm_cadtimes.php?codigo=0">Inclur novo time</a>
         </td> 
	 <td>
              <a href="menu_admin.html">Menu Principal</a>
         </td>
      </tr>

</table>

<!--#include virtual='/bothome.html'-->


<!--#include virtual='/rodape.html'-->
