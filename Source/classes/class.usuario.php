<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/sessao.php"); 
require_once($_SERVER['DOCUMENT_ROOT']."/classes/class.bd.php");
include($_SERVER['DOCUMENT_ROOT']."/geoipcity.inc");
?>
<?php

////////////////////////////////////////////////////
// Usuario - classe usuário
//
// Classe para tratamento dos usuários
//
////////////////////////////////////////////////////

/**
 * Usuario - Classe do cadastro de usuário
 * @package usuario
 * @author Alencar Mendes de Oliveira
 */
class Usuario
{
    /////////////////////////////////////////////////
    // Variáveis Públicas
    /////////////////////////////////////////////////

    var $Username         = "";
    var $Senha            = "";
    var $Nome             = "";
    var $Endereco         = "";
    var $Numero           = 0;
    var $Cidade           = "";
    var $Estado           = "";
    var $Cep              = 0;
    var $DDD              = 0;
    var $Fone             = 0;
    var $DDDCel           = 0;
    var $Celular          = 0;
    var $EMail            = "";
    var $DataNasc         = "";
	var $Nivel	 		  = 0;
	var $Userid	          = 0;
	var $Publica		  = "";
	var $Confirma	      = "";
	var $DtCadastro       = "";
	var $HrCadastro       = "";
    var $PossuiOpala      = "";
	var $Descricao        = "";
	var $AnoOpala         = 0;
	var $RecMail          = "";
	var $Aprovado         = "N";
	var $DataAprovacao    = "00/00/0000";

    /**#@-*/
    

    /**
     * Construtor 
     * @param int $userid
     * @return void
     */
 function Usuario($userid) {
   
   $db_user = new BD();
   
   $sql = sprintf("select
			   username,
			   nome,
			   endereco,
			   numero,
			   cidade,
			   estado,
			   cep,
			   ddd,
			   fone,
			   dddcel,
			   celular,
			   email,
			   datanasc,
			   nivel,
			   dtcadastro,
			   flpublica,
			   flconfirma,
			   possuiopala,
			   descricao,
			   anopala,
			   recmail,
			   aprovado,
			   dtaprovacao
			   from
               cad_usuario
               where userid = %d",$userid);

    $db_user->Query($sql);
	
    $db_user->Next();

    $this->Username         = $db_user->getValue('username');
    $this->Nome             = $db_user->getValue('nome');
    $this->Endereco         = $db_user->getValue('endereco');
    $this->Numero           = $db_user->getValue('numero');
    $this->Cidade           = $db_user->getValue('cidade');
    $this->Estado           = $db_user->getValue('estado');
    $this->Cep              = $db_user->getValue('cep');
    $this->DDD              = $db_user->getValue('ddd');
    $this->Fone             = $db_user->getValue('fone');
    $this->DDDCel           = $db_user->getValue('dddcel');
    $this->Celular          = $db_user->getValue('celular');
    $this->EMail            = $db_user->getValue('email');
    $this->DataNasc         = $db_user->getValue('datanasc');
	$this->Nivel	 		= $db_user->getValue('nivel');
	$this->Userid	        = $userid;
	$this->Publica		    = $db_user->getValue('flpublica');
	$this->Confirma	        = $db_user->getValue('flconfirma');
	$this->DtCadastro       = date("d/m/Y",strtotime($db_user->getValue('dtcadastro')));
	$this->HrCadastro       = date("H:i:s",strtotime($db_user->getValue('dtcadastro')));
	$this->PossuiOpala      = $db_user->getValue('possuiopala');
	$this->Descricao        = $db_user->getValue('descricao');
	$this->AnoOpala         = $db_user->getValue('anopala');
	$this->RecMail          = $db_user->getValue('recmail');
	$this->Aprovado         = $db_user->getValue('aprovado');
	$this->DataAprovacao    = $db_user->getValue('dtaprovacao');

    $db_user->Close();

    }

	function getUsername() 		{	return $this->Username;		}
	function getSenha() 		{	return $this->Senha;		}
	function getNome() 			{	return ucwords(strtolower($this->Nome));			}
	function getEndereco() 		{	return $this->Endereco;		}
	function getNumero() 		{	return $this->Numero;		}
	function getCidade() 		{	return ucwords(strtolower($this->Cidade));		}
	function getEstado() 		{	return strtoupper($this->Estado);		}
	function getCep() 			{	return $this->Cep;			}
	function getDDD() 			{	return $this->DDD;			}
	function getFone() 			{	return $this->Fone;			}
	function getDDDCel() 		{	return $this->DDDCel;		}
	function getCelular() 		{	return $this->Celular;		}
	function getEMail() 		{	return $this->EMail;		}
	function getDataNasc() 		{	return $this->DataNasc;		}
	function getNivel() 		{	return $this->Nivel;		}
	function getUserid() 		{	return $this->Userid;		}
	function getPublica() 		{	return $this->Publica;		}
	function getConfirma() 		{	return $this->Confirma;		}
	function getDtCadastro()	{	return $this->DtCadastro;	}
	function getHrCadastro() 	{	return $this->HrCadastro;	}
    function getPossuiOpala() 	{	return $this->PossuiOpala;	}
	function getDescricao() 	{	return $this->Descricao;	}
    function getAnoOpala()      {   return $this->AnoOpala;     }
    function getRecMail()       {   return $this->RecMail;      }
    function getAprovado()      {   return $this->Aprovado;     }
    function getDataAprovacao() {   return $this->DataAprovacao;}
	function getLinkUsuario() 	{	return $this->getLink($this->getUsername()); 	}
	function getLinkNome () 	{	return $this->getLink($this->getNome());		}
	function getLinkCidade () 	{	return $this->getLink($this->getCidade());		}
	function getLinkEstado()   	{	return $this->getLink($this->getEstado());		}
	function getLinkAno() 		{	return $this->getLink($this->getAnoOpala()); 	}
	function getLinkDDD() 		{	return $this->getLink($this->getDDD());			}
	function getLinkFone() 		{	return $this->getLink($this->getFone());		}
	function getLinkDDDCel() 	{	return $this->getLink($this->getDDDCel());		}
	function getLinkCelular() 	{	return $this->getLink($this->getCelular());		}
	function getLinkDtCadastro(){	return $this->getLink($this->getDtCadastro());	}

	function getLink($mostra) {
	
       $lnk = sprintf("<a href='lst_detmembro.php?usr=%d'>%s</a>",$this->getUserid(),$mostra);
		return $lnk;
	
	}	

	function getUsuarios() {
	
           $usrs = array();
		   
		   $db = new BD();
		   
		   $sql = sprintf("select
		               userid,
					   username,
					   Nome,
					   Cidade,
					   Estado,
					   possuiopala,
					   anopala,
					   email
					   from
					   cad_usuario where aprovado = 'S' order by Nome");
		
			$db->Query($sql);
			
			while($db->Next()) {
					array_push($usrs,$db->Row);
				}	

			$db->Close();

			return $usrs;
		}	

	function getCadastrados() {
	
           $usrs = array();
		   
		   $db = new BD();
		   
		   $sql = sprintf("select
		               userid,
					   username,
					   Nome,
					   Cidade,
					   Estado,
					   possuiopala,
					   anopala,
					   email
					   from
					   cad_usuario where aprovado <> 'S' order by Nome");
		
			$db->Query($sql);
			
			while($db->Next()) {
					array_push($usrs,$db->Row);
				}	

			$db->Close();

			return $usrs;
		}	

	function getListaSms($Lista, $Associados, $NaoAssociados) {
	
           $usrs = array();

		   $db = new BD();

		   $sql = "select username,dddcel,celular,nome
								from cad_usuario c
								where 1=1
								and ifnull(dddcel,0) <> 0 and ifnull(celular,0) <> 0";
		   if ($Associados == 'S' && $NaoAssociados == 'N')
		   		$sql = $sql." and ifnull(aprovado,'N') ='S'";

		   if ($NaoAssociados == 'S' && $Associados == 'N')
		   		$sql = $sql." and ifnull(aprovado,'N') ='N'";

			if ($Lista == 2)
				$sql = $sql." and UPPER(TRIM(CIDADE)) = 'FRANCA'";
			if ($Lista == 3)
				$sql = $sql." and dddcel = 16 ";

			//echo($sql);
			$db->Query($sql);
			
			while($db->Next()) {
					array_push($usrs,$db->Row);
				}	

			$db->Close();

			return $usrs;
		}	

		
		
		function getRanking() {
	
           $usrs = array();
		   
		   $db = new BD();
		   
		   $sql = sprintf("select u.userid,u.nome,ifnull(p.pontos,0) pontos from
						cad_usuario u
						left outer join
						(select userid,sum(pontos) pontos
								from tb_pontos
								group by userid) p
						on
						u.userid = p.userid
						where
						u.aprovado = 'S'
						order by pontos desc,u.Nome");
		
			$db->Query($sql);
			
			while($db->Next()) {
					array_push($usrs,$db->Row);
				}	

			$db->Close();

			return $usrs;
		}	

	function getPontos($crt) {
	
           $usrs = array();
		   
		   $db = new BD();
		   
           if ($crt == 0) {
			   $sql = sprintf("select c.id,c.descricao,ifnull(sum(p.pontos),0) pontos
							 from
							tb_criterios c
							left outer join
							tb_pontos p
							on
							c.id = p.criterio
							and p.userid = %d
							group by c.id,c.descricao
							order by c.id",$this->getUserid());
		    }
			else {
			   $sql = sprintf("select c.id,c.descricao,ifnull(p.pontos,0) pontos,p.data,p.observacao
							 from
							tb_criterios c,
							tb_pontos p
							where
							c.id = p.criterio
							and p.userid = %d
							and p.criterio = %d
							order by c.id",$this->getUserid(),$crt);
			}
			
			$db->Query($sql);
			
			while($db->Next()) {
					array_push($usrs,$db->Row);
				}	

			$db->Close();

			return $usrs;
		}	

	function setPontos($criterio, $datapontos, $obs, $qtde ) {

		   $db = new BD();

		   $sql = sprintf("select sp_incluipontos(%d,%d,'%s','%s',%d)",
							$this->getUserid(),$criterio,$datapontos,$obs,$qtde);

			$db->Query($sql);

			$db->Close();

		}

	function LogUsuario($pUserid,$pOrigem, $pLogado) {

		$gi = geoip_open($_SERVER['DOCUMENT_ROOT']."/geoip/GeoLiteCity.dat",GEOIP_STANDARD);

   		$geoip = geoip_record_by_addr($gi,$_SERVER['REMOTE_ADDR']);
	
		   $db = new BD();
		   
           $sql = sprintf ("select count(*) qtde from log_usuario
            where
            ip = '%s'
            and sessionid = '%s'",$_SERVER['REMOTE_ADDR'],session_id());

           $db->Query($sql);

           $db->Next();
		   
 		   if ($db->getValue("qtde") == 0) {
				 $sql = sprintf ("insert into log_usuario
					(userid,datahora,origem,logado,ip,sessionid,cidade,estado,pais)
					values (%d,now(),'%s','%s','%s','%s','%s','%s','%s')",$pUserid,$pOrigem,$pLogado,$_SERVER['REMOTE_ADDR'],session_id(),$geoip->city,RetornaEstado($geoip->country_code,$geoip->region),$geoip->country_name);
			}
		   else {
				  $sql = sprintf("update log_usuario
							set userid = %d,
								origem = '%s',
								logado = '%s',
								qtde = qtde + 1
								where
								ip = '%s'
								and sessionid = '%s'",
								$pUserid,$pOrigem,$pLogado,$_SERVER['REMOTE_ADDR'],session_id());
		   }		   	

           $db->Exec($sql);

         	$db->Close();

		geoip_close($gi);

		}
}
function RetornaEstado($pais,$regiao) {
        require_once($_SERVER['DOCUMENT_ROOT']."/geoipregionvars.php");

     	return $GEOIP_REGION_NAME[$pais][$regiao];

	}

?>