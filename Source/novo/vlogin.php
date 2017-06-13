<?php include("sessao.php"); ?>

<?php
      if ($_SESSION['logado'] <> "SIM") {
 					 echo "<script language='JavaScript'> window.location = 'msg_login.php'; </script>"; 
      	  }
?>