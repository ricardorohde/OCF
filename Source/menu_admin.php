<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

  <span id="titform">
		   <a href="menu_admin.php">Administra&ccedil;&atilde;o</a>
  </span>
      
 <?php include("traco.php"); ?>
 
  <table id="menuadm">

      <tr>
         <td> <a href="frm_cadparam.php">Cadastro de Parâmetros</a> </td>     
         <td> <a href="lst_cadnoticia.php">Cadastro de Notícias</a> </td>     
       </tr>       
      <tr>
	     <td> <a href="lst_cadenquetes.php">Cadastro de Enquetes</a> </td>     
         <td> <a href="lst_cadeventos.php">Cadastro de Eventos</a> </td>     
       </tr>       
      <tr> 
         <td> <a href="lst_cadreuniao.php">Cadastro de Reuniões</a> </td>     
         <td> <a href="lst_cadcalendario.php">Cadastro de Calendário</a> </td>     
       </tr>       
      <tr> 
         <td> <a href="frm_sms.php">Enviar Mensagem SMS</a> </td>     
         <td></td>     
       </tr>       

  </table>
<?php include ("rodape.php"); ?>
