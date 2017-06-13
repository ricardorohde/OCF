<?php include("sessao.php"); ?>
<?php
require_once($_SESSION['DOCROOT']."/classes/class.bdsms.php");
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

    private $ID               = 0;   // ID da mensagem gerada.
    private $Type_send		  = 'O'; // The message type. This should be "O" for normal outbound messages, or "W" for wap si messages.
    private $Recipient	      = '';  // The recipient's number to whom the message should be sent.
    private $Text	          = '';  // The message text.
	private $Encoding         = '';  // "7" for 7bit, "8" for 8bit and "U" for Unicode/UCS2.
	private $Status_report    = 0;   // Set to 1 if you require a status report message to be generated.
	private $Sent_date        = "0000/00/00"; // The sent date. This field is updated by SMSServer when it sends your message.
    private $Ref_no			  = 0;	 // The Reference ID of your message. This field is updated by SMSServer when it sends your message.
    private $Status		      = '';  // "U" : unsent, "Q" : queued, "S" : sent, "F" : failed. This field is updated by SMSServer when it sends your message. If set in the configuration file, this field takes extra values depending on the received status report message: "D" : delivered, "P" : pending, "A" : aborted.
	private $errors			  = 0;	 // The number of retries SMSServer did to send your message. This field is updated by SMSServer.
	private $Originator		  = '';  // The originator of the received message.    
	private $Type_Recv	      = '';  // 
    private $Existe           = "N";
    /**#@-*/
    

    /**
     * Construtor 
     * @param int $id
     * @return void
     */
 function Reuniao($id) {
   
   $db = new BD();
   
   $sql = sprintf("select
			   id,
			   data,
			   hora,
			   local
			   from
               cad_reuniao
               where id= %d",$id);

    $db->Query($sql);
	
	if ($db->NumRows() == 0) 
		$this->Existe = 'N';
    else {
		    $this->Existe = 'S';
			$db->Next();
			$this->ID               = $id;
			$this->Data             = $db->getValue('data');
			$this->Hora             = $db->getValue('hora');
			$this->Local            = $db->getValue('local');
		}
    $db->Close();

    }

	/************************************************************************************
	 ** Funções GET                                                                    **
	 ***********************************************************************************/
	function getID() { //Retorna o codigo da reunião
			return $this->ID;
	}

	function getLocal() {	//Retorna o local da reunião 
			return $this->Local;
	}

	function getData() {	//Retorna a Data da reunião
			return strtotime($this->Data);
	}

	function getHora() {	//Retorna a Hora da reunião
			return strtotime($this->Hora);
	}

	/************************************************************************************
	 ** Funções SET                                                                    **
	 ***********************************************************************************/
	function setLocal($var) {	//Altera o valor do atributo local
			$this->Local = $var;
	}

	function setData($var) {	//Altera o valor do atributo Data
			$this->Data = $var;
	}

	function setHora($var) {	//Altera o valor do atributo Hora
			$this->Hora = $var;
	}

 function Grava() { //Grava as informações da reuniao

           if ($this->Existe == 'N')
		       $this->Inclui();
		   else
		       $this->Altera();

	}

 function Inclui() { //Insere nova reunião

		   $x = 0;

		   $db = new BD();

		   $sql = sprintf("insert into cad_reuniao
		   				  (data,hora,local)
						  values ('%s','%s','%s')",
						   date("Y/m/d",$this->getData()),
						   date("H:i",$this->getHora()),
						   $this->getLocal());

    		$db->Exec($sql);

            $this->ID = $db->getInsertID();

			$db->Close();

	}


 function Altera() { //Altera a reunião

		   $db = new BD();

		   $sql = sprintf("update cad_reuniao
		                   set data = '%s',
						       hora = '%s',
						       local = '%s'
							   where 
							   id = %d",
							date("Y/m/d",$this->getData()),
							date("H:i",$this->getHora()),
							$this->getLocal(),
							$this->getID());

     		$db->Exec($sql);

			$db->Close();

	}

 function Exclui() { //Exclui a reuniao

           if ($this->Existe == 'N')
		       return;

		   $db = new BD();
		   
		   $sql = sprintf("delete from cad_reuniao where id = %d"
					   ,$this->getID());
		
     		$db->Exec($sql);
			
			$db->Close();

	}

 function getReunioes($filtro) { // Retorna as reuniões cadastradas

           $reunioes = array();
		   
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

			$db->Close();

			return $reunioes;
	}
}

	?>