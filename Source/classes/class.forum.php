<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.bdforum.php");
?>

<?php

////////////////////////////////////////////////////
// Forum- classe de tratamento do forum do site
//
// Classe para tratamento do forum do site
//
////////////////////////////////////////////////////

/**
 * Forum - Classe de integração com o forum de discussão do site
 * @package Forum
 * @author Alencar Mendes de Oliveira
 */
class Forum
{
    /////////////////////////////////////////////////
    // Variáveis Públicas
    /////////////////////////////////////////////////

    private $ID_Member	      = 0; // ID usuário no forum
    private $MemberName		  = ""; // Username do usuário 
    private $PassWD           = ""; // Senha do forum
    private $EmailAddress     = ""; // EmailData e hora de registro do usuário
    private $Location         = ""; // Cidade
    private $Existe           = "N";    
    private $db_forum;
    /**#@-*/
    

    /**
     * Construtor 
     * @param int $userid
     * @return void
     */
 function Forum ($idmember) {
   
   $this->db_forum = new BDFORUM();

   $sql = sprintf("select
  			       ID_MEMBER
				    ,memberName
				    ,emailAddress
				    ,location
			   from smf_members
               where id_member = %d",$idmember);

    $this->db_forum->Query($sql);

    if ( $this->db_forum->NumRows() == 0) {
		$this->Existe = 'N';
 	}
    else {
		    $this->Existe = 'S';
			$this->db_forum->Next();
			$this->ID_Member	    = $this->db_forum->getValue('ID_MEMBER');
			$this->MemberName		= $this->db_forum->getValue('memberName');
			$this->EmailAddress	   	= $this->db_forum->getValue('emailAddress');
			$this->Location			= $this->db_forum->getValue('location'); 
		}
 }
 
	function getID_Member()		    {	return $this->ID_Member;		}
	function getMemberName()		{	return $this->MemberName;	}
	function getPassWD()	  		{	return $this->PassWD;	}
	function getEmailAddress()	   	{	return $this->EmailAddress;		}
	function getLocation()			{	return $this->Location;		}
	function Existe()				{	return $this->Existe;	}
	
	function setID_Member($var)		{	 $this->ID_Member = $var;	}
	function setMemberName($var)	{	 $this->MemberName = $var;	}
	function setPassWD($var)	  	{	 $this->PassWD = $var;	}
	function setEmailAddress($var)	{	 $this->EmailAddress = $var;	}
	function setLocation($var)		{	 $this->Location = $var;	}

function validaUser() //Se o usuário já está cadastrado pelo forum assume esse ID
{

	if ($this->Existe == 'N') {	 
		   $sql = sprintf("select
		  			       ID_MEMBER
					   from smf_members
		           		where memberName = '%s' \n",$this->getMemberName());

		    $this->db_forum->Query($sql);

		    if ( $this->db_forum->NumRows() == 0) { // Verifica se já está cadastrado pelo e-mail
				   $sql = sprintf("select
				  			       ID_MEMBER
							   from smf_members
					   where emailAddress = '%s' \n",$this->getEmailAddress());

				    $this->db_forum->Query($sql);
		    		if ( $this->db_forum->NumRows() == 0) {
						$this->Existe = 'N';
		    		}
					else {
						    $this->Existe = 'S';
							$this->db_forum->Next();
							$this->ID_Member	    = $this->db_forum->getValue('ID_MEMBER');
						}
		 	}
		    else {
				    $this->Existe = 'S';
					$this->db_forum->Next();
					$this->ID_Member	    = $this->db_forum->getValue('ID_MEMBER');
				}
   	}
}
	
function Grava() { 

		$this->ValidaUser();
			
           if ($this->Existe == 'N')
		       $this->Inclui();
		   else
		       $this->Altera();

	}

 private function Inclui() { 

	$regOptions['register_vars'] = array(
		'memberName' => "'".$this->getMemberName()."'",
		'emailAddress' => "'".$this->getEmailAddress()."'",
		'passwd' => '\'' . sha1(strtolower($this->getMemberName()) . $this->getPassWD()) . '\'',
		'passwordSalt' => '\'' . substr(md5(mt_rand()), 0, 4) . '\'',
		'posts' => 0,
		'dateRegistered' => time(),
		'memberIP' => "'$_SERVER[REMOTE_ADDR]'",
		'memberIP2' => "'$_SERVER[REMOTE_ADDR]'",
		'validation_code' => "''",
		'realName' => "'".$this->getMemberName()."'",
		'personalText' => "''",
		'pm_email_notify' => 1,
		'ID_THEME' => 0,
		'ID_POST_GROUP' => 4,
		'lngfile' => "''",
		'buddy_list' => "''",
		'pm_ignore_list' => "''",
		'messageLabels' => "''",
		'personalText' => "''",
		'websiteTitle' => "''",
		'websiteUrl' => "''",
		'location' => "'".$this->getLocation()."'",
		'ICQ' => "''",
		'AIM' => "''",
		'YIM' => "''",
		'MSN' => "''",
		'timeFormat' => "''",
		'signature' => "''",
		'avatar' => "''",
		'usertitle' => "''",
		'secretQuestion' => "''",
		'secretAnswer' => "''",
		'additionalGroups' => "''",
		'smileySet' => "''",
	);
	
	echo(implode(', ', array_keys($regOptions['register_vars'])));
	echo(implode(', ', $regOptions['register_vars']));
	
		   $sql =	"INSERT INTO smf_members
			(" . implode(', ', array_keys($regOptions['register_vars'])) . ")
		VALUES (" . implode(', ', $regOptions['register_vars']) . ')'; 

    		$this->db_forum->Exec($sql);

            $this->setID_Member($this->db_forum->getInsertID());

	}

 private function Altera() { //Altera a reunião

		   $sql = sprintf("update smf_members
		                   set memberName = '%s'
		   				  	,passwd = '%s'
				    	 	,emailAddress = '%s'
				    		,location = '%s'
				    		,realName = '%s'
							   where 
							   ID_MEMBER = %d",
								 $this->getMemberName(),
								 sha1(strtolower($this->getMemberName()) . $this->getPassWD()),
								 $this->getEmailAddress(),
								 $this->getLocation(),
								 $this->getMemberName(),
								 $this->getID_Member());
			echo($sql);
								 
     		$this->db_forum->Exec($sql);

	}

 function Exclui() { //Exclui a reuniao

           if ($this->Existe == 'N')
		       return;

		   $sql = sprintf("delete from smf_members where ID_MEMBER = %d"
					   ,$this->getID_Member());
		
     		$this->db_forum->Exec($sql);
			
	}

 function Ultimas() { //Lista as 10 ultimas mensagens do forum

 	$msg  = array();

 	
 	$db_forum = new BDFORUM();

   $sql = sprintf("select msg.id_msg,topic.ID_topic id_topic, msg.postertime, brd.name name,msg.postername, 
						titulo.subject,replace(replace(replace(substr(msg.body,1,30),'<br />',''),'<br /',''),'<br>','') body
						 from
						`smf_boards`brd,
						smf_messages titulo,
						`smf_topics` topic,
						smf_messages msg
						where
						titulo.`ID_MSG`= topic.`ID_FIRST_MSG`
						and topic.`ID_topic`= msg.id_topic
						and brd.id_board = msg.id_board
						ORDER BY msg.postertime desc
						limit 10");

   	  $db_forum->Query($sql);

			while($db_forum->Next()) {
					array_push($msg,$db_forum->Row);
				}	

	 	$db_forum->Close();

		return $msg;

}	

function __destruct(){

	$this->db_forum->Close();
}
	
}
?>
