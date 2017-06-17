<?php include("head.php"); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT']."/sessao.php");?> 
<?php require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.usuario_cpg.php"); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.album_cpg.php"); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.forum.php"); ?>

 <span class="titusr">Novo Membro do Clube</span>
      
 <?php include("traco.php"); ?>
	<table id="tabform" style="color:#FF0000"   border="0" cellspacing="0">
	<?php 

			$erroValida = 0;
			if ($_POST['registrar'] == 'Registrar') {
					if (ValidaForm() == 0) {
						return ;
						}
			}
			else {
					$_POST['publica'] = 'S';
					$_POST['recados'] = 'S';
					$_POST['aceite'] = 'S';
					$_POST['possui'] = 'SIM';
					}
	?>
	</table>
	   		<p class="titusr" style="font-weight: bold; font-size: 12px">Faça parte do nosso clube e ajude-nos a preservar a memória desse ícone da indústria automobilista brasileira. </p>
	   		<p class="titusr" style="font-size: 12px">Esse &eacute;  um pr&eacute;-cadastro. Para se tornar um sócio do Opala Clube de Franca  é necessário seguir os seguintes passos:
            <ul>
              <li class="titusr" style="font-size: 12px">Participar da primeira reuni&atilde;o para apresenta&ccedil;&atilde;o e avalia&ccedil;&atilde;o da diretoria e aos demais membros do clube. </li>
              <li class="titusr" style="font-size: 12px">Submeter seu opala ou caravan a avalia&ccedil;&atilde;o pela diretoria t&eacute;cnica. </li>
              <!-- <li class="titusr" style="font-size: 12px">Pagar taxa de inscri&ccedil;&atilde;o de R$ 50,00 (com o pagamento dessa taxa voc&ecirc; recebe uma camiseta e um adesivo do clube). </li>  -->
              <!-- <li class="titusr" style="font-size: 12px">Contribuir mensalmente com a taxa de R$ 20,00. </li> -->
              <li class="titusr" style="font-size: 12px">Frequentar as reuni&otilde;es regularmente. </li>
              <li class="titusr" style="font-size: 12px">Somente o associado ter&aacute; seu nome relacionado na lista de membros e acesso às áreas restritas do site. </li>
              <li class="titusr" style="font-size: 12px">Não cobramos taxa de inscrição e nem mensalidades. </li>
            </ul>

	   		<p class="titusr" style="font-size: 15px">Teremos imenso prazer em recebê-lo(a) em nossas reuniões que acontecem todos os sábados. Qualquer dúvida é só deixar sua mensagem no espaço do opaleiro que responderemos prontamente. </p>


  <table id="tabform"   border="0" cellspacing="0">
   <form method="post" action="frm_cadusuario.php" name="frmcadusuario">
       <tr> 
          <td width="30%" style="font-weight:bold;"> Usu&aacute;rio: </td>
          <td width="70%"><input type="text" size="20" maxlength="20" tabindex="100" name="username" value='<?php echo $_POST['username']; ?>'> </td>
       </tr>
       <tr>
          <td width="30%" style="font-weight:bold;">Senha: </td>
          <td width="70%"><input type="password" size="25" maxlength="20" tabindex="101" name="senha"  value='<?php echo $_POST['senha']; ?>'> </td>
       </tr>  
       <tr> 
          <td width="30%" style="font-weight:bold;">Confirme a Senha: </td>
          <td width="70%"><input type="password" size="25" maxlength="20" tabindex="102" name="confsenha"  value='<?php echo $_POST['confsenha']; ?>'> </td>
       </tr>  
       <tr> 
          <td colspan="2"><?php include ("traco.php");?> </td>
       </tr>  
       <tr> 
          <td width="30%" style="font-weight:bold;">Nome Completo: </td>
          <td width="70%"><input type="text" size="50" maxlength="40" tabindex="103" name="nomecompleto" value='<?php echo $_POST['nomecompleto']; ?>'> </td>
       </tr>  
       <tr> 
          <td width="30%" style="font-weight:bold;">E-mail: </td>
          <td width="70%"><input type="text" size="50" maxlength="90" tabindex="104" name="email" value='<?php echo $_POST['email']; ?>'> </td>
       </tr>
       <tr>
          <td width="30%" style="font-weight:bold;">Endereço: </td>
          <td width="70%"><input type="text" size="50" maxlength="40" tabindex="105" name="endereco" value='<?php echo $_POST['endereco']; ?>'> </td>
       </tr>
       <tr>
          <td width="30%" style="font-weight:bold;">Número: </td>
          <td width="70%"> <input type="text" size="4" maxlength="5" tabindex="106" name="numero" value='<?php echo $_POST['numero']; ?>'></td>
       </tr>
       <tr>
          <td width="30%" style="font-weight:bold;">Cidade: </td>
          <td width="70%"><input type="text" size="50" maxlength="40" tabindex="107" name="cidade" value='<?php echo $_POST['cidade']; ?>'> </td>
       </tr>  
       <tr> 
          <td width="30%" style="font-weight:bold;">Estado: </td>
          <td width="70%">
				<select name="estado" tabindex="108">
				<?php 
				    $estado = array('','AC','AL','AM','AP','BA','CE','DF','ES','GO','MA','MG','MS','MT','PA','PB','PE','PI','PR','RJ','RN','RO','RR','RS','SC','SE','SP','TO');
					
					foreach ($estado as $uf) {
						echo '<option value="'.$uf.'"';
						
						if ($uf == $_POST['estado'])
							echo ' selected';
							
					    echo '>'.$uf.'</option>'."\n";
						
						}
				?>
				  </select>       </tr>  
       <tr>
          <td width="30%">Cep: </td>
          <td width="70%"><input type="text" size="4" maxlength="5" tabindex="109" name="cep1" value='<?php echo $_POST['cep1']; ?>'>-<input type="text" size="2" maxlength="3" tabindex="110" name="cep2" value='<?php echo $_POST['cep2']; ?>'> </td>
       </tr>

       <tr> 
          <td width="30%">Telefone: </td>
          <td width="70%"><input type="text" size="4" maxlength="6" tabindex="111" name="DDD" value='<?php echo $_POST['DDD']; ?>'>
																<input type="text" size="10" maxlength="10" tabindex="112" name="fone" value='<?php echo $_POST['fone']; ?>'>           </td>
       </tr>  
       <tr> 
          <td width="30%">Celular:</td>
          <td width="70%"><input type="text" size="4" maxlength="6" tabindex="113" name="DDDCEL" value='<?php echo $_POST['DDDCEL']; ?>'>
						<input type="text" size="10" maxlength="10" tabindex="114" name="celular" value='<?php echo $_POST['celular']; ?>'></td>
        <tr>
        <tr>
			<td width="30%">Possui um Opala ?</td>
            <td width="70%">
				<input <?php if ($_POST['possui'] == "SIM") echo "checked"; ?> tabindex="115" name="possui" value="SIM" type="radio">Sim
            	<input <?php if ($_POST['possui'] == "NAO") echo "checked"; ?> tabindex="116" name="possui" value="NAO" type="radio">Não			</td>
        </tr> 
       <tr> 
          <td width="30%">Qual o Ano ? </td>
          <td width="70%">
				<select name="anopala" tabindex="117">
				<?php 
				    $anoopala = array('','1969','1970','1971','1972','1973','1974','1975','1976','1977','1978','1979','1980','1981','1982','1983','1984','1985','1986','1987','1988','1989','1990','1991','1992');
					
					foreach ($anoopala as $ano) {
						echo '<option value="'.$ano.'"';
						
						if ($ano == $_POST['anopala'])
							echo ' selected';
							
					    echo '>'.$ano.'</option>'."\n";
						
						}
				?>
			  </select>       </tr>  
		<tr> <td>Descreva seu Opala</td> </tr> 
		<tr>
		<td colspan="2">
		    <textarea tabindex="118" maxlength="1024" name="descricao" rows=10 cols=50><?php echo $_POST['descricao']; ?></textarea>	    </td>
		</tr>
       <tr> 
          <td colspan="2"><input type="checkbox" value="S"  <?php if ($_POST['publica'] == "S") echo "checked"; ?> tabindex="119" name="publica">Publicar dados pessoais</td>
       </tr>  
       <tr> 
          <td colspan="2"><input type="checkbox" value="S"  <?php if ($_POST['recados'] == "S") echo "checked"; ?> tabindex="120" name="recados">Desejo receber os recados por e-mail</td>
       </tr>  
       <tr> 
          <td colspan="2"><input type="checkbox" value="S"  <?php if ($_POST['aceite'] == "S") echo "checked"; ?> tabindex="121" name="aceite">Concordo com o estatuto e os termos de inscrição do clube</td>
       </tr>  
       <tr> 
          <td colspan="2"><?php include ("traco.php");?> </td>
       </tr>  

       <tr> 
         <td> <div style="float:left;"> <input tabindex="122" name="registrar" value="Registrar" type="submit">  </div> </td>
       </tr>  
  </table>
 </form>

<?php include ("rodape.php"); ?>
<?php 

function ValidaForm() {

	$regex = '^'.
				'[-a-z0-9!#$%&\'*+/=?^_<{|}~]+'.          // One or more underscore, alphanumeric, or allowed characters.
				'(\.[-a-zA-Z0-9!#$%&\'*+/=?^_<{|}~]+)*'.  // Followed by zero or more sets consisting of a period
                                         					// of one or more underscore, alphanumeric, or allowed characters.
				'@'.     		                              // Followed by an "at" character.
				'[a-z0-9-]+'.                             // Followed by one or more alphanumeric or hyphen characters.
				'(\.[a-z0-9-]{2,})+'.                     // Followed by one or more sets consisting a period of two
        					                                // or more alphanumeric or hyphen characters.
				'$';

   $cad= 'abcdefghijklmonpqrstuvxywzABCDEFGHIJKLMNOPQRSTUVXYWZ0123456789_-@%$#';
   $username = trim($_POST['username']);
   $senha = trim($_POST['senha']);
   $confsenha = trim($_POST['confsenha']);
   $nome = trim($_POST['nomecompleto']);
   $email = trim($_POST['email']);
   $endereco = trim($_POST['endereco']);
   $numero = trim($_POST['numero']);
   $cep1 = trim($_POST['cep1']);
   $cep2 = trim($_POST['cep2']);
   $cidade = trim($_POST['cidade']);
   $estado = trim($_POST['estado']);
   $ddd = trim($_POST['DDD']);
   $fone = trim($_POST['fone']);
   $dddcel = trim($_POST['DDDCEL']);
   $celular = trim($_POST['celular']);

   if (trim($_POST['possui']) == "SIM")
       $possui = "S";
   else
       $possui = "N";

   $anopala = trim($_POST['anopala']);
   $descricao = trim($_POST['descricao']);

   if (trim($_POST['publica']) == "S")
       $publica = "S";
   else
       $publica = "N";

   if (trim($_POST['recados']) == "S")
       $recmail = "S";
   else
       $recmail = "N";

   if (trim($_POST['aceite']) == "S")
       $aceite = "S";
   else
       $aceite = "N";

   $temerro = 0;   
   if (empty($username)) {
  		 echo ("<tr><td colspan=2>Usuário não informado </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   else
   if (strspn($username,$cad) != strlen($username)) {
  		 echo ("<tr><td colspan=2>Usuário Inválido, caracteres permitidos:A-Z 0-9 _-@%$#</td></tr>")."\n";
   	   $temerro = 1;
   	  }
   else
   if (strlen($username) < 3) {	  
  		 echo ("<tr><td colspan=2>Usuário deve conter no mínimo 3 digitos </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   else
   if (is_numeric($username)) {	  
  		 echo ("<tr><td colspan=2>Usuário deve conter letras </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   if (empty($senha)) {
  		 echo ("<tr><td colspan=2>Senha não informada </td></tr>")."\n";
   	   $temerro = 1;
   	  } 
   else
      if (strlen($senha) < 5) {	  
  		 echo ("<tr><td colspan=2>Senha deve conter no mínimo 5 digitos </td></tr>")."\n";
   	   $temerro = 1;
   	  }

   if ($senha <> $confsenha) {
  		 echo ("<tr><td colspan=2>Senha não confirmada  </td></tr>")."\n";
   	   $temerro = 1;
   	  } 
   if (empty($nome)) {
  		 echo ("<tr><td colspan=2>Nome completo não informado  </td></tr>")."\n";
   	   $temerro = 1;
   	  } 
   else	  
   if (strlen($nome) < 6) {	  
  		 echo ("<tr><td colspan=2>Nome completo deve conter no mínimo 6 digitos </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   else
   if (is_numeric($nome)) {	  
  		 echo ("<tr><td colspan=2>Nome completo deve conter letras </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   if (empty($email)) {
  		 echo ("<tr><td colspan=2>E-mail não informado  </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   else
	 if (!eregi($regex, $email)) {
  		 echo ("<tr><td colspan=2>E-mail invalido  </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   if (empty($cidade)) {
  		 echo ("<tr><td colspan=2>Cidade não informada  </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   else
   if (is_numeric($nome)) {
  		 echo ("<tr><td colspan=2>Nome completo deve conter letras </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   if (empty($estado)) {
  		 echo ("<tr><td colspan=2>Estado não informado  </td></tr>")."\n";
   	   $temerro = 1;
   	  }

   if (empty($endereco)) {
  		 echo ("<tr><td colspan=2>Endereço não informado  </td></tr>")."\n";
   	   $temerro = 1;
   	  }

   if (empty($numero)  && !is_numeric($numero)) {
  		 echo ("<tr><td colspan=2>Informe o número do endereço corretamente  </td></tr>")."\n";
   	   $temerro = 1;
   	  }

   if (!empty($ddd) && !is_numeric($ddd)) {
  		 echo ("<tr><td colspan=2>DDD inválido, informe somente números  </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   if (!empty($fone) && !is_numeric($fone)) {
  		 echo ("<tr><td colspan=2>Telefone inválido, informe somente números  </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   if (!empty($dddcel) && !is_numeric($dddcel)) {
  		 echo ("<tr><td colspan=2>DDD do Celular inválido, informe somente números  </td></tr>")."\n";
   	   $temerro = 1;
   	  }
   if (!empty($celular) && !is_numeric($celular)) {
  		 echo ("<tr><td colspan=2>Celular inválido, informe somente números  </td></tr>")."\n";
   	   $temerro = 1;
   	  }


   if ($possui == "S" && $anopala == 0)  {
  		 echo ("<tr><td colspan=2>Informe o ano do seu opala </td></tr>")."\n";
   	   $temerro = 1;
		}

   if ($possui == "S" && empty($descricao))  {
  		 echo ("<tr><td colspan=2>Descreva seu opala </td></tr>")."\n";
   	   $temerro = 1;
		}
   if ($aceite <> "S") {
  		 echo ("<tr><td colspan=2>Para efetuar o pré-cadastro é necessário que vc concorde com o estatudo e regras de inscrição. </td></tr>")."\n";
   	   $temerro = 1;
   	  }

   if (jaexiste($username, $email)) {
  		 echo ("<tr><td colspan=2>Nome de usuário já está em uso, tente outro usuário </td></tr>")."\n";
   	   $temerro = 1;
		}

   if ($temerro == 0) {
   	

   	/* 
   	 * Incluir o usuário na galeria de fotos coopermine
   	 */
   		$UsrCpg = new Usuario_CPG(0);

   	     $UsrCpg->setUserGroup(2);
   	     $UsrCpg->setUserActive("YES");
   	     $UsrCpg->setUserName($username);
   	     $UsrCpg->setPassWord(md5($senha));
   	     $UsrCpg->setUserGroupList(null);
   	     $UsrCpg->setUserEmail($email);
   	     $UsrCpg->setUserProfile1($cidade.'/'.$estado);
   	     $UsrCpg->setUserProfile2(null);
   	     $UsrCpg->setUserProfile3(null);
   	     $UsrCpg->setUserProfile4(null);
   	     $UsrCpg->setUserProfile5($descricao);
   	     $UsrCpg->setUserProfile6(null);
   	     $UsrCpg->setUserActKey(null);
   	        	        	        	     
   	     $UsrCpg->Grava();
   	     
   	     /*
   	      * Inclui o album do opaleiro na galeria
   	      */
   	     $AlbCpg = new Album_CPG(0);
   	     $AlbCpg->setTitle("Meu Opala");
   	     $AlbCpg->setDescription("Fotos do Opala de: ".$username);
   	     $AlbCpg->setCategory($UsrCpg->getUserID() + 10000);
   	     $AlbCpg->setPos('100');
		 $AlbCpg->Grava();
   	     
   	     $AlbCpg2 = new Album_CPG(0);
   	     $AlbCpg2->setTitle("Outras Fotos");
   	     $AlbCpg2->setDescription("Imagens diversas de: ".$username);
   	     $AlbCpg2->setCategory($UsrCpg->getUserID() + 10000);
   	     $AlbCpg2->setPos('101');
		 $AlbCpg2->Grava();
		 
	/* 
   	 * Incluir o usuário no smfforum 
   	 */
   		$Forum = new Forum(0);
		$Forum->setMemberName($username);
		$Forum->setPassWD($senha);
		$Forum->setEmailAddress($email);
		$Forum->setLocation($cidade.'/'.$estado);
   	    $Forum->Grava();

         $insere = sprintf("insert into cad_usuario(username,senha,nome,email,cidade,estado,ddd,fone,dddcel,celular,flpublica,nivel,dtcadastro,possuiopala,descricao,anopala,recmail,endereco,numero,cep,idcpg,idalbumcpg,idforum)
                     values ('%s', '%s','%s','%s','%s','%s',%d,%d,%d,%d,'%s','0','%s','%s','%s',%d,'%s','%s','%d','%d','%d','%d','%d')",
			        $username,md5($senha),$nome,$email,$cidade,$estado,$ddd,$fone,$dddcel,$celular,$publica,date("Y-m-d H-i-s"),$possui,$descricao,$anopala,$recmail,$endereco,$numero,($cep1 * 1000 + $cep2),$UsrCpg->getUserID(),$AlbCpg->getAlbumID(),$Forum->getID_Member());

         inclui($insere);
   	     enviaemail($username, $email,0);
		 echo "<tr><td><table id='tabform' border='0' cellspacing='0' style='color:blue;'>";
         echo "<tr><td>Seu pré-cadastro foi realizado com sucesso !</td></tr>\n";
         echo "<tr><td>Seu cadastro já foi realizado também na galeria fotos e forum, envie fotos do seu opala para o Album Meu Opala !</td></tr>\n";
         echo '<tr><td><br></td></tr>'."\n";

		 echo "<tr><td>Na barra esquerda do site você se informa da data e local das reuniões para que possa iniciar sua participação no clube. Caso tenha alguma dúvida entre em contato pelo fale conosco ou pelo e-mail admin@opalaclubefranca.com.br.</td></tr>\n";
         echo '<tr><td><br></td></tr>'."\n";
		 
         echo '<tr><td><br></td></tr>'."\n";
				 echo "<tr><td>Obrigado !!!</td></tr>\n";
         echo '<tr><td><br></td></tr>'."\n";
         echo '<tr><td><a href="index.php">OK</a></td></tr>'."\n";
		 echo '</table></td></tr></table>';
		 include ("rodape.php");
      }
   return $temerro;
}	  

function jaexiste($username, $email) {

       include 'conectadb.php';
     
       $consulta = sprintf("select username,email from cad_usuario where username = '%s'",$username);
       $result = mysql_query($consulta);
       
       if (mysql_num_rows($result) == 0)
           $jc = false;
       else
           $jc = true;
           
       mysql_close($link);

   	   return $jc;
	
}
   
function inclui($insere) {

         include 'conectadb.php';

	 $result = mysql_query($insere)
	 		or die('\nErro inserindo registro no banco de dados: ' . mysql_error()); 

	       mysql_close($link);


}
	function enviaemail($username, $email, $funcao) {

	include('envmail.php');

         include ('conectadb.php');

         $consulta = sprintf("select userid from cad_usuario where username = '%s'",$username);

         $result = mysql_query($consulta)
                   or die ("Erro enviando e-mail ".mysql_errono().','.mysql_error());
                   
       if (mysql_num_rows($result) == 0)
           $userid = 999999;
       else {
             $row = mysql_fetch_assoc($result);
             $userid = $row['userid'];
            }

   if ($funcao == 1)
       $reenvia = "Reenvio";
   else
       $reenvia = " ";
       
   $subject = "Confirmação de dados Opala Clube Franca";
   $msg = "Você está recebendo esse e-mail para confirmação do seu e-mail no Opala Clube de Franca, após essa confirmação seu pré-cadastro será confirmado."
        ."<br><br><a href=http://".$_SERVER['HTTP_HOST']."/prc_confusr.php?usr=".trim($userid)."&id=".trim(md5($username)).trim(md5($email)).">Clique aquí para confirmar o e-mail</a>"
        ."<br><br>Usuário: ".$username."<br>E-mail: ".$email
        ."<br><br><br>Opala Clube Franca<br>www.opalaclubefranca.com.br";

 
   $consulta = sprintf("select emailadm from cad_param");

   $result = mysql_query($consulta)
                   or die ("Erro enviando e-mail ".mysql_errono().','.mysql_error());

   $row = mysql_fetch_assoc($result);

   $from = $row['emailadm'];

   envmail($email,$subject,$msg,$from);
          
   mysql_close($link);
}

?>
