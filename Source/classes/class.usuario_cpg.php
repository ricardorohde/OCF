<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.bdcpg.php");
?>

<?php

////////////////////////////////////////////////////
// Usuario CPG - classe usuário_cpg
//
// Classe para tratamento dos usuários na galeria de fotos coopermine
//
////////////////////////////////////////////////////

/**
 * Usuario_cpg - Classe do cadastro de usuários na galeria de fotos coopermine
 * @package usuario_cpg
 * @author Alencar Mendes de Oliveira
 */
class Usuario_CPG
{
    /////////////////////////////////////////////////
    // Variáveis Públicas
    /////////////////////////////////////////////////

    private $UserID		      = 0; // ID usuário na galeira
    private $UserGroup		  = 0; // Grupo do usuário
    private $UserActive	  	  = 0; // Usuario ativo Yes/NO
    private $UserName	      = ""; // Nome de login do usuário
    private $PassWord		  = ""; //	Senha do usuário na galeria 
    private $LastVisit        = "00/00/0000 00:00:00"; // Data da ultima visita
    private $UserRegDate      = "00/00/0000 00:00:00"; // Data e hora de registro do usuário
    private $UserGroupList    = ""; // Grupo de visualização (Null)
    private $UserEmail        = ""; // Email do usuario
    private $UserProfile1	  = ""; // Cidade do usuário
    private $UserProfile2	  = ""; // Interesses
    private $UserProfile3	  = ""; // Website
    private $UserProfile4	  = ""; // Profissão
    private $UserProfile5	  = ""; // Mensagem Pessoal
    private $UserProfile6	  = ""; // Livre
    private $UserActKey		  = ""; // Chave de ativação (Null)
    private $Existe           = "N";    
    private $db_cpg;
    /**#@-*/
    

    /**
     * Construtor 
     * @param int $userid
     * @return void
     */
 function Usuario_CPG ($userid) {
   
   $this->db_cpg = new BDCPG();
     
   $sql = sprintf("select
  			       user_id
				    ,user_group
				    ,user_active
				    ,user_name
				    ,user_password 
				    ,user_lastVisit
				    ,user_regdate
				    ,user_group_list
				    ,user_email
				    ,user_profile1
				    ,user_profile2
				    ,user_profile3
				    ,user_profile4
				    ,user_profile5
				    ,user_profile6
				    ,user_actkey
			   from cpg14x_users
               where user_id = %d",$userid);

    $this->db_cpg->Query($sql);
	
 	if ( $this->db_cpg->NumRows() == 0) 
		$this->Existe = 'N';
    else {
		    $this->Existe = 'S';
			$this->db_cpg->Next();
			$this->UserID		    = $userid;
			$this->UserGroup		= $this->db_cpg->getValue('user_group');
			$this->UserActive	  	= $this->db_cpg->getValue('user_active');
			$this->UserName	   		= $this->db_cpg->getValue('user_name');
			$this->PassWord			= $this->db_cpg->getValue('user_password'); 
			$this->LastVisit     	= $this->db_cpg->getValue('user_lastVisit');
			$this->UserRegDate   	= $this->db_cpg->getValue('user_regdate');
			$this->UserGroupList  	= $this->db_cpg->getValue('user_group_list');
			$this->UserEmail      	= $this->db_cpg->getValue('user_email');
			$this->UserProfile1		= $this->db_cpg->getValue('user_profile1');
			$this->UserProfile2		= $this->db_cpg->getValue('user_profile2');
			$this->UserProfile3		= $this->db_cpg->getValue('user_profile3');
			$this->UserProfile4		= $this->db_cpg->getValue('user_profile4');
			$this->UserProfile5		= $this->db_cpg->getValue('user_profile5');
			$this->UserProfile6		= $this->db_cpg->getValue('user_profile6');
			$this->UserActKey		= $this->db_cpg->getValue('user_actkey');
		}
    
    }

	function getUserID()		    {	return $this->UserID;		}
	function getUserGroup()			{	return $this->UserGroup;	}
	function getUserActive()	  	{	return $this->UserActive;	}
	function getUserName()	   		{	return $this->UserName;		}
	function getPassWord()			{	return $this->PassWord;		}
	function getLastVisit()     	{	return strtotime($this->LastVisit); 	}
	function getUserRegDate()   	{	return strtotime($this->UserRegDate);	}
	function getUserGroupList()  	{	return $this->UserGroupList;}
	function getUserEmail()      	{	return $this->UserEmail;	}
	function getUserProfile1()		{	return $this->UserProfile1;	}
	function getUserProfile2()		{	return $this->UserProfile2;	}
	function getUserProfile3()		{	return $this->UserProfile3;	}
	function getUserProfile4()		{	return $this->UserProfile4;	}
	function getUserProfile5()		{	return $this->UserProfile5;	}
	function getUserProfile6()		{	return $this->UserProfile6;	}
	function getUserActKey()		{	return $this->UserActKey;	}
	function Existe()		{	return $this->Existe;	}
	
	function setUserID($var)		    {	 $this->UserID = $var;		}
	function setUserGroup($var)			{	 $this->UserGroup = $var;	}
	function setUserActive($var)	  	{	 $this->UserActive = $var;	}
	function setUserName($var)	   		{	 $this->UserName = $var;		}
	function setPassWord($var)			{	 $this->PassWord = $var;		}
	function setLastVisit($var)     	{	 $this->LastVisit = $var; 	}
	function setUserRegDate($var)   	{	 $this->UserRegDate = $var;	}
	function setUserGroupList($var)  	{	 $this->UserGroupList = $var;}
	function setUserEmail($var)      	{	 $this->UserEmail = $var;	}
	function setUserProfile1($var)		{	 $this->UserProfile1 = $var;	}
	function setUserProfile2($var)		{	 $this->UserProfile2 = $var;	}
	function setUserProfile3($var)		{	 $this->UserProfile3 = $var;	}
	function setUserProfile4($var)		{	 $this->UserProfile4 = $var;	}
	function setUserProfile5($var)		{	 $this->UserProfile5 = $var;	}
	function setUserProfile6($var)		{	 $this->UserProfile6 = $var;	}
	function setUserActKey($var)		{	 $this->UserActKey = $var;	}
	
function validaUser() //Se o usuário já está cadastrado pelo forum assume esse ID
{

	if ($this->Existe == 'N') {	 
		   $sql = sprintf("select
  			       			user_id
			   from cpg14x_users
               where upper(user_name) = '%s' \n",strtoupper($this->getUserName()));

		    $this->db_cpg->Query($sql);

		    if ( $this->db_cpg->NumRows() == 0) { // Verifica se já está cadastrado pelo e-mail
		   $sql = sprintf("select
  			       			user_id
			   from cpg14x_users
		       where lower(user_email) = '%s' \n",strtolower($this->getUserEmail()));

				    $this->db_cpg->Query($sql);
		    		if ( $this->db_cpg->NumRows() == 0) {
						$this->Existe = 'N';
		    		}
					else {
						    $this->Existe = 'S';
							$this->db_cpg->Next();
							$this->UserID = $this->db_cpg->getValue('user_id');
						}
		 	}
		    else {
				    $this->Existe = 'S';
					$this->db_cpg->Next();
					$this->UserID	    = $this->db_cpg->getValue('user_id');
				}
   	}
}
	
function Grava() { //Grava as informações da reuniao

	$this->ValidaUser();

           if ($this->Existe == 'N')
		       $this->Inclui();
		   else
		       $this->Altera();

	}

 private function Inclui() { //Insere nova reunião

		   $x = 0;

		   $sql = sprintf("insert into cpg14x_users
		   				  (user_group
		   				  	,user_active
				    	 	,user_name
				    		,user_password 
				    		,user_regdate
				    		,user_group_list
				    		,user_email
				    		,user_profile1
				    		,user_profile2
				    		,user_profile3
				    		,user_profile4
				    		,user_profile5
				    		,user_profile6
				    		,user_actkey)
						  values ('%d','%s','%s','%s',now(),'%s','%s','%s','%s','%s','%s','%s','%s','%s')",
								 $this->getUserGroup(),
								 $this->getUserActive(),
								 $this->getUserName(),
								 $this->getPassWord(),
								 $this->getUserGroupList(),
								 $this->getUserEmail(),
								 $this->getUserProfile1(),
								 $this->getUserProfile2(),
								 $this->getUserProfile3(),
								 $this->getUserProfile4(),
								 $this->getUserProfile5(),
								 $this->getUserProfile6(),
								 $this->getUserActKey());

    		$this->db_cpg->Exec($sql);

            $this->setUserID($this->db_cpg->getInsertID());


	}


 private function Altera() { //Altera a reunião

		   $sql = sprintf("update cpg14x_users
		                   set user_group = %d
		   				  	,user_active = '%s'
				    	 	,user_name = '%s'
				    		,user_password = '%s'
				    		,user_group_list = '%s'
				    		,user_email = '%s'
				    		,user_profile1 = '%s'
				    		,user_profile2 = '%s'
				    		,user_profile3 = '%s'
				    		,user_profile4 = '%s'
				    		,user_profile5 = '%s'
				    		,user_profile6 = '%s'
				    		,user_actkey = '%s'
							   where 
							   user_id = %d",
								 $this->getUserGroup(),
								 $this->getUserActive(),
								 $this->getUserName(),
								 $this->getPassWord(),
								 $this->getUserGroupList(),
								 $this->getUserEmail(),
								 $this->getUserProfile1(),
								 $this->getUserProfile2(),
								 $this->getUserProfile3(),
								 $this->getUserProfile4(),
								 $this->getUserProfile5(),
								 $this->getUserProfile6(),
								 $this->getUserActKey(),
								 $this->getUserID());

     		$this->db_cpg->Exec($sql);


	}

 function Exclui() { //Exclui a reuniao

           if ($this->Existe == 'N')
		       return;

		   $sql = sprintf("delete from cpg14x_users where user_id = %d"
					   ,$this->getUserID());
		
     		$this->db_cpg->Exec($sql);
			
	}


function __destruct(){

	$this->db_cpg->Close();
}
	
}
?>