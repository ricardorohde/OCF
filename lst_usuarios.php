<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

      <span id="titform">
      	    <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> ->
            <a href="lst_cadrodada.php">Relação de Usuários</a>
      </span>
      
 <?php include("traco.php"); ?>
 
 <?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0" width="600px" style="width:600px;">
      <tr style="a:text-decoration:underline;">
	 			<td>
              <a href="menu_admin.php">Menu Principal</a>
         </td>
      </tr>
      <tr>
	 <td>
		<br>
         </td>
      </tr>
<?php 

  $dw = array("Dom","Seg","Ter","Qua","Qui","Sex","Sab"); 

	include ('conectadb.php');

        $sql = sprintf("select username,nome,email,ddd,fone,dddcel,celular,nivel,ifnull(flinsc,'N')
								from cad_usuario c
							    left join
							 	(select userid,'S' flinsc from
							 			cad_inscricao) i
							 	on c.userid = i.userid
								order by nome,username");

		$result = mysql_query($sql)
					or die('\nErro consultando banco de dados: ' . mysql_error()); 

        $fllin = 0;

        echo ('         <tr class="cabec"> <td>Usuário</td> <td>Nome</td> <td>E-Mail</td><td>Fone</td><td>Celular</td><td>Inscr.</td><td>Nível</td></tr>')."\n";
       if (mysql_num_rows($result) == 0) {
      	   echo("<tr><td colspan=7>Nenhum usuário cadastrado no momento.</td></tr>");
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
               if ($row['nivel'] == 999999)
                   $nivel = "Admin";
               else
                   $nivel = "Padrão";
                   
               $ln = sprintf("<td>%s</td>" .  //username
               		"<td>%s</td>" . //Nome
               		"<td>%s</td>" . //E-Mail
               		"<td>%s-%s</td>" . //DDD-Fone
               		"<td>%s-%s</td>" . //DDD-Celular
               		"<td>%s</td>" . //Inscrito
               		"<td>%s</td>"  //Nível
               		,$row['username'],$row['nome'],$row['email'],$row['ddd'],$row['fone'],$row['dddcel'],$row['celular'],$row['flinsc']
               		,$nivel);

          echo ($ln.'</tr>')."\n";
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
	<td>
              <a href="menu_admin.php">Menu Principal</a>
         </td>
      </tr>

</table>

<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>
