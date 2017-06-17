<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

      <span id="titform">
          <a href="menu_admin.php">Administra&ccedil;&atilde;o</a> -> 
          <a href="lst_cadgrupo.php">Cadastro de Grupos</a>
      </span>
      
 <?php include("traco.php"); ?>

 <?php include("tophome.php"); ?>

  <table id="menuadm" border="0" cellspacing="0">

<?php 

       $camp = $_POST['camp'];
       $grupo = trim($_POST['grp']);
       $times = preg_split("/,/",$_POST['times']);

    if (empty($camp)) {
  		 echo ("<tr><td>Selecione o campeonato </td></tr>")."\n";
   	   $temerro = 1;
   	  }
    if (empty($grupo)) {
  		 echo ("<tr><td>Informe o grupo </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   	  
    if (empty($times) || count($times) == 0 || $times[0] == null) {
           echo ("<tr><td>Selecione pelo menos 1 time para o grupo </td></tr>")."\n";
   	   $temerro = 1;
   	  }
    else {
       	include 'conectadb.php';
        if (valida($camp, $grupo, $times) == 0) {
           echo ("<tr><td>Selecione pelo menos 1 time para o grupo </td></tr>")."\n";
       	   $temerro = 1;
   	     }
			}
 
    if ($temerro == 1) {
         include ("volta.php");
				 mysql_free_result($result);
				 mysql_close($link);
      }
   else {

       if ($_POST['Excluir'] == 'Excluir')
               exclui($camp, $grupo);
       else
               grava($camp, $grupo, $times); 
               
				 mysql_close($link);
			}
?>
 </table>
 
<?php include ("bothome.php"); ?>

<?php include ("rodape.php"); ?>


<?php
function exclui($camp, $grp) {

         $sql = sprintf("select descricao,ano from cad_campeonato where codigo = %d",$camp);

		     $result = mysql_query($sql)
	    		or die('\nErro consultando descricao do campeonato no banco de dados: ' . mysql_error()); 
         $row = mysql_fetch_assoc($result);
         $descricao = $row['descricao'];
         $ano = $row['ano'];

				 mysql_free_result($result);

         $sql = sprintf("delete from cad_grupo where campeonato = %d and grupo = '%s'",$camp, $grp);

	       $result = mysql_query($sql)
	    		or die('\nErro excluindo registro no banco de dados: ' . mysql_error()); 

         echo '<tr><td>Campeonato: '.$descricao.'-'.$ano.'</td></tr>'."\n";
         echo '<tr><td>Grupo: '.$grp.'</td></tr>'."\n";
         echo '<tr><td><br></td></tr>'."\n";
         echo '<tr><td><br></td></tr>'."\n";
		     echo "<tr><td>Excluído com sucesso !</td></tr>\n";
         echo '<tr><td><br></td></tr>'."\n";
         echo '<tr><td><br></td></tr>'."\n";
         echo '<tr><td><a href="lst_cadgrupo.php">OK</a></td></tr>'."\n";

}

function grava($camp, $grp, $times) {

         $sql = sprintf("select descricao,ano from cad_campeonato where codigo = %d",$camp);

		     $result = mysql_query($sql)
	    			or die('\nErro consultando descricao do campeonato no banco de dados: ' . mysql_error()); 
         $row = mysql_fetch_assoc($result);
         $descricao = $row['descricao'];
         $ano = $row['ano'];

				 mysql_free_result($result);

         $sql = sprintf("delete from cad_grupo where campeonato = %d and grupo = '%s'",$camp, $grp);

		     $result = mysql_query($sql)
	    		or die('\nErro eliminando registros anteriores do banco de dados: ' . mysql_error()); 

         for ($x=0;$x<count($times);$x++) {
               if (!empty($times[$x])) {
  			         			$sql = sprintf("insert into cad_grupo(campeonato, grupo, time)
                       	       values (%d, '%s',%d)",	$camp,$grp,$times[$x]);
   						 	     $result = mysql_query($sql)
			      				    		or die('\nErro inserindo registro no banco de dados: ' . mysql_error()); 
                    }
              }
           

          echo '<tr><td>Campeonato: '.$descricao.'-'.$ano.'</td></tr>'."\n";
  				 echo '<tr><td>Grupo: '.$grp.'</td></tr>'."\n";
	         echo '<tr><td><br></td></tr>'."\n";
      			echo '<tr><td><br></td></tr>'."\n";
	         echo "<tr><td>Gravado com sucesso !</td></tr>\n";
   			 	echo '<tr><td><br></td></tr>'."\n";
   				echo '<tr><td><br></td></tr>'."\n";
    				echo '<tr><td><a href="lst_cadgrupo.php">OK</a></td></tr>'."\n";
							
}

function valida($camp, $grp, $times) {

         $gravados = 0; 
         for ($x=0;$x<count($times);$x++) {
               if (!empty($times[$x])) {
					         $sql = sprintf("select count(*) qtde from cad_grupo where campeonato = %d and time = %d and grupo <> '%s'",$camp, $times[$x],$grp);

							     $result = mysql_query($sql)
										    		or die('\nErro verificando existência do time no banco de dados: ' . mysql_error()); 

                   $row = mysql_fetch_assoc($result);
                   if ($row['qtde'] == 0)
                         $gravados++;
                 }
           }

      return $gravados;

}


?>
