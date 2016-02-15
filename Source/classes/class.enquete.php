<?php include($_SERVER['DOCUMENT_ROOT']."/sessao.php"); ?>
<?php
require_once($_SESSION['DOCROOT']."/classes/class.bd.php");
////////////////////////////////////////////////////
// Campeonatos - classe Campeonato
//
// Classe para tratamento dos Campeonatos
//
////////////////////////////////////////////////////

/**
 * Campeonato - Classe do cadastro de Campeonato
 * @package Campeonato
 
 * @author Alencar Mendes de Oliveira
 */
class Enquete
{
    /////////////////////////////////////////////////
    // Variáveis Públicas
    /////////////////////////////////////////////////

    var $Codigo           = 0;
    var $Pergunta         = "";
    var $DataInicio       = "0000/00/00";
    var $DataFim          = "0000/00/00";
    var $TipoResposta     = "U";
    var $Restrita         = "N";
    var $Existe           = 'N';
    var $Opcoes           = array();
    /**#@-*/
    

    /**
     * Construtor 
     * @param int $userid
     * @return void
     */
 function Enquete($codigo) {
   
   $db = new BD();
   
   $sql = sprintf("select
			   numero,
			   pergunta,
			   datainicio,
			   datafim,
			   tiporesposta,
			   restrita			   
			   from
               cad_enquete
               where numero= %d",$codigo);

    $db->Query($sql);
	
	if ($db->NumRows() == 0) 
		$this->Existe = 'N';
    else {
		    $this->Existe = 'S';
			$db->Next();
			$this->Codigo           = $codigo;
			$this->Pergunta         = $db->getValue('pergunta');
			$this->DataInicio       = $db->getValue('datainicio');
			$this->DataFim          = $db->getValue('datafim');
			$this->TipoResposta     = $db->getValue('tiporesposta');
			$this->Restrita         = $db->getValue('restrita');
            $this->CarregaOpcoes();
		}
    $db->Close();

    }

	/************************************************************************************
	 ** Funções GET                                                                    **
	 ***********************************************************************************/
	function getCodigo() { //Retorna o codigo da enquete
			return $this->Codigo;
	}
	function getPergunta() {	//Retorna a pergunta da enquete
			return $this->Pergunta;
	}
	function getDataInicio() {	//Retorna a DataInicio da enquete
			return strtotime($this->DataInicio);
	}
	function getDataFim() {	//Retorna a DataFim da enquete
			return strtotime($this->DataFim);
	}
	function getTipoResposta() {	//Retorna o Tipo de Resposta da enquete
			return $this->TipoResposta;
	}
	function getRestrita() {	//Retorna se a enquete é restrita a socios
			return $this->Restrita;
	}
	function getOpcao($op) {	//Retorna a descricao da opção
			return $this->Opcoes[$op-1];
	}


	/************************************************************************************
	 ** Funções SET                                                                    **
	 ***********************************************************************************/
	function setPergunta($var) {	//Altera o valor do atributo pergunta
			$this->Pergunta = $var;
	}
	function setDataInicio($var) {	//Altera o valor do atributo DataInicio
			$this->DataInicio = $var;
	}

	function setDataFim($var) {	//Altera o valor do atributo DataFim
			$this->DataFim = $var;
	}
	function setTipoResposta($var) {	//Altera o tipo de resposta
			$this->TipoResposta = $var;
	}
	function setRestrita($var) {	//Altera o tipo de restrição
			$this->Restrita = $var;
	}
	function setOpcao($op,$var) {	//Altera o valor das opções da enquete
            $this->Opcoes[$op-1] = $var; 
	}


	function CarregaOpcoes() { //Retorna as opções da enquete

		   $db = new BD();
		   
		   $sql = sprintf("select
					   opcao,
					   texto
					   from
					   cad_enquete_opcoes
					   where 
					   numero = %d
   					   order by opcao"
					   ,$this->getCodigo());

			$db->Query($sql);

			while ($db->Next()) {
					$this->Opcoes[$db->getValue('opcao') - 1] = $db->getValue('texto');
			}
			$db->Close();

	}

 function Grava() { //Grava as informações da enquete

           if ($this->Existe == 'N')
		       $this->Inclui();
		   else
		       $this->Altera();

	}

 function Inclui() { //Insere nova enquete

		   $x = 0;

		   $db = new BD();
		   
		   $sql = sprintf("insert into cad_enquete
		   				  (pergunta,datainicio,datafim,tiporesposta,restrita)
						  values ('%s',curdate(),'%s','%s','%s')",
						   $this->getPergunta(),
						   date("Y/m/d",$this->getDataFim()),
						   $this->getTipoResposta(),
						   $this->getRestrita());
		
    		$db->Exec($sql);

            $this->Codigo = $db->getInsertID();

			$db->Close();

            $this->IncluiOpcoes();

	}


 function Altera() { //Altera a enquete

		   $db = new BD();

		   $sql = sprintf("update cad_enquete
		                   set pergunta = '%s',
						       datainicio = '%s',
							   datafim = '%s',
							   tiporesposta = '%s',
							   restrita = '%s'
							   where 
							   numero = %d",
							$this->getPergunta(),
							date("Y/m/d",$this->getDataInicio()),
							date("Y/m/d",$this->getDataFim()),
							$this->getTipoResposta(),
							$this->getRestrita(),
							$this->getCodigo());

     		$db->Exec($sql);

			$db->Close();

            $this->IncluiOpcoes();

	}

 function IncluiOpcoes() {

           $this->ExcluiOpcoes();

		   $db = new BD();

 		// Insere as opções
		   $x = 0;
           for ($x =0;$x < count($this->Opcoes);$x++) {
		
                    if (trim($this->Opcoes[$x]) == NULL )
						continue;

		            $sql = sprintf("insert into cad_enquete_opcoes 
					                (numero,opcao,texto)
									values (%d,%d,'%s')",
									$this->getCodigo(),
									($x + 1),
									$this->getOpcao(($x+1)));

		    		$db->Exec($sql);
					}

			$db->Close();

}

 function Exclui() { //Exclui a enquete

           if ($this->Existe == 'N')
		       return;

           $this->ExcluiOpcoes();

		   $db = new BD();
		   
		   $sql = sprintf("delete from cad_enquete where numero = %d"
					   ,$this->getCodigo());
		
     		$db->Exec($sql);
			
			$db->Close();

	}

 function ExcluiOpcoes() { //Exclui as opções da enquete

		   $db = new BD();
		   
		   $sql = sprintf("delete from cad_enquete_opcoes where numero = %d"
					   ,$this->getCodigo());
		
     		$db->Exec($sql);

			$db->Close();

	}

 function getEnquetes($Filtro) { // Retorna as enquetes cadastradas

           $wh = "";
		   
		   if ($Filtro == "A")
               $wh = " where date_add(now(),interval 1 hour) between datainicio and datafim";
		   else
		       $wh = "";

           $enq = array();
		   
		   $db = new BD();
		   
		   $sql = sprintf("select
					   numero,
					   pergunta,
					   datainicio,
					   datafim,
					   tiporesposta,
					   restrita
					   from
					   cad_enquete %s",$wh);
		
			$db->Query($sql);
			
			while($db->Next()) {
					array_push($enq,$db->Row);
				}	

			$db->Close();

			return $enq;

	}

 function ValidaVoto() { //Verifica se o usuário já votou

	  $ck = md5(sprintf ("enqbolao_%06d",$this->getCodigo()));   
	  $tipo = "C";
	  $jv = TRUE;
	  
       if ($_SESSION['userid'] <> 0) {

			   $db = new BD();

			   $sql = sprintf("select count(*) votos from cad_enquete_votos
							  where numero = %d and userid = %d"
						   ,$this->getCodigo(),$_SESSION['userid']);
		
			   $db->Query($sql);
		
			   $db->Next();
		
			   if ($db->getValue('votos') > 0)
                   $jv = FALSE;

			   $db->Close();

 			}
      else
      if (isset($_COOKIE[$ck]))  {
          $jv = FALSE;
		  }
      else {
			  setcookie($ck,"TRUE",time()+60*60*24*60); 
//		      if (isset($_COOKIE[$ck]))
			      $tipo = "C";
/*		      else
			  	  $tipo = "I"; */
			}

       if ($tipo == "I") {

			   $db = new BD();
			   
			   $sql = sprintf("select count(*) votos from cad_enquete_votos
							  where numero = %d and ip = '%s'"
						   ,$this->getCodigo(),$_SERVER['REMOTE_ADDR']);
		
			   $db->Query($sql);
		
			   $db->Next();
		
			   if ($db->getValue('votos') > 0)
                   $jv = FALSE;
			   else
			       $jv = TRUE; 

			   $db->Close();

 			}

     return $jv;


	}

 function RegistraVoto($opc) { //Registra o voto na opção informada

	   $db = new BD();

	   $sql = sprintf("insert into cad_enquete_votos
	                    (numero,opcao,ip,datahora,userid)
						values (%d,%d,'%s',date_add(now(),interval 1 hour),%d)"
					   ,$this->getCodigo(),$opc,$_SERVER['REMOTE_ADDR'],$_SESSION['userid']);

	   $db->Exec($sql);

	   $db->Close();
		
	}

 function getVotos($op) { // Retorna os votos de cada opção

           $res = array();

	       $Votos = 0;

		   $db = new BD();
		   
           if (strtoupper($op) =="TOTAL")
			   $sql = sprintf("select
					   count(*) votos
					   from
					   cad_enquete_votos where
					   numero = %d"
					   ,$this->getCodigo());
		   else
			   $sql = sprintf("select
					   count(*) votos
					   from
					   cad_enquete_votos where
					   numero = %d and opcao = %d"
					   ,$this->getCodigo(),$op);
		
			$db->Query($sql);
			
			$db->Next();

            $Votos = $db->getValue('votos');
			$db->Close();

			return $Votos;

	}

}

	?>