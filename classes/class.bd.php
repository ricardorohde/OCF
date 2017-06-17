<?php
/*
	BD - Classe de acesso ao banco de dados
	Descri��o: Executa opera��es no banco de dados
	Desenvolvido: Alencar
	Data: 28/01/2006
*/
class BD
{
 
		var $Link = "";
		var $ResultSet = "";
		var $Row = "";
		
function BD () { //Construtor da classe

     $this->Conecta();

}
/*
mysql://be9f415ede8850:4b611055@us-cdbr-iron-east-03.cleardb.net/heroku_1bdeda7a0b68034?reconnect=true
*/
function Conecta() {
	
			$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

			$server = $url["host"];
			$username = $url["user"];
			$password = $url["pass"];
			$db = substr($url["path"], 1);

			$this->Link = new mysqli($server, $username, $password, $db);
			
			if ($this->Link->connect_errno)
				die('Erro BD_Conecta: '	 ."<br>". $this->Link.connect_errno.' '.$this->Link.connect_error); 
			}

//	define("SET CHARACTER SET ascii");
//	define("SET COLLATION_CONNECTION='ascii_general_ci'");

}
/*

*/
function Close() {
	
//   $this->Free();

/*   if ($this->Link != NULL)
	   mysql_close($this->Link); */

}

/*

*/
function Query ($strsql) {
	 
     $this->GravaLog($strsql);
	 
     $this->ResultSet = $this->Link->query($strsql)
	 				or die('\nErro BD_Query: ' . $this->Link->errno . " " . $this->Link->error); 

//	 return $this->Fetch(); 
}

/*

*/
function Exec ($strsql) {

     $this->GravaLog($strsql);
//	 echo ($strsql)."\n";
	 
     $this->ResultSet = $this->Query($strsql);

//	 return $this->Fetch(); 
}

/*


*/
	function Fetch() { //Retorna matriz de resultados

		return $this->ResultSet->fetch_assoc($this->ResultSet);

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
		 	 $this->ResultSet->free_result();

		 return;
		 
	}
/*

*/
	function NumRows() { //Retorna o N�mero de linhas do ResultSet

       if ($this->ResultSet)
    	   return $this->ResultSet->num_rows();
	   else
	   	   return 0;

	}

	function getInsertID() { //Retorno o �ltimo insert_id gerado

	   return $this->Link->insert_id ($this->Link);
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
	
	   
       $this->ResultSet = $this->Query($sqllog);

       //$this->Free();
	      
	}
}
?>
