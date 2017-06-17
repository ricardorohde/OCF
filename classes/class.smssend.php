<?php include("sessao.php"); ?>
<?php
require_once($_SESSION['DOCROOT']."/classes/class.bdsms.php");
////////////////////////////////////////////////////
//
// SMSSend - Classe para envio de mensagens sms utilizando o smslib via interface de banco de dados
//
////////////////////////////////////////////////////

/**
 * SMS - Classe para envio de mensagens sms
 * @package SMS
 * @author Alencar Mendes de Oliveira
 */
class SMSSend
{
    /////////////////////////////////////////////////
    // Variáveis 
    /////////////////////////////////////////////////

    private $ID               = 0;   // ID da mensagem gerada.
    private $Type     		  = 'O'; // The message type. This should be "O" for normal outbound messages, or "W" for wap si messages.
    private $Recipient	      = '';  // The recipient's number to whom the message should be sent.
    private $Text	          = '';  // The message text.
	private $Encoding         = '';  // "7" for 7bit, "8" for 8bit and "U" for Unicode/UCS2.
	private $Status_report    = 0;   // Set to 1 if you require a status report message to be generated.
	private $Sent_date        = "0000/00/00"; // The sent date. This field is updated by SMSServer when it sends your message.
    private $Ref_no			  = "";	 // The Reference ID of your message. This field is updated by SMSServer when it sends your message.
    private $Status		      = '';  // "U" : unsent, "Q" : queued, "S" : sent, "F" : failed. This field is updated by SMSServer when it sends your message. If set in the configuration file, this field takes extra values depending on the received status report message: "D" : delivered, "P" : pending, "A" : aborted.
	private $errors			  = 0;	 // The number of retries SMSServer did to send your message. This field is updated by SMSServer.
	private $IDMsg			  = 0;   // ID da mensagem principal
	private $Existe           = "N";
    /**#@-*/
    

    /**
     * Construtor 
     * @param int $id
     * @return void
     */
 function SMSSend($id) {
   
   
   if ($id <> 0) 
   {
      	   $db = new BDSMS();

		   $sql = sprintf("select
					        id,
					  		type,
					  		recipient,
					  		text,
					  		encoding,
					  		status_report,
					  		sent_date,
					  		ref_no,
					  		status,
					  		errors,
					  		idmsg
					  		from smsserver_out
		               where id= %d",$id);

		    $db->Query($sql);

			if ($db->NumRows() == 0) 
				$this->Existe = 'N';
		    else {
				    $this->Existe = 'S';
					$db->Next();
				    $this->ID 				= $id;
				    $this->Type      		= $db->getValue('Type');
				    $this->Recipient		= $db->getValue('Recipient');
				    $this->Text	  			= $db->getValue('Text');
					$this->Encoding 		= $db->getValue('Encoding');
					$this->Status_report	= $db->getValue('Status_report');
					$this->Sent_date    	= $db->getValue('Sent_date');
				    $this->Ref_no			= $db->getValue('Ref_no');
				    $this->Status		    = $db->getValue('Status');
					$this->errors			= $db->getValue('errors');
					$this->idmsg			= $db->getValue('idmsg');				}
		    $db->Close();
			}
	else {
			$this->Existe = 'N';
    		$this->setType('O');
			$this->setEncoding('U');
			$this->setStatus('U');
			$this->setStatus_report(0);
		}
			return;
    }

	/************************************************************************************
	 ** Funções GET                                                                    **
	 ***********************************************************************************/
	function getID() { 
			return $this->ID;
	}
	function getType() {	
			return $this->Type;
	}
	function getRecipient() {	
			return $this->Recipient;
	}
	function getText() {	
			return $this->Text;
	}
	function getEncoding() {	
			return $this->Encoding;
	}
	function getStatus_report() {	
			return $this->Status_report;
	}
	function getSent_date() {	
			return $this->Sent_date;
	}
	function getRef_no() {	
			return $this->Ref_no;
	}	
	function getStatus() {	
			return $this->Status;
	}		
	function geterrors() {	
			return $this->errors;
	}		
	function getIDMsg() {	
			return $this->IDMsg;
	}		/************************************************************************************
	 ** Funções SET                                                                    **
	 ***********************************************************************************/
	function setType($var) {	
			$this->Type = $var;
	}
	function setRecipient($var) {
			$this->Recipient = $var;
	}
	function setText($var) {
			$this->Text = $var;
	}
	function setEncoding($var) {
			$this->Encoding = $var;
	}
	function setStatus_report($var) {
			$this->Status_report = $var;
	}	
	function setSent_date($var) {
			$this->Sent_date = $var;
	}
	function setRef_no($var) {
			$this->Ref_no = $var;
	}
	function setStatus($var) {
			$this->Status = $var;
	}		
	function seterrors($var) {
			$this->errors = $var;
	}	
	function setIDMsg($var) {
			$this->IDMsg = $var;
	}	
 function Envia() { //Grava as informações da reuniao

           if ($this->Existe == 'N')
		       $this->Inclui();
		   else
		       $this->Altera();

	}

 function Inclui() { //Insere nova reunião

			/*
			echo ($this->getType())."<br/>";
			echo ($this->getRecipient())."<br/>";
			echo ($this->getText())."<br/>";
			echo ($this->getEncoding())."<br/>";
			echo ($this->getStatus_report())."<br/>";
			echo ($this->getSent_date())."<br/>";
			echo ($this->getRef_no())."<br/>";
			echo ($this->getStatus())."<br/>";
			echo ($this->geterrors())."<br/>";
			*/
 
 
 		   $db = new BDSMS();

		   $sql = sprintf("insert into smsserver_out
		   				  (	type,
					  		recipient,
					  		text,
					  		encoding,
					  		status_report,
					  		sent_date,
					  		ref_no,
					  		status,
					  		errors,
					  		create_date,
					  		idmsg
					  		)
						  values ('%s','%s','%s','%s',%d,'%s','%s','%s',%d,now(),%d)",
							$this->getType(),
							$this->getRecipient(),
							$this->getText(),
							$this->getEncoding(),
							$this->getStatus_report(),
							$this->getSent_date(),
							$this->getRef_no(),
							$this->getStatus(),
							$this->geterrors(),
							$this->getIDMsg());

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

		   $db = new BD();

		   $sql = sprintf("delete from smsserver_out where id = %d"
					   ,$this->getID());

     		$db->Exec($sql);

			$db->Close();

	}

 function getMensagens() { // Retorna a lista de mensagens enviadas 

   /*        $reunioes = array();
		   
		   $db = new BD();
		   
           if ($filtro == 'T')
			   $sql = sprintf("select
						   id,
						   local,
						   data,
						   hora
						   from
						   cad_reuniao
						   order by data desc");
			else
            if ($filtro == 'P')
			   $sql = sprintf("select
							   min(id) id
							   from
							   cad_reuniao
							   where
							   data >= curdate()
							   order by data desc");

			$db->Query($sql);

			while($db->Next()) {
					array_push($reunioes,$db->Row);
				}	

			$db->Close();*/

			return;
	}
}

	?>