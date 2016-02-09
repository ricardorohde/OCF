<?php
	function enviaemail($username, $email, $funcao) {

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

       mysql_free_result($result);

   if ($funcao == 1)
       $reenvia = "Reenvio";
   else
       $reenvia = " ";
       
   $subject = "Confirmaчуo de cadastro no Bolao.net";
   $msg = "\tVocъ estс recebendo esse e-mail para confirmaчуo do seu cadastro no Bolao.net, apѓs essa confirmaчуo vocъ terс acesso р todo conteњdo do site podendo tambщm participar dos campeonatos.".
        "\n\n\tPara confirmar seu cadastro basta clicar no link abaixo.\n\n"
        ."http://".$_SERVER['HTTP_HOST']."/prc_confusr.php?usr=".trim($userid)
        ."\n\n".$reenvia
        ."&id=".trim(md5($username)).trim(md5($email))
        ."\n\nUsuсrio: ".$username."\nE-mail: ".$email
        ."\n\n\nBolao.net";

   mysql_free_result($result);

   $consulta = sprintf("select emailadm from cad_param");

   $result = mysql_query($consulta)
                   or die ("Erro enviando e-mail ".mysql_errono().','.mysql_error());

   $row = mysql_fetch_assoc($result);
          
   mail($email,$subject,$msg,"From:".$row['emailadm']);

   mysql_free_result($result);
   mysql_close($link);

}

?>