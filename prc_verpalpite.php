<?php 
	   session_cache_limiter('nocache');
	   session_start();
	
       include('envmail.php');


	   require_once ("prc_execsql.php");
	   
	   $consulta = sprintf("select emailadm from cad_param");

   	   $result = execsql($consulta);

       $row = mysql_fetch_assoc($result);

       $from = $row['emailadm'];

       $sql = sprintf(
           "select username,email,r.rodada,descricao,p.campeonato,datahora,ano
				from
				cad_inscricao i,
				cad_usuario u,
				cad_campeonato c,
				(select distinct campeonato,rodada,min(addtime(data,subtime(hora,'00:15:00'))) datahora   /* identifica a rodada das proximas 24 horas */
				from cad_rodada
				group by campeonato,rodada
				having timediff(addtime(date_add(now(),interval 1 hour),'24:00:00'),datahora) > 0
				and datahora > date_add(now(),interval 1 hour)) r
				left join
				cad_palpite p
				on
				 p.campeonato = r.campeonato
				and p.rodada = r.rodada
				and p.userid = i.userid
				where
				i.userid = u.userid
				and i.campeonato = c.codigo
				and i.campeonato = r.campeonato
				and c.flandamento = 'S'
				having p.campeonato is null
				order by username");
       $result = execsql($consulta);

       $subject = "Registre seu palpite !!!";
       while ($row = mysql_fetch_assoc($result)) {
			   $msg = $row['username'].", você ainda não registrou seu palpite para a rodada "
			   .$row['rodada']." do ".$row['descricao']."-".$row['ano']
			   ." lembre-se que você tem até as "
			   .date("H:i",strtotime($row['datahora']))." do dia "
			   .date("d/m/Y",strtotime($row['datahora']))
			   ." para fazer o registro. "
   	           ."<br><br><br>http://bolao.sytes.net";
		       envmail($row['email'],$subject,$msg,$from);
       }				

       mysql_free_result($result);
       mysql_close($link);

?>
