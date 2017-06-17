            <?php
                 include ('conectadb.php');
							   $sql = sprintf("Select codigo,nome from cad_times where tipo = 'C' order by nome");
							   $result = mysql_query($sql)
													or die('\nErro consultando banco de dados: ' . mysql_error()); 
							   while ($row = mysql_fetch_assoc($result)) {
                         echo ('			<option value="'.$row['codigo'].'">'.$row['nome'].'</option>')."\n";
											}
							   mysql_free_result($result);
   							 mysql_close($link);
           ?>
