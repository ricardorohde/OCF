<?php
// IMPORTANTE:
// - O SCRIPT A SEGUIR É FUNCIONAL APENAS EM PHP 5 PARA HOSPEDAGENS LINUX
// - O SOAP CLIENT DEVE ESTAR ATIVO

// Endereços do Pagamento Certo
$wsPagamentoCertoLocaweb = 'https://www.pagamentocerto.com.br/vendedor/vendedor.asmx?WSDL'; // Web Service para registro da transação
$urlPagamentoCertoLocaweb = 'https://www.pagamentocerto.com.br/pagamento/pagamento.aspx'; // URL para inicio da transação

// Montagem dos dados da transação

// Define os valores inicias de postagem
$chaveVendedor = '597b3bdb-4d81-4b00-aa60-7da332a9249d'; // Chave do vendedor
$urlRetornoLoja = 'http://www.opalaclubefranca.com.br/retornoTransacao.php'; // URL de retorno da loja

// Dados do comprador
$compradorNome = 'Alencar Mendes de Oliveira'; // Nome
$compradorEmail = 'alencar.mendes@yahoo.com.br'; // E-mail
$compradorCpf = '09876026836'; // CPF (sem formatação)
$compradorRg = '20753592'; // RG (sem formatação)
$compradorDdd = '16'; // DDD
$compradorTelefone = '81291661'; // Telefone
$compradorTipoPessoa = 'Fisica'; // Tipo de pessoa: Fisica / Juridica
$compradorRazaoSocial = ''; // Razão Social
$compradorCnpj = ''; // CNPJ (sem formatação)

// Dados de pagamento
$pagamentoModulo = 'Boleto'; // Módulo de pagamento
$pagamentoTipo = ''; // Tipo do módulo de pagamento

// Dados do pedido
$pedidoNumero = '1'; // Número do pedido (sem formatação)
$pedidoValorSubTotal = '100'; // Subtotal do pedido (sem formatação)
$pedidoValorFrete = '000'; // Valor do frete (sem formatação)
$pedidoValorAcrescimo = '000'; // Taxa de acréscimo (sem formatação)
$pedidoValorDesconto = '000'; // Taxa de desconto (sem formatação)
$pedidoValorTotal = '100'; // Total do pedido (sem formatação)

// Itens do pedido
// OBS: Para cada item do pedido o nó Item deverá ser replicado com seus respectivos nós e valores.
$pedidoItensItemCodProduto = '1'; // Código do produto
$pedidoItensItemDescProduto = 'teste'; // Descrição do produto
$pedidoItensItemQuantidade = '1'; // Quantidade do produto
$pedidoItensItemValorUnitario = '100'; // Valor unitário (sem formatação)
$pedidoItensItemValorTotal = '100'; // Valor total (Quantidade * Valor Unitário) (sem formatação)

//  Dados de cobrança do pedido
$pedidoCobrancaEndereco = 'R Americo Pizzo'; // Endereço do pedido
$pedidoCobrancaNumero = '4811'; // Número
$pedidoCobrancaBairro = 'JD Noemia'; // Bairro
$pedidoCobrancaCidade = 'Franca'; // Cidade
$pedidoCobrancaCep = '14403764'; // CEP
$pedidoCobrancaEstado = 'SP'; // Estado (sigla)


// ############# Inicio da Montagem do XML da transação #############

// Cabeçalho
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

            //OBS: Para cada item do pedido o nó Item deverá ser replicado com seus respectivos nós e valores.

            //Item do pedido
            $xmlTransacao = $xmlTransacao . '<Item>';
                $xmlTransacao = $xmlTransacao . '<CodProduto>' . $pedidoItensItemCodProduto . '</CodProduto>';
                $xmlTransacao = $xmlTransacao . '<DescProduto>' . $pedidoItensItemDescProduto . '</DescProduto>';
                $xmlTransacao = $xmlTransacao . '<Quantidade>' . $pedidoItensItemQuantidade . '</Quantidade>';
                $xmlTransacao = $xmlTransacao . '<ValorUnitario>' . $pedidoItensItemValorUnitario . '</ValorUnitario>';
                $xmlTransacao = $xmlTransacao . '<ValorTotal>' . $pedidoItensItemValorTotal . '</ValorTotal>';
            $xmlTransacao = $xmlTransacao . '</Item>';

        $xmlTransacao = $xmlTransacao . '</Itens>';

       // Dados de cobrança do pedido
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

// ############# Fim da Montagem do XML da transação #############

// ############# Inicio do registro da transação #############

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

// Postagem dos parâmetros
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

// Resgata os dados iniciais do retorno da transação
$nodeCodRetornoInicio = $objDom->getElementsByTagName('CodRetorno')->item(0);
$CodRetornoInicio = $nodeCodRetornoInicio->nodeValue;

$nodeMensagemRetornoInicio = $objDom->getElementsByTagName('MensagemRetorno')->item(0);
$MensagemRetorno = $nodeMensagemRetornoInicio->nodeValue;

// Verifica se o registro da transação foi feito com sucesso
if ($CodRetornoInicio == '0') {

	// Resgata o id e a mensagem da transação
	$nodeIdTransacao = $objDom->getElementsByTagName('IdTransacao')->item(0);
	$IdTransacao = $nodeIdTransacao->nodeValue;

	$nodeCodigoRef = $objDom->getElementsByTagName('Codigo')->item(0);
	$Codigo = $nodeCodigoRef->nodeValue;

	// Inicia a transação
	header('location: ' . $urlPagamentoCertoLocaweb . '?tdi=' . $IdTransacao);
	exit();

// Em caso de erro no proceesso
} else {

    // Exibe a mensagem de erro
    echo 	'<b>Erro: (' . utf8_decode($CodRetornoInicio) . ') ' . utf8_decode($MensagemRetorno) . '</b>';
}
// ############# Fim do registro da transação #############
?>