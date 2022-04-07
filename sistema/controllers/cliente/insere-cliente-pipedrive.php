<?php
use App\Arquivo\ArquivoEmpresa;
use App\Arquivo\UploadArquivo;
use App\Entidade\Documento;
use App\DAO\DocumentoDAO;
use App\Model\User\Cliente;
use App\Helper\Helpers;
use App\DAO\ClienteDAO;
use App\Entidade\EnderecoCliente;
use App\DAO\EnderecoClienteDAO;
use App\DAO\PreEmpresaDAO;
use App\DAO\EmpresasPlanosDAO;

include __DIR__ . '/../../../vendor/autoload.php';

$clienteId = $_POST['id_cliente'];
$empresasId = $_POST['pre_empresa_id'];

session_start();
$pasta = '../../' . $_SESSION['pasta'];

$arquivoEmpresa = new ArquivoEmpresa();
$retorno = $arquivoEmpresa->criaPastasPadraoEmpresa($empresasId);

$upload = new UploadArquivo();
$caminhoPastaAbertura = $_SERVER['DOCUMENT_ROOT'] . '/grupobfiles/empresas/' . $empresasId . '/abertura';

$extensaoArquivo = pathinfo($_FILES['docPessoal']['name'], PATHINFO_EXTENSION);
$nomeArquivoDocumentoPessoal = str_replace(' ', '_', $_POST['nome']) . '-doc' . '.' . $extensaoArquivo;
$upload->enviaArquivoNomeFormatado($_FILES['docPessoal'], $caminhoPastaAbertura, $nomeArquivoDocumentoPessoal);

$extensaoArquivo = pathinfo($_FILES['iptu']['name'], PATHINFO_EXTENSION);
$nomeArquivo = str_replace(' ', '_', $_POST['nome']) . '-iptu' . '.' . $extensaoArquivo;
$upload->enviaArquivoNomeFormatado($_FILES['iptu'], $caminhoPastaAbertura, $nomeArquivo);

$extensaoArquivo = pathinfo($_FILES['certidao_casamento']['name'], PATHINFO_EXTENSION);
$nomeArquivo = str_replace(' ', '_', $_POST['nome']) . '-casamento' . '.' . $extensaoArquivo;
$upload->enviaArquivoNomeFormatado($_FILES['certidao_casamento'], $caminhoPastaAbertura, $nomeArquivo);

$extensaoArquivo = pathinfo($_FILES['cartidao_casamento_averbada']['name'], PATHINFO_EXTENSION);
$nomeArquivo = str_replace(' ', '_', $_POST['nome']) . '-averbada' . '.' . $extensaoArquivo;
$upload->enviaArquivoNomeFormatado($_FILES['cartidao_casamento_averbada'], $caminhoPastaAbertura, $nomeArquivo);

$extensaoArquivo = pathinfo($_FILES['comprovante_residencia']['name'], PATHINFO_EXTENSION);
$nomeArquivo = str_replace(' ', '_', $_POST['nome']) . '-residencia' . '.' . $extensaoArquivo;
$upload->enviaArquivoNomeFormatado($_FILES['comprovante_residencia'], $caminhoPastaAbertura, $nomeArquivo);

$socioAdministrador = (array_key_exists('is_socio_administrador', $_POST) && $_POST['is_socio_administrador'] == '1') ? 1 : 0;
$profissao = (array_key_exists('outra_profissao', $_POST)) ? $_POST['outra_profissao'] : $_POST['profissao'];

$cliente = new Cliente(
    Helpers::formataCpfBd($_POST['cpf']),
    $_POST['nome'],
    $_POST['nome_mae'],
    $_POST['sexo'],
    $_POST['situacao_cadastral'],
    $_POST['email'],
    $_POST['data_nascimento'],
    $_POST['crm'],
    $_POST['ies_id'],
    Helpers::formataTelefoneBd($_POST['telefone_comercial']),
    Helpers::formataTelefoneBd($_POST['telefone_celular']),
    $_POST['estado_civil'],
    $_POST['regime_casamento'],
    $profissao,
    $socioAdministrador
);

$cliente->setId($clienteId);

$clienteDao = new ClienteDAO();
$retorno = $clienteDao->confirmaClientePipedrive($cliente);

if ($retorno == false) {
    setcookie("confirmacaoCliente", "false", time()+2, '/');
    setcookie("mensagemConfirmacao", "Falha ao confirmar o cliente.", time()+2, '/');
    header("Location: " . $pasta . "/pipedrive-cliente.php");
    die();
}

$documento = new Documento();
$documento->setClienteId($clienteId);
$documento->setTipoDocumento($_POST['tipo_documento']);
$documento->setDataEmissao($_POST['data_emissao']);
$documento->setNumero($_POST['numero_documento']);
$documento->setValidade($_POST['documento_validade']);
$documento->setUf($_POST['documento_uf']);
$documento->setOrgaoExpedidor($_POST['documento_orgao']);
$documento->setNaturalidade($_POST['documento_naturalidade']);
$documento->setCaminho($caminhoPastaAbertura . '/abertura/' . $nomeArquivoDocumentoPessoal);

$documentoDAO = new DocumentoDAO();
$retorno = $documentoDAO->insereDocumentoCliente($documento);

if ($retorno['resultado'] == false) {
    setcookie("confirmacaoCliente", "false", time()+2, '/');
    setcookie("mensagemConfirmacao", "Falha ao salvar os dados do documento pessoal.", time()+2, '/');
    header("Location: " . $pasta . "/pipedrive-cliente.php");
    die();
}

$enderecoCliente = new EnderecoCliente(
    $clienteId,
    $_POST['numero_iptu'],
	str_replace("-","",$_POST['cep']),
    $_POST['logradouro'],
    $_POST['numero_endereco'],
    $_POST['bairro'],
    $_POST['cidade'],
    $_POST['uf_endereco'],
    $_POST['complemento']
);

$enderecoClienteDao = new EnderecoClienteDAO();
$retorno = $enderecoClienteDao->insereEnderecoCliente($enderecoCliente);

if ($retorno == false) {
    setcookie("confirmacaoCliente", "false", time()+2, '/');
    setcookie("mensagemConfirmacao", "Falha ao salvar os dados do endereço.", time()+2, '/');
    header("Location: " . $pasta . "/pipedrive-cliente.php");
    die();
}

$empresasPlanosDAO = new EmpresasPlanosDAO();

foreach ($_POST['planos'] as $chave => $plano) {
    $empresasPlanosDAO->setPlano($plano, $empresasId);
}

$dao = new PreEmpresaDAO();
$retorno = $dao->confirmaPreEmpresaPipedrive($_POST['tipo_societario'], $_POST['nome_1'], $_POST['nome_2'], $_POST['nome_3'], Helpers::formataDataBd($_POST['primeira_mensalidade']), $empresasId);

if ($retorno == false) {
    setcookie("confirmacaoCliente", "false", time()+2, '/');
    setcookie("mensagemConfirmacao", "Falha ao confirmar a Pré-Empresa", time()+2, '/');
    header("Location: " . $pasta . "/pipedrive-cliente.php");
    die();
}

$dao->updateSocioPreEmpresa($clienteId, $empresasId, $_POST['porcentagem_societaria']);

setcookie("confirmacaoCliente", "true", time()+2, '/');
setcookie("mensagemConfirmacao", "Sucesso ao confirmar o cadastro do Cliente", time()+2, '/');
header("Location: " . $pasta . "/pipedrive-clientes.php");
die();
