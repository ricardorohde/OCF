<?php include("sessao.php"); ?>

    <div id="round">
				<span class="ltop">
						<span class="l1"></span>
						<span class="l2"></span>
		  			<span class="l3"></span>
					  <span class="l4"></span>
				</span>

  <table class="claroda" bordercolor="#ffffff" border="1px" style="color:rgb(0,0,82);font-size:8px;" cellspacing=0 frame="box" rules="all">

  <?php
      require_once($_SESSION['DOCROOT']."/classes/class.bd.php");
      require_once($_SESSION['DOCROOT']."/classes/class.usuario.php");
      require_once($_SESSION['DOCROOT']."/classes/class.inscricao.php");

      $db = new BD();

      $sql = sprintf("select r2.campeonato campeonato from
						(select max(subtime(addtime(data, hora),'06:00:00')) datarod
								from cad_rodada r,
								cad_campeonato c
								where date_add(now(),interval 1 hour)  > subtime(addtime(data, hora),'06:00:00')
								and c.codigo = r.campeonato
								and c.`flandamento` = 'S'
								having date_add(now(),interval 1 hour) > datarod) r,
						(select campeonato,max(subtime(addtime(data, hora),'06:00:00')) datarod
								from cad_rodada r,
								cad_campeonato c
								where date_add(now(),interval 1 hour) > subtime(addtime(data, hora),'06:00:00')
								and c.codigo = r.campeonato
								and c.`flandamento` = 'S'
								group by r.campeonato
								having date_add(now(),interval 1 hour) > datarod) r2
						where r.datarod = r2.datarod");

   $db->Query($sql);
   $db->Next();

   $camp = $db->getValue('campeonato');
   $db->Close();
   
   $db = new BD();

       $sql = sprintf("select ifnull(cr.posicao,0) posicao,username,ifnull(cr.pontos,0) pontos,ra.rodadatual,ifnull(cr.posefetiva,0) posefetiva,i.campeonato,i.userid,c.descricao
						from
						cad_inscricao i,
						cad_usuario u,
						cad_campeonato c,
						(select campeonato,rodada,userid from cad_palpite
						  group by campeonato,rodada,userid) p,
						(select campeonato,max(rodada) rodadatual from
						(select campeonato,rodada,min(addtime(data, hora)) dataini
						from cad_rodada
						group by campeonato,rodada
						having date_add(now(),interval 1 hour) > subtime(dataini,'00:15:00')) r
						group by campeonato) ra
						left join
						cad_claroda cr
							on
						ra.campeonato = cr.campeonato
						and ra.rodadatual = cr.rodada
						and cr.userid = i.userid
								where
						i.userid = u.userid
						and i.campeonato = ra.campeonato
						and i.campeonato = p.campeonato
						and ra.rodadatual = p.rodada
						and ra.campeonato = p.campeonato
						and i.userid = p.userid
						and i.campeonato = c.codigo
						and c.flandamento = 'S'
						and cr.posefetiva <>0
						and c.codigo = %d
						order by posefetiva,username",$camp);

 	$db->Query($sql);


     $vez =0;
     $posant = 0;

     while ($db->Next()) {
            if ($vez == 0) { 
			    echo ("<tr style='background:rgb(250, 252, 188);color:rgb(0, 102, 0);font-size:10px;'><td colspan=3>".$db->getValue('descricao')."</td></tr>"); 
                $ln = sprintf("       <tr style='background:rgb(250, 252, 188);color:rgb(0, 102, 0);font-size:10px;'><td  colspan=3><span>Classificação Rodada:<b>%02d</span></td></tr>",$db->getValue('rodadatual'));
				echo ($ln);            	
                echo ("<tr style='background:rgb(0, 102, 0);color:#ffffff'><td>Pos</td><td>Participante</td><td>Pts</td></tr>");               
            	$vez = 1;
            }

		   $usr = new Usuario($db->getValue('userid'));
		   $ins = new Inscricao($db->getValue('campeonato'),$db->getValue('userid'));

           if ($posant != $db->getValue('posicao')) {
               $pos = $db->getValue('posefetiva'); 
               $posant = $db->getValue('posicao'); 
           }
		   else
               $pos = " "; 

/*           if ($row['posicao'] <= 5)
			   $st = 'style="background:rgb(255, 194, 133);font-size:11px;"';           
           else*/
			   $st = 'class="dettab"';           

           $lin = sprintf("<tr %s><td align=center>%s</td><td>%s</td><td align=center>%s</td></tr>",$st,$pos,$usr->getLinkUsuario(),$ins->getLinkPontosParam($db->getValue('pontos')),$usr->getUserid(),$db->getValue('pontos'));
		   
           echo ($lin)."\n";
		}

     $db->Close();
   ?>
  </table>

		<span class="lbottom">
			<span class="l4"></span>
			<span class="l3"></span>
			<span class="l2"></span>
			<span class="l1"></span>
		</span>
	</div>
