<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.bdcpg.php");
?>

<?php

////////////////////////////////////////////////////
// Album CPG - classe Album_cpg
//
// Classe para tratamento dos albuns na galeria de fotos coopermine
//
////////////////////////////////////////////////////

/**
 * Album_cpg - Classe do cadastro de albuns na galeria de fotos coopermine
 * @package Album_cpg
 * @author Alencar Mendes de Oliveira
 */
class Album_CPG
{
    /////////////////////////////////////////////////
    // Variáveis Públicas
    /////////////////////////////////////////////////

    private $AlbumID	      = 0; 
    private $Title			  = 0; 
    private $Description 	  = 0; 
    private $Category	      = "";
    private $Pos			  = 0;
    private $Existe           = "N";    
    private $db_cpg;
    /**#@-*/
    

    /**
     * Construtor 
     * @param int $albumid
     * @return void
     */
 function Album_CPG ($albumid) {
   
   $this->db_cpg = new BDCPG();
     
   $sql = sprintf("select
  			         aid
				    ,title
				    ,description
				    ,category
				    ,pos
			   from cpg14x_albums
               where aid = %d",$albumid);

    $this->db_cpg->Query($sql);
	
 	if ( $this->db_cpg->NumRows() == 0) 
		$this->Existe = 'N';
    else {
		    $this->Existe = 'S';
			$this->db_cpg->Next();
			$this->setAlbumID($albumid);
			$this->setTitle($this->db_cpg->getValue('title'));
			$this->setDescription($this->db_cpg->getValue('description'));
			$this->setCategory($this->db_cpg->getValue('category'));
			$this->setPos($this->db_cpg->getValue('pos'));
    }
    
    }

	function getAlbumID()		    {	return $this->AlbumID;		}
	function getTitle()				{	return $this->Title;	}
	function getDescription()	  	{	return $this->Description;	}
	function getCategory()	   		{	return $this->Category;		}
	function getPos()	   			{	return $this->Pos;		}
	function Existe()				{	return $this->Existe;	}
	
	function setAlbumID($var)		    {	 $this->AlbumID = $var;		}
	function setTitle($var)				{	 $this->Title = $var;	}
	function setDescription($var)	  	{	 $this->Description = $var;	}
	function setCategory($var)	   		{	 $this->Category = $var;		}
	function setPos($var)	   			{	 $this->Pos = $var;		}
	
	
function Grava() { //Grava as informações da reuniao

           if ($this->Existe == 'N')
		       $this->Inclui();
		   else
		       $this->Altera();

	}

 private function Inclui() { //Insere novo album

		   $x = 0;

		   $sql = sprintf("insert into cpg14x_albums
		   				  (title
				    	 	,description
				    		,category
				    		,pos )
						  values ('%s','%s','%s',%d)",
								 $this->getTitle(),
								 $this->getDescription(),
								 $this->getCategory(),
								 $this->getPos()
								 );

    		$this->db_cpg->Exec($sql);

            $this->setAlbumID($this->db_cpg->getInsertID());


	}


 private function Altera() { //Altera a reunião

		   $sql = sprintf("update cpg14x_albums
		                   set title = '%s'
		   				  	,description = '%s'
				    	 	,category = '%s'
				    	 	,pos = %d
				    	 	where 
							   aid = %d",
								 $this->getTitle(),
								 $this->getDescription(),
								 $this->getCategory(),
								 $this->getPos());

     		$this->db_cpg->Exec($sql);


	}

 function Exclui() { //Exclui a reuniao

           if ($this->Existe == 'N')
		       return;

		   $sql = sprintf("delete from cpg14x_albums where aid = %d"
					   ,$this->getAlbumID());
		
     		$this->db_cpg->Exec($sql);
			
	}


function __destruct(){

	$this->db_cpg->Close();
}
	
}
?>