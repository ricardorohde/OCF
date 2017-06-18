<div class="painel">
<div class="LeftCorner"> </div>
<div class="TitPainel">.:: Membros ::.</div>
<div class="RightCorner"> </div>
<div class="corpo"> 
 <?php
	   include 'conectadb.php';

     echo ("<span style='font-weight:bold;text-decoration:none;'>On-line agora:</span><br/>\n");
     
     $sql = "select cad.username from cad_usuario cad,usr_online usr where cad.userid = usr.userid order by cad.username";
     $result = mysqli_query($link,$sql)
								or die('\nErro verificando usu�rios ' . mysqli_error()); 
     $conta = 0;
     while ($row = mysqli_fetch_assoc($result)) {
           $conta+=1;
           $lin = sprintf("%02d: %s",$conta,$row['username']);
           echo ($lin)."\n";
           if ($conta == 50)
                break;
					}

     echo ("<span style='font-weight:bold;text-decoration:none;'><br/><br/>Acessos no dia:</span><br/>\n");

     $sql = "select u.userid,ifnull(u.username,'Outros') username,count(*) qtde
						from
						log_usuario l
						left join
						cad_usuario u
						on
						u.userid = l.userid
						where
						l.datahora > curdate()
						and substr(ip,1,locate('.',ip)-1) >= 100
						group by
						u.userid,u.username
						order by qtde desc";

     $result = mysqli_query($link,$sql)
								or die('\nErro verificando usu�rios ' . mysqli_error()); 

     while ($row = mysqli_fetch_assoc($result)) {
           $lin = sprintf("%s: %3d",$row['username'],$row['qtde']);
           echo ($lin)."\n";
			}

     mysqli_free_result($result);

     echo ("<span style='font-weight:bold;text-decoration:none;'><br/><br/>Localidades:</span><br/>\n");

     $sql = "select distinct ifnull(l.cidade,'Outros') local
						from
						log_usuario l
						where
						l.datahora > curdate()
						and substr(ip,1,locate('.',ip)-1) >= 100
                        and l.cidade is not null
                        and l.pais = 'Brazil'
						order by l.cidade";

     $result = mysqli_query($link,$sql)
								or die('\nErro verificando usu�rios ' . mysqli_error()); 

     while ($row = mysqli_fetch_assoc($result)) {
           $lin = sprintf("%s",$row['local']);
           echo ($lin)."<br/>\n";
			}

     mysqli_close($link);

   ?>
   <br>
</div>
</div>