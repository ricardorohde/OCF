<?php include("sessao.php"); ?>
<?php
require_once($_SESSION['DOCROOT']."/classes/class.bdsms.php");
require_once($_SESSION['DOCROOT']."/classes/class.smssend.php");
require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.reuniao.php");
require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.usuario.php");

////////////////////////////////////////////////////
//
// SMS - Classe para tratamento de mensagens sms utilizando o smslib via interface de banco de dados
//
////////////////////////////////////////////////////

/**
 * SMS - Classe para tratamento de mensagens sms
 * @package SMS
 * @author Alencar Mendes de Oliveira
 */
class SMS
{
    /////////////////////////////////////////////////
    // Variáveis Públicas
    /////////////////////////////////////////////////

    /**#@-*/
    private $ID 		=0; //id da mensagem
    private $Texto		=""; //Texto da mensagem
    private $IDCliente  =0; // id do cliente utilizador do sistema de mensagens
    private $IDSite		=0; // id do usuário no site do cliente
    private $Lista		=0; // codigo da lista de filtros selecionada
    private $Associados ="N"; // Envia a mensagem para associados s/n
    private $NaoAssociados = "N"; //Envia a mensagem para não associados s/n
    private $DataHora	="0000/00/00"; //data e hora da mensagem enviada 
    private $Numero    	=0; //numero do celular destinatario da mensagem 
    private $Existe     = "N";    
    private $MensagemF   = "N"; //Mensagen substituindo os termos que não mudam conforme usuario
    private $MensagemV   = "N"; //Mensagen substituindo os termos por usuario
	private $Qtde		=0; // Qtde de mensagens enviadas com o filtro selecionado
    /**
     * Construtor 
     * @param void
     * @return void
     */
 function SMS($id) {
		if ($id > 0) {
      	   $db = new BDSMS();

		   $sql = sprintf("select
					        id,
					  		texto,
					  		idcliente,
					  		idsite,
					  		lista,
					  		associados,
					  		naoassociados,
					  		datahora,
					  		numero,
					  		qtde
					  		from tb_mensagem
		               where id= %d",$id);

		    $db->Query($sql);

			if ($db->NumRows() == 0) 
				$this->Existe = 'N';
		    else {
				    $this->Existe = 'S';
					$db->Next();
				    $this->ID 				= $id;
				    $this->Texto      		= $db->getValue('texto');
				    $this->IDCliente		= $db->getValue('idcliente');
				    $this->IDSite  			= $db->getValue('idsite');
					$this->Lista	 		= $db->getValue('lista');
					$this->Associados		= $db->getValue('associados');
					$this->NaoAssociados   	= $db->getValue('naoassociados');
				    $this->DataHora			= $db->getValue('datahora');
				    $this->Numero		    = $db->getValue('numero');
				    $this->Qtde			    = $db->getValue('qtde');
				}
		    $db->Close();
			}
		else {
				$this->Existe = "N";
		}
	return;

    }
	/************************************************************************************
	 ** Funções GET                                                                    **
	 ***********************************************************************************/
	function getID() { 
			return $this->ID;
	}
	function getTexto() { 
			return $this->Texto;
	}
	function getIDCliente() { 
			return $this->IDCliente;
	}
	function getIDSite() { 
			return $this->IDSite;
	}
	function getLista() { 
			return $this->Lista;
	}
	function getAssociados() { 
			return $this->Associados;
	}			
	function getNaoAssociados() { 
			return $this->NaoAssociados;
	}	
	function getDataHora() { 
			return $this->DataHora;
	}	
	function getNumero() { 
			return $this->Numero;
	}
	function getMensagemF() { 
			return $this->MensagemF;
	}
	function getMensagemV() { 
			return $this->MensagemV;
	}
	function getQtde() { 
			return $this->Qtde;
	}	
	/************************************************************************************
	 ** Funções SET                                                                    **
	 ***********************************************************************************/
	function setTexto($var) {	
			$this->Texto = $var;
	}		
	function setIDCliente($var) {	
			$this->IDCliente = $var;
	}	
	function setIDSite($var) {	
			$this->IDSite = $var;
	}	
	function setLista($var) {	
			$this->Lista = $var;
	}	
	function setAssociados($var) {	
			$this->Associados = $var;
	}	
	function setNaoAssociados($var) {	
			$this->NaoAssociados = $var;
	}						
	function setDataHora($var) {	
			$this->DataHora = $var;
	}
	function setNumero($var) {	
			$this->Numero = $var;
	}
	function setMensagemF($var) {	
			$this->MensagemF = $var;
	}
	function setMensagemV($var) {	
			$this->MensagemV = $var;
	}
	function setQtde($var) {
			$this->Qtde = $var;
	}

	function Enviar($Exibe) { //Envia as mensagens

		$this->substitui_fixo();
        if ($this->getNumero() == 0) {
			$lstu = Usuario::getListaSms($this->getLista(),$this->getAssociados(),$this->getNaoAssociados());
			$this->setQtde(count($lstu));
        }	
        else 
        	$this->setQtde(1);

		if ($Exibe == "S") {
			    echo ("<br/><br/>".$this->getQtde()." Mensagens serão enviadas !!!");
				echo("<br/><br/>Enviando para:<br/>");
		}

        if ($this->Existe == 'N')
 	       $this->Inclui();

 	    if ($this->getNumero() == 0) {
		 	    foreach ($lstu as $l) {
			
						 $this->substitui_Variavel($l['username'],$l['nome']);
						 if ($Exibe == "S")
							 echo(".(".$l['dddcel'].") ".$l['celular']."  -  ".$l['username']."..."),"<br/>";
						 $fone = $l['dddcel'].$l['celular'];
						 $this->EnviaMsg($fone,$this->getMensagemV());
				}
 	    }
		else {
				 if ($Exibe == "S")
					 echo(".".$this->getNumero()."..."),"<br/>";
					 $this->EnviaMsg($this->getNumero(),$this->getMensagemF());
		 
		 }
}

 function substitui_fixo() {
   
 	$this->setMensagemF($this->getTexto());

 	$Reuniao = Reuniao::getReunioes("P");
    foreach($Reuniao as $r) {
          $rn = new Reuniao($r['id']);
          $this->setMensagemF(str_replace('#dtreuniao#',date('d/m/Y',$rn->getData()),$this->getMensagemF()));
	 	  $this->setMensagemF(str_replace('#localproximareuniao#',substr($rn->getLocal(),0,30),$this->getMensagemF()));
	      $this->setMensagemF(str_replace('#hrr#',date('H:i',$rn->getHora()),$this->getMensagemF()));
    }
 }
 
 function substitui_Variavel($UserName,$Nome) { //Substitui os termos variaveis por usuario
   
 	$this->setMensagemV($this->getMensagemF());

	$primeiro_nome = explode(" ",ucwords(strtolower($Nome)));
 	$this->setMensagemV(str_replace('#primeiro_nome#',substr($primeiro_nome[0],0,15),$this->getMensagemV()));
	$this->setMensagemV(str_replace('#usuarionosite#',substr($UserName,0,15),$this->getMensagemV()));
		 
 }

 function Inclui() { //Insere nova reunião

/*
	echo "a:".($this->getTexto())."<br/>";
	echo "b:".($this->getIDCliente())."<br/>";
	echo "c:".($this->getIDSite())."<br/>";
	echo "d:".($this->getLista())."<br/>";
	echo "e:".($this->getAssociados())."<br/>";
	echo "f:".($this->getNaoAssociados())."<br/>";
	echo "g:".($this->getDataHora())."<br/>";
	echo "h:".($this->getNumero())."<br/>";
	echo "i:".($this->getMensagemF())."<br/>";
	echo "j:".($this->getMensagemV())."<br/>";
	echo "k:".($this->getQtde())."<br/>";

  */
 		   $db = new BDSMS();

		   $sql = sprintf("insert into tb_mensagem
		   				  (						      
					  		texto,
					  		idcliente,
					  		idsite,
					  		lista,
					  		associados,
					  		naoassociados,
					  		datahora,
					  		numero,
					  		qtde
					  		)
						  values ('%s',%d,%d,%d,'%s','%s',now(),%d,%d)",
							$this->getTexto(),
							$this->getIDCliente(),
							$this->getIDSite(),
							$this->getLista(),
							$this->getAssociados(),
							$this->getNaoAssociados(),
							$this->getNumero(),
							$this->getQtde());

    		$db->Exec($sql);

            $this->ID = $db->getInsertID();

			$db->Close();

	}

 function Altera() { //Altera a reunião

		   $db = new BDSMS();

		   $db->Close();

	}

 function Exclui() { //Exclui a reuniao

           if ($this->Existe == 'N')
		       return;

		   $db = new BDSMS();

		   $sql = sprintf("delete from tb_mensagem where id = %d"
					   ,$this->getID());

     		$db->Exec($sql);

			$db->Close();

	}

function EnviaMsg($Destinatario, $Texto) { // Envia mensagem

$Env = new SMSSend(0);
$Env->setRecipient($Destinatario);
$Env->setText($Texto);
$Env->setIDMsg($this->getID());
$Env->Envia();
}

function StatusSMSServer() {
		$errno=0;
		$errstr="";

		$smsfp = @fsockopen("franca.sytes.net", 3306, $errno, $errstr, 30);
		if (!$smsfp) {
		    return false;
		} else {
				fclose($smsfp);
				return true;
			}
}

function WakeSMSServer() {
    $ip = gethostbyname("franca.sytes.net");
    $mac = "0040F45AF534";
    $port = 9;
    
    $url =  "http://www.depicus.com/wake-on-lan/woli.aspx?m=".$mac."&i=".$ip."&s=255.255.255.255&p=".$port;

    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_HEADER, TRUE); 
    curl_setopt($ch, CURLOPT_NOBODY, TRUE); // remove body 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
    $head = curl_exec($ch); 
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
    curl_close($ch);
    return;
}
function DesligaSMSServer() {

	$url =  "http://franca.sytes.net/agendadesliga.php";
//	$url =  "http://franca.sytes.net/desliga.php?senha=".md5('racnelaocf');
//	echo $url;
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_HEADER, TRUE); 
    curl_setopt($ch, CURLOPT_NOBODY, TRUE); // remove body 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
    $head = curl_exec($ch); 
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
//    echo $head.$httpCode;
    curl_close($ch);
    return;
 }
}
?>