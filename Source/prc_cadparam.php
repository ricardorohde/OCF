<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

      <span id="titform">
          <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> -> 
          <a href="frm_cadparam.php">Cadastro de Par�metros</a> 
      </span>
      
 <?php include("traco.php"); ?>

 <?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 

	$regex = '^'.
				'[-a-z0-9!#$%&\'*+/=?^_<{|}~]+'.          // One or more underscore, alphanumeric, or allowed characters.
				'(\.[-a-zA-Z0-9!#$%&\'*+/=?^_<{|}~]+)*'.  // Followed by zero or more sets consisting of a period
                                         					// of one or more underscore, alphanumeric, or allowed characters.
				'@'.     		                              // Followed by an "at" character.
				'[a-z0-9-]+'.                             // Followed by one or more alphanumeric or hyphen characters.
				'(\.[a-z0-9-]{2,})+'.                     // Followed by one or more sets consisting a period of two
        					                                // or more alphanumeric or hyphen characters.
				'$';

     $emailadm = $_POST['emailadm'];
     $emailwbm = $_POST['emailwbm'];
     $temerro = 0;

     if (empty($emailadm)) {
  		 echo ("<tr><td>Informe o E-mail do administrador do site  </td></tr>")."\n";
   	     $temerro = 1;
   	  }
	 if (!eregi($regex, $emailadm)) {
  		 echo ("<tr><td>E-mail do administrador inv�lido </td></tr>")."\n";
   	   $temerro = 1;
   	  }
     if (empty($emailwbm)) {
  		 echo ("<tr><td>Informe o E-mail do webmaster </td></tr>")."\n";
   	     $temerro = 1;
   	  }
	 if (!eregi($regex, $emailadm)) {
  		 echo ("<tr><td>E-mail do webmaster inv�lido </td></tr>")."\n";
   	   $temerro = 1;
   	  }

       $operacao = '';
      if ($temerro == 1)
            include ("volta.php");
      else {
		       include 'conectadb.php';
		
			   $sql = sprintf("select 'S' tem from cad_param ");
		
			   $result = mysql_query($sql)
			 				or die('\nErro consultando par�metros: ' . mysql_error()); 

			   $row = mysql_fetch_assoc($result);
			   if ($row['tem'] == 'S') {  // Se j� est� cadastrado altera
				   $sql = sprintf("update cad_param " .
				   		"set emailadm = '%s', " .
				   		"emailwbm = '%s'",$emailadm,$emailwbm);

			   	   $result = mysql_query($sql)
			 				or die('\nErro alterando par�metros: ' . mysql_error()); 
				   }
               else {
				   $sql = sprintf("insert into cad_param (emailadm, emailwbm) " .
				   		"values('%s','%s')",$emailadm,$emailwbm);
			   	   $result = mysql_query($sql)
			 				or die('\nErro incluindo par�metros: ' . mysql_error()); 
 
               }   
	         echo "<tr><td>Par�metros alterados !</td></tr>\n";
	         echo '<tr><td><br></td></tr>'."\n";
	         echo '<tr><td><br></td></tr>'."\n";
	         echo '<tr><td><a href="menu_admin.php">OK</a></td></tr>'."\n";
			        
      }

	mysql_close($link);
?>
 </table>
 
<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
