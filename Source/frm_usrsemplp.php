<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

      <span id="titform">
      	    <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> ->
            <a href="lst_usrsemplp.php">Relação de Usuários Sem Palpite</a>
      </span>
      
 <?php include("traco.php"); ?>
 
 <?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0" width="600px" style="width:600px;">
      <tr style="a:text-decoration:underline;">
		<td colspan=5>
              <a href="menu_admin.php">Menu Principal</a>
         </td>
      </tr>
      <tr>
	 <td>
		<br>
         </td>
      </tr>
<?php 


	$camp = $_GET['camp'];
	$rod = $_GET['rod'];
  
	include ('conectadb.php');

        $sql = sprintf("select descricao from " .
        		"cad_campeonato " .
        		"where " .
        		"codigo = %d ",
        		$camp);

    	$result = mysql_query($sql)
					or die('\nErro consultando Campeonato: ' . mysql_error()); 

		$row = mysql_fetch_assoc($result);

        $lr = sprintf ("<tr><td style='text-decoration: underline;font-size:11px;' colspan=2><b>Rodada: %02d </td><td colspan=6>%s</td></tr>"
                          ,$rod,$row['descricao']);
        echo ($lr)."\n";

		mysql_free_result($result);
	 	
        $sql = sprintf("select username,nome,email,ddd,fone,dddcel,celular from " .
        		"cad_inscricao i," .
        		"cad_usuario u " .
        		"where " .
        		"i.userid = u.userid " .
        		"and i.userid not in " .
        		"	(select userid from cad_palpite " .
        		"		where campeonato = %d " .
        		"			  and rodada = %d) " .
        		"and i.campeonato = %d " .
        		"order by username",
        		$camp,$rod,$camp);

		$result = mysql_query($sql)
						or die('\nErro consultando banco de dados: ' . mysql_error()); 
        $fllin = 0;

        echo ('         <tr class="cabec"> <td>Usuário</td> <td>Nome</td><td>E-Mail</td><td>Fone</td><td>Celular</td></tr>')."\n";

       if (mysql_num_rows($result) == 0) {
      	   echo("<tr><td colspan=7>Todos registraram palpites nessa rodada.</td></tr>");
       }

				while ($row = mysql_fetch_assoc($result)) {
					
               if ($fllin == 0) {
                   $fllin = 1;
                   echo ('        <tr class="rel1"'.'>');
                   }
               else
                   {
                   $fllin = 0;
                   echo ('        <tr class="rel2"'.'>');
                   }  

          $linha = sprintf ('<td>%s</td><td>%s</td><td>%s</td><td>(%s) %s</td><td>(%s) %s</td>', $row['username'],$row['nome'],$row['email'],$row['ddd'],$row['fone'],$row['dddcel'],$row['celular']);

          echo ($linha.'</tr>')."\n";
	}
        
	mysql_free_result($result);
	mysql_close($link);
?>
      <tr>
	 <td>
		<br>
         </td>
      </tr>
      <tr>
		 <td colspan=5>
              <a href="menu_admin.php">Menu Principal</a>
         </td>
      </tr>

</table>

<?php include ("bothome.php"); ?>
<?php include ("rodape.php"); ?>
