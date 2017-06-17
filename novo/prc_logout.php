<?php include("sessao.php"); ?>
<?php 
       include ('conectadb.php');
       setcookie("LoginOpala",md5("LITTLEBOY-FORA".$_SESSION['userid'].trim($_SESSION['email'])),time()+60*60*24*360);


       $_SESSION['logado'] = "NAO";

       $sql = sprintf("delete from usr_online where sessao = '%s'",$_ID);
       $result = mysql_query($sql)
                   or die ("Erro registrando conexão ".mysql_errono().','.mysql_error());

       echo "<script> window.location = 'index.php'; </script>"; 

//       session_destroy();

       mysql_close($link);

?>
