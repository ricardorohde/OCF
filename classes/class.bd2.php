<?php
/*
	BD - Classe de acesso ao banco de dados
	Descri��o: Executa opera��es no banco de dados
	Desenvolvido: Alencar
	Data: 28/01/2006
*/
class BD2
{
 
		var $Link = "";
		var $ResultSet = "";
		var $Row = "";

function BD2($strBD) {
     $this->Conecta($strBD);
}

/*

*/
function Conecta($strBD) {
	
			$server = '107.180.21.14'; //$url["host"];
			$username = 'opalaclubefranca';
			$password = 'Jf?lOi~_a4%^';
			$db = 'opalaclubefranca';

			$this->Link = new mysqli($server, $username, $password, $db);
			
			if ($this->Link->connect_errno)
				die('Erro BD_Conecta: '	 ."<br>". $this->Link.connect_errno.' '.$this->Link.connect_error); 
				

//	define("SET CHARACTER SET ascii");
//	define("SET COLLATION_CONNECTION='ascii_general_ci'");

}

/*

*/
function Close() {
	
//   $this->Free();

/*   if ($this->Link != NULL)
	   mysqli_close($this->Link); */

}

/*

*/
function Query ($strsql) {
	 
     $this->GravaLog($strsql);
	 
     $this->ResultSet = mysqli_query($this->Link,$strsql)
	 				or die('\nErro BD_Query: ' . mysqli_error($this->Link)); 

//	 return $this->Fetch(); 
}

/*

*/
function Exec ($strsql) {

     $this->GravaLog($strsql);
//	 echo ($strsql)."\n";
	 
     $this->ResultSet = mysqli_query($strsql,$this->Link)
	 				or die('\nErro BD_Exec: ' . mysqli_error($this->Link)); 

//	 return $this->Fetch(); 
}

/*


*/
	function Fetch() { //Retorna matriz de resultados

		return mysqli_fetch_assoc($this->ResultSet);

	}

/*


*/
	function Next() { //Carrega Pr�ximo registro da tabela

		if ($this->Row = $this->Fetch())
			return TRUE;
		else
			return FALSE;	

	}
/*


*/
	function getValue($ColName) { //Retorna o valor de uma coluna

		return $this->Row[$ColName];

	}

/*

*/
	function Free() { //Libera o ResultSet
	 
 	     if ($this->NumRows() > 0)
		 	 mysqli_free_result($this->ResultSet);

		 return;
		 
	}
/*

*/
	function NumRows() { //Retorna o N�mero de linhas do ResultSet

       if ($this->ResultSet)
    	   return mysqli_num_rows($this->ResultSet);
	   else
	   	   return 0;

	}

	function getInsertID() { //Retorno o �ltimo insert_id gerado

	   return mysqli_insert_id ($this->Link);
	}

/*
	Func�o: BD_GravaLog
	Descri��o: Gera log dos comandos sql executados no banco
	Desenvolvido: Alencar
	Data: 28/01/2006
*/

	function GravaLog($strsql) {

       return;

       $sqllog = sprintf ('insert into log_bolao
	   						(datahora,userid,strsql,programa)
							values ("%s",%d,"%s","%s")',date("Y-m-d H-i-s"),$_SESSION['userid'],		$strsql,$_SERVER['SCRIPT_NAME']);
	
	   
       $this->ResultSet = mysqli_query($sqllog,$this->Link)
	 				or die('\nErro incluindo registro no log: ' . mysqli_error($this->Link)); 

       //$this->Free();
	      
	}
}
?>
