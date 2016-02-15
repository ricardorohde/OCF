<?php
// IMPORTANTE:
// - O SCRIPT A SEGUIR � FUNCIONAL APENAS EM PHP 5 PARA HOSPEDAGENS LINUX
// - O SOAP CLIENT DEVE ESTAR ATIVO

// Endere�os do Pagamento Certo
$wsPagamentoCertoLocaweb = 'https://www.pagamentocerto.com.br/vendedor/vendedor.asmx?WSDL'; // Web Service para registro da transa��o
$urlPagamentoCertoLocaweb = 'https://www.pagamentocerto.com.br/pagamento/pagamento.aspx'; // URL para inicio da transa��o

// Montagem dos dados da transa��o

// Define os valores inicias de postagem
$chaveVendedor = '597b3bdb-4d81-4b00-aa60-7da332a9249d'; // Chave do vendedor
$urlRetornoLoja = 'http://www.opalaclubefranca.com.br/retornoTransacao.php'; // URL de retorno da loja

// Dados do comprador
$compradorNome = 'Alencar Mendes de Oliveira'; // Nome
$compradorEmail = 'alencar.mendes@yahoo.com.br'; // E-mail
$compradorCpf = '09876026836'; // CPF (sem formata��o)
$compradorRg = '20753592'; // RG (sem formata��o)
$compradorDdd = '16'; // DDD
$compradorTelefone = '81291661'; // Telefone
$compradorTipoPessoa = 'Fisica'; // Tipo de pessoa: Fisica / Juridica
$compradorRazaoSocial = ''; // Raz�o Social
$compradorCnpj = ''; // CNPJ (sem formata��o)

// Dados de pagamento
$pagamentoModulo = 'Boleto'; // M�dulo de pagamento
$pagamentoTipo = ''; // Tipo do m�dulo de pagamento

// Dados do pedido
$pedidoNumero = '1'; // N�mero do pedido (sem formata��o)
$pedidoValorSubTotal = '100'; // Subtotal do pedido (sem formata��o)
$pedidoValorFrete = '000'; // Valor do frete (sem formata��o)
$pedidoValorAcrescimo = '000'; // Taxa de acr�scimo (sem formata��o)
$pedidoValorDesconto = '000'; // Taxa de desconto (sem formata��o)
$pedidoValorTotal = '100'; // Total do pedido (sem formata��o)

// Itens do pedido
// OBS: Para cada item do pedido o n� Item dever� ser replicado com seus respectivos n�s e valores.
$pedidoItensItemCodProduto = '1'; // C�digo do produto
$pedidoItensItemDescProduto = 'teste'; // Descri��o do produto
$pedidoItensItemQuantidade = '1'; // Quantidade do produto
$pedidoItensItemValorUnitario = '100'; // Valor unit�rio (sem formata��o)
$pedidoItensItemValorTotal = '100'; // Valor total (Quantidade * Valor Unit�rio) (sem formata��o)

//  Dados de cobran�a do pedido
$pedidoCobrancaEndereco = 'R Americo Pizzo'; // Endere�o do pedido
$pedidoCobrancaNumero = '4811'; // N�mero
$pedidoCobrancaBairro = 'JD Noemia'; // Bairro
$pedidoCobrancaCidade = 'Franca'; // Cidade
$pedidoCobrancaCep = '14403764'; // CEP
$pedidoCobrancaEstado = 'SP'; // Estado (sigla)


// ############# Inicio da Montagem do XML da transa��o #############

// Cabe�alho
$xmlTransacao = '<?xml version="1.0" encoding="utf-8" ?>';
$xmlTransacao = $xmlTransacao . '<LocaWeb>';

    // Dados do comprador
    $xmlTransacao = $xmlTransacao . '<Comprador>';
        $xmlTransacao = $xmlTransacao . '<Nome>' . $compradorNome . '</Nome>';
        $xmlTransacao = $xmlTransacao . '<Email>' . $compradorEmail . '</Email>';
        $xmlTransacao = $xmlTransacao . '<Cpf>' . $compradorCpf . '</Cpf>';
        if (trim($compradorRg) != '') {
            $xmlTransacao = $xmlTransacao . '<Rg>' . $compradorRg . '</Rg>';
        }
        if (trim($compradorDdd) != '') {
            $xmlTransacao = $xmlTransacao . '<Ddd>' . $compradorDdd . '</Ddd>';
		}
        if (trim($compradorTelefone) != '') {
            $xmlTransacao = $xmlTransacao . '<Telefone>' . $compradorTelefone . '</Telefone>';
		}
        if (trim($compradorTipoPessoa) == 'Juridica') {
            $xmlTransacao = $xmlTransacao . '<TipoPessoa>' . $compradorTipoPessoa . '</TipoPessoa>';
            $xmlTransacao = $xmlTransacao . '<RazaoSocial>' . $compradorRazaoSocial . '</RazaoSocial>';
            $xmlTransacao = $xmlTransacao . '<Cnpj>' . $compradorCnpj . '</Cnpj>';
        } else {
            $xmlTransacao = $xmlTransacao . '<TipoPessoa>' . $compradorTipoPessoa . '</TipoPessoa>';
		}
    $xmlTransacao = $xmlTransacao . '</Comprador>';

//    Dados do pagamento
    $xmlTransacao = $xmlTransacao . '<Pagamento>';
        $xmlTransacao = $xmlTransacao . '<Modulo>' . $pagamentoModulo . '</Modulo>';
        $xmlTransacao = $xmlTransacao . '<Tipo>' . $pagamentoTipo . '</Tipo>';
    $xmlTransacao = $xmlTransacao . '</Pagamento>';

    // Dados do pedido
    $xmlTransacao = $xmlTransacao . '<Pedido>';

       // Dados gerais do pedido
        $xmlTransacao = $xmlTransacao . '<Numero>' . $pedidoNumero . '</Numero>';
        $xmlTransacao = $xmlTransacao . '<ValorSubTotal>' . $pedidoValorSubTotal . '</ValorSubTotal>';
        $xmlTransacao = $xmlTransacao . '<ValorFrete>' . $pedidoValorFrete . '</ValorFrete>';
        $xmlTransacao = $xmlTransacao . '<ValorAcrescimo>' . $pedidoValorAcrescimo . '</ValorAcrescimo>';
        $xmlTransacao = $xmlTransacao . '<ValorDesconto>' . $pedidoValorDesconto . '</ValorDesconto>';
        $xmlTransacao = $xmlTransacao . '<ValorTotal>' . $pedidoValorTotal . '</ValorTotal>';

        // Itens do pedido
        $xmlTransacao = $xmlTransacao . '<Itens>';

            //OBS: Para cada item do pedido o n� Item dever� ser replicado com seus respectivos n�s e valores.

            //Item do pedido
            $xmlTransacao = $xmlTransacao . '<Item>';
                $xmlTransacao = $xmlTransacao . '<CodProduto>' . $pedidoItensItemCodProduto . '</CodProduto>';
                $xmlTransacao = $xmlTransacao . '<DescProduto>' . $pedidoItensItemDescProduto . '</DescProduto>';
                $xmlTransacao = $xmlTransacao . '<Quantidade>' . $pedidoItensItemQuantidade . '</Quantidade>';
                $xmlTransacao = $xmlTransacao . '<ValorUnitario>' . $pedidoItensItemValorUnitario . '</ValorUnitario>';
                $xmlTransacao = $xmlTransacao . '<ValorTotal>' . $pedidoItensItemValorTotal . '</ValorTotal>';
            $xmlTransacao = $xmlTransacao . '</Item>';

        $xmlTransacao = $xmlTransacao . '</Itens>';

       // Dados de cobran�a do pedido
        $xmlTransacao = $xmlTransacao . '<Cobranca>';
		$xmlTransacao = $xmlTransacao . '<Endereco>' . $pedidoCobrancaEndereco . '</Endereco>';
		$xmlTransacao = $xmlTransacao . '<Numero>' . $pedidoCobrancaNumero . '</Numero>';
		$xmlTransacao = $xmlTransacao . '<Bairro>' . $pedidoCobrancaBairro . '</Bairro>';
		$xmlTransacao = $xmlTransacao . '<Cidade>' . $pedidoCobrancaCidade . '</Cidade>';
		$xmlTransacao = $xmlTransacao . '<Cep>' . $pedidoCobrancaCep . '</Cep>';
		$xmlTransacao = $xmlTransacao . '<Estado>' . $pedidoCobrancaEstado . '</Estado>';
        $xmlTransacao = $xmlTransacao . '</Cobranca>';

    $xmlTransacao = $xmlTransacao . '</Pedido>';

$xmlTransacao = $xmlTransacao . '</LocaWeb>';

// ############# Fim da Montagem do XML da transa��o #############

// ############# Inicio do registro da transa��o #############

class Parameters { }
if (!isset($HTTP_RAW_POST_DATA)){
    $HTTP_RAW_POST_DATA = file_get_contents('php://input');
}
// Inicializa o cliente SOAP
$soap = @new SoapClient($wsPagamentoCertoLocaweb, array(
        'trace' => true,
        'exceptions' => true,
        'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
        'connection_timeout' => 1000
));

// Postagem dos par�metros
$parms = new Parameters();
$parms->chaveVendedor = utf8_encode($chaveVendedor);
$parms->urlRetorno = utf8_encode($urlRetornoLoja);
$parms->xml = utf8_encode($xmlTransacao);


// Resgata o XML de retorno do processo
$XMLresposta = $soap->IniciaTransacao($parms);
$XMLresposta = $XMLresposta->IniciaTransacaoResult;

// Carrega o XML
$objDom = new DomDocument();
$loadDom = $objDom->loadXML($XMLresposta);

// Resgata os dados iniciais do retorno da transa��o
$nodeCodRetornoInicio = $objDom->getElementsByTagName('CodRetorno')->item(0);
$CodRetornoInicio = $nodeCodRetornoInicio->nodeValue;

$nodeMensagemRetornoInicio = $objDom->getElementsByTagName('MensagemRetorno')->item(0);
$MensagemRetorno = $nodeMensagemRetornoInicio->nodeValue;

// Verifica se o registro da transa��o foi feito com sucesso
if ($CodRetornoInicio == '0') {

	// Resgata o id e a mensagem da transa��o
	$nodeIdTransacao = $objDom->getElementsByTagName('IdTransacao')->item(0);
	$IdTransacao = $nodeIdTransacao->nodeValue;

	$nodeCodigoRef = $objDom->getElementsByTagName('Codigo')->item(0);
	$Codigo = $nodeCodigoRef->nodeValue;

	// Inicia a transa��o
	header('location: ' . $urlPagamentoCertoLocaweb . '?tdi=' . $IdTransacao);
	exit();

// Em caso de erro no proceesso
} else {

    // Exibe a mensagem de erro
    echo 	'<b>Erro: (' . utf8_decode($CodRetornoInicio) . ') ' . utf8_decode($MensagemRetorno) . '</b>';
}
// ############# Fim do registro da transa��o #############
?>