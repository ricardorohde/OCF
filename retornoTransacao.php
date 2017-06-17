<!--
'-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#
' Kit de Integração Pagamento Certo
' Versão: 1.0
' Arquivo: retornoTransacao.php
' Função: Processa o retorno da transação no Pagamento Certo
'-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#-#
-->
<?
// Endereços do Pagamento Certo
$wsPagamentoCertoLocaweb = "https://www.pagamentocerto.com.br/vendedor/vendedor.asmx?WSDL"; // Web Service para consulta da transação

// Define os valores de retorno
$chaveVendedor = '597b3bdb-4d81-4b00-aa60-7da332a9249d'; // Chave do vendedor
$idTransacao = $_REQUEST['tdi']; // ID da transação 

// Verifica se o ID da transação foi postado
if (trim($idTransacao) != '') {

	class Parameters { }

	// Inicializa o cliente SOAP
	$soap = @new SoapClient($wsPagamentoCertoLocaweb, array(
			'trace' => true,
			'exceptions' => true,
			'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
			'connection_timeout' => 1000
	));

	// Postagem dos parâmetros
	$parms = new Parameters();
	$parms->chaveVendedor = utf8_encode($chaveVendedor);
	$parms->idTransacao = utf8_encode($idTransacao);

	// Resgata o XML de retorno do processo
	$XMLresposta = $soap->ConsultaTransacao($parms);
	$XMLresposta = $XMLresposta->ConsultaTransacaoResult;

	// Carrega o XML
	$objDom = new DomDocument();
	$loadDom = $objDom->loadXML($XMLresposta);

	// Resgata os dados iniciais do retorno da transação
	$nodeCodRetornoConsulta = $objDom->getElementsByTagName('CodRetorno')->item(0);
	$CodRetornoConsulta = $nodeCodRetornoConsulta->nodeValue;

	$nodeMensagemRetornoConsulta = $objDom->getElementsByTagName('MensagemRetorno')->item(0);
	$MensagemRetornoConsulta = $nodeMensagemRetornoConsulta->nodeValue;

	if ($CodRetornoConsulta == '15') {


		// Resgata os dados da transação
		$nodeIdTransacao = $objDom->getElementsByTagName('IdTransacao')->item(0);
		$IdTransacao = $nodeIdTransacao->nodeValue;

		$nodeCodigoTransacao = $objDom->getElementsByTagName('Codigo')->item(0);
		$Codigo = $nodeCodigoTransacao->nodeValue;

		$nodeDataTransacao = $objDom->getElementsByTagName('Data')->item(0);
		$Data = $nodeDataTransacao->nodeValue;

		// Resgata os dados do comprador no Pagamento Certo
		$nodeCompradorNome = $objDom->getElementsByTagName('Nome')->item(0);
		$Nome = $nodeCompradorNome->nodeValue;

		$nodeCompradorEmail = $objDom->getElementsByTagName('Email')->item(0);
		$Email = $nodeCompradorEmail->nodeValue;

		$nodeCompradorCpf = $objDom->getElementsByTagName('Cpf')->item(0);
		$Cpf = $nodeCompradorCpf->nodeValue;

		$nodeCompradorTipoPessoa = $objDom->getElementsByTagName('TipoPessoa')->item(0);
		$TipoPessoa = $nodeCompradorTipoPessoa->nodeValue;

		$nodeCompradorRazaoSocial = $objDom->getElementsByTagName('RazaoSocial')->item(0);
		$RazaoSocial = $nodeCompradorRazaoSocial->nodeValue;

		$nodeCompradorCNPJ = $objDom->getElementsByTagName('Cnpj')->item(0);
		$Cnpj = $nodeCompradorCNPJ->nodeValue;


		// Resgata os dados do pagamento
		$nodeMensagemModuloPagamento = $objDom->getElementsByTagName('Modulo')->item(0);
		$Modulo = $nodeMensagemModuloPagamento->nodeValue;

		$nodeMensagemTipoModuloPagamento = $objDom->getElementsByTagName('Tipo')->item(0);
		$Tipo = $nodeMensagemTipoModuloPagamento->nodeValue;

		$nodeProcessadoPagamento = $objDom->getElementsByTagName('Processado')->item(0);
		$Processado = $nodeProcessadoPagamento->nodeValue;

		$nodeMensagemRetornoPagamento = $objDom->getElementsByTagName('MensagemRetorno')->item(0);
		$MensagemRetorno = $nodeMensagemRetornoPagamento->nodeValue;


		// Resgata os dados do pedido
		$nodeCodigoPedido = $objDom->getElementsByTagName('Numero')->item(0);
		$Numero = $nodeCodigoPedido->nodeValue;

		$nodeValorTotal = $objDom->getElementsByTagName('ValorTotal')->item(0);
		$ValorTotal = $nodeValorTotal->nodeValue;


		// Exibe os dados de retorno da transação
		echo '<b>Dados da transação</b><br>';
		echo 'ID da transação: ' . utf8_decode($IdTransacao) . '<br>';
		echo 'Código da transação: ' . utf8_decode($Codigo) . '<br>';
		echo 'Data da transação: ' . utf8_decode($Data) . '<br>';
		echo 'Código de retorno da transação: ' . utf8_decode($CodRetornoConsulta) . '<br>';
		echo 'Mensagem de retorno da transação: ' . utf8_decode($MensagemRetornoConsulta) . '<br>';

		echo '<br>';

		// Exibe os dados de retorno do comprador no Pagamento Certo
		echo '<b>Dados do comprador no Pagamento Certo</b><br>';
		echo 'Nome: ' . utf8_decode($Nome) . '<br>';
		echo 'E-mail: ' . utf8_decode($Email) . '<br>';
		echo 'CPF: ' . utf8_decode($Cpf) . '<br>';
		echo 'Tipo de pessoa: ' . utf8_decode($TipoPessoa) . '<br>';
		if (trim(nodeCompradorRazaoSocial) != '') { 
			echo 'Razão Social: ' . utf8_decode($RazaoSocial) . '<br>';
		}
		if (trim(nodeCompradorCNPJ) != '') {
			echo 'CNPJ: ' . $Cnpj . '<br>';
		}

		echo '<br>';

		// Exibe os dados de retorno do pagamento
		echo '<b>Dados do pagamento</b><br>';
		echo 'Módulo do pagamento: ' . utf8_decode($Modulo) . '<br>';
		echo 'Tipo de pagamento: ' . utf8_decode($Tipo) . '<br>';
		echo 'Processado: ' . utf8_decode($Processado) . '<br>';
		echo 'Mensagem de retorno: ' . utf8_decode($MensagemRetorno) . '<br>';

		echo '<br>';

		// Exibe os dados de retorno do pedido
		echo '<b>Dados do pedido</b><br>';
		echo 'Número do pedido: ' . utf8_decode($Numero) . '<br>';
		echo 'Total do pedido: ' . utf8_decode($ValorTotal) . '<br>';

	} else {

		// Exibe a mensagem de erro
		echo 	'<b>Erro: (' . utf8_decode($CodRetornoConsulta) . ') ' . utf8_decode($MensagemRetornoConsulta) . '</b>';
		exit();

	}


} else {

    // Exibe a mensagem de erro
    echo '<b>Erro: ID da transação não informado.</b>';
	exit();

}
?>