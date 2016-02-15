<?php include("sessao.php"); ?>

<?php include("head.php"); ?>

<?php include("vlogin.php"); ?>

 <span class="titusr">Alteração de Dados Cadastrais</span>
      
 <?php include("traco.php"); ?>

<?php

   $userid = trim($_SESSION['userid']);

   include ('conectadb.php');
     
   $sql = sprintf("select username,nome,email,cidade,estado,ddd,fone,dddcel,celular,flpublica,anopala,possuiopala,descricao from cad_usuario where userid = %d",$userid);
   $result = mysql_query($sql)
               or die ("Erro consultando usuário ".mysql_errono().','.mysql_error());

   $row = mysql_fetch_assoc($result);
   $username = $row['username'];
   $nome = $row['nome'];
   $email = $row['email'];
   $cidade = $row['cidade'];
   $estado = $row['estado'];
   $ddd = $row['ddd'];
   $fone = $row['fone'];
   $dddcel = $row['dddcel'];
   $celular = $row['celular'];
   $anopala = $row['anopala'];
   $possuiopala = $row['possuiopala'];
   $descricao = $row['descricao'];
   if ($row['flpublica'] == "S")
       $publica = "checked";
   else
       $publica = "";

   mysql_free_result($result);
   mysql_close($link);

?>     

 <form method="post" action="prc_altusuario.php" name="frm_altusuario">
  <table id="tabform"   border="0" cellspacing="0">
  
       <tr> 
          <td width="30%" style="font-weight:bold;">Senha atual: </td>
          <td width="70%"><input type="password" size="25" maxlength="20" tabindex="0" name="senhaatual"  value=''> </td>
       </tr>  
       <tr> 
          <td width="30%" style="font-weight:bold;">Nova Senha: </td>
          <td width="70%"><input type="password" size="25" maxlength="20" tabindex="0" name="novasenha"  value=''> </td>
       </tr>  
       <tr> 
          <td width="30%" style="font-weight:bold;">Confirme a Nova Senha: </td>
          <td width="70%"><input type="password" size="25" maxlength="20" tabindex="0" name="confsenha"  value=''> </td>
       </tr>  
       <tr> 
          <td colspan="2"><?php include ("traco.php");?> </td>
       </tr>  
       <tr> 
          <td width="30%" style="font-weight:bold;">Nome Completo: </td>
          <td width="70%"><input type="text" size="50" maxlength="40" tabindex="0" name="nomecompleto" value='<?php echo($nome);?>'> </td>
       </tr>  
       <tr> 
          <td width="30%" style="font-weight:bold;">E-mail: </td>
          <td width="70%"><input type="text" size="50" maxlength="90" tabindex="0" name="email" value="<?php echo($email);?>"> </td>
       </tr>  
       <tr> 
          <td width="30%" style="font-weight:bold;">Cidade: </td>
          <td width="70%"><input type="text" size="50" maxlength="40" tabindex="0" name="cidade" value="<?php echo($cidade);?>"> </td>
       </tr>  
       <tr> 
          <td width="30%" style="font-weight:bold;">Estado: </td>
          
          <td width="70%">
						<select name="estado">
						    <?php
						        $uf= array('','AC','AL','AM','AP','BA','CE','DF','ES','GO','MA','MG','MS','MT','PA','PB','PE',
                								'PI','PR','RJ','RN','RO','RR','RS','SC','SE','SP','TO');
                								
                    foreach ($uf as $vl) {
                              if ($vl == $estado)
                                  echo ("<option	value='".$vl."' selected>".$vl."</option>\n");
                              else
                                  echo ("<option	value='".$vl."'>".$vl."</option>\n");
                         }
						 
               ?>
						</select>
       </tr>
       <tr>
          <td width="30%">Telefone: </td>
          <td width="70%"><input type="text" size="4" maxlength="6" tabindex="0" name="DDD" value="<?php if($ddd<>0)echo($ddd);?>">
						<input type="text" size="10" maxlength="10" tabindex="0" name="fone" value="<?php if($fone<>0)echo($fone);?>">           
           </td>
       </tr>
       <tr>
          <td width="30%">Celular:</td>
          <td width="70%"><input type="text" size="4" maxlength="6" tabindex="0" name="DDDCEL" value="<?php if($dddcel<>0)echo($dddcel);?>">
																<input type="text" size="10" maxlength="10" tabindex="0" name="celular" value="<?php if($celular<>0)echo($celular);?>">           
          </td>
       </tr>
       <tr>
			<td width="30%">Possui um Opala ?</td>
            <td width="70%">
				<input <?php if($possuiopala == "S") echo('checked="checked"'); ?> tabindex="1" name="possui" value="SIM" type="radio">Sim
            	<input <?php if($possuiopala == "N") echo('checked="checked"'); ?> tabindex="2" name="possui" value="NAO" type="radio">Não
			</td>
       </tr>
       <tr>
          <td width="30%">Qual o Ano ? </td>
          <td width="70%">
				<select name="anopala">
    	  			<option	value='' selected></option>
			<?php
				 for ($x=1969;$x < 1993;$x++) {
				      if ($x == $anopala)
  					      echo ("<option value='".$x."' selected>".$x."</option>");
					  else
					      echo ("<option value='".$x."'>".$x."</option>");
			     }
			?>
				</select>
       </tr>
   	<tr> <td>Descreva Seu Opala</td> </tr> 
		<tr>
			<td colspan="2">
				<textarea tabindex="5" maxlength="1024" name="descricao" rows=10 cols=50><?php echo($descricao);?></textarea>
			</td>
	</tr>
    <tr> 
          <?php echo("<td colspan='2'><input type='checkbox' value='S' ".$publica." tabindex='0' name='publica'>Publicar dados pessoais</td>"); ?>
    </tr>
    <tr>  <td colspan="2"><?php include ("traco.php");?> </td> </tr>
     <tr>
       <td> <div style="float:left;"> <input tabindex="0" name="grava" value="Gravar" type="submit">  </div> </td>
       </tr>
  </table>
 </form>
<?php include ("rodape.php"); ?>
