<?php require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.album_cpg.php"); ?>
	<?php 

   	     $AlbCpg = new Album_CPG(0);
    
   	     $AlbCpg->setTitle("Album do Alencar");
   	     $AlbCpg->setDescription("Imagens do Opala do Alencar");
   	     $AlbCpg->setCategory('10002');
   	     $AlbCpg->setPos('100');
   	     
   	      echo ('\n'. $AlbCpg->getAlbumID());
   	      echo ('\n'. $AlbCpg->getTitle());
   	      echo ('\n'. $AlbCpg->getDescription());
   	      echo ('\n'. $AlbCpg->getCategory());
   	      
   	     $AlbCpg->Grava();
?>   	     