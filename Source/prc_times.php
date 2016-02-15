	      <?php
	         $camp = $_GET['camp'];
	         $lst = $_GET['lst'];
	         $grp = trim($_GET['grp']);

           if ($lst == 1) {
              echo ('<select name="lstd[]" size=9 multiple   width=200 style="width:200px">')."\n";
		          include ('conectadb.php');
	         		$sql = sprintf("Select t.codigo codigo,nome from cad_times t,cad_campeonato c where c.codigo = %d and t.tipo = c.tipo
										and t.codigo not in (select time from cad_grupo where campeonato = %d)
										order by nome",$camp,$camp);
					 		$result = mysql_query($sql)
											   or die('\nErro consultando banco de dados: ' . mysql_error());
		 			 		while ($row = mysql_fetch_assoc($result)) {
        	         		echo ('<option value="'.$row['codigo'].'">'.$row['nome'].'</option>')."\n";
									}
    	     		mysql_free_result($result);
   				 		mysql_close($link);
   				 	}
   				else
   				if ($lst == 2) {
              echo ('<select name="lsts[]" size=9 multiple   width=200 style="width:200px">')."\n";
		          include ('conectadb.php');
	         		$sql = sprintf("Select t.codigo codigo,nome
											from cad_times t,cad_grupo g
											where g.campeonato = %d and g.grupo = '%s'
											and t.codigo = g.time
											order by nome",$camp,$grp);
					 		$result = mysql_query($sql)
											   or die('\nErro consultando banco de dados: ' . mysql_error()); 
		 			 		while ($row = mysql_fetch_assoc($result)) {
        	         		echo ('<option value="'.$row['codigo'].'">'.$row['nome'].'</option>')."\n";
									}
    	     		mysql_free_result($result);
   				 		mysql_close($link);
						}   					  
        	?>

	</select> 
