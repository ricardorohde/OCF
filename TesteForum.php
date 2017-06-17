<?php require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.forum.php"); ?>
<?php 

   	/* 
   	 * Incluir o usuário na galeria de fotos coopermine
   	 */
 		$Forum = new Forum(0);

		$Forum->setMemberName("alencar8");
		$Forum->setPassWD("racnela");
		$Forum->setEmailAddress("alencar8@magazineluiza.com.br");
		$Forum->setLocation("Franca/SP");
  	        	        	        	     
 	     $Forum->Grava();

?>
