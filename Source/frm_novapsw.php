<?php include("head.php"); ?>

 <span class="titusr">Nova Senha</span>
      
 <?php include("traco.php"); ?>

 <form method="post" action="prc_novapsw.php" name="frm_novapsw">
  <table id="tabform"   border="0" cellspacing="0" width="440px">
  
       <tr> 
          <td width="30%" style="font-weight:bold;"> Usu&aacute;rio: </td>
          <td width="70%"><input type="text" size="20" maxlength="20" tabindex="0" name="username" value=''> </td>
       </tr>  
       <tr> 
          <td width="30%" style="font-weight:bold;">E-mail: </td>
          <td width="70%"><input type="text" size="50" maxlength="90" tabindex="0" name="email" value=''> </td>
       </tr>  

       <tr> 
          <td colspan="2"><?php include ("traco.php");?> </td>
       </tr>  

       <tr> 
         <td  colspan="2"> <div style="float:left;"> <input tabindex="0" name="gerar" value="Gerar Nova Senha" type="submit">  </div> </td>
       </tr>  

  </table>
 </form>

<?php include ("rodape.php"); ?>
