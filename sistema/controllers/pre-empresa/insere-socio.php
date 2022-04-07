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
use App\DAO\ClienteUsuarioDAO;

include __DIR__ . '/../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];

$empresasId = $_POST['pre_empresa_id'];
$usuariosId = $_POST['vendedor_id'];

$caminhoPastaEmpresa = $_SERVER['DOCUMENT_ROOT'] . '/grupobfiles/empresas/' . $empresasId;

if (file_exists($caminhoPastaEmpresa) == false) {
    $arquivoEmpresa = new ArquivoEmpresa();
    $retorno = $arquivoEmpresa->criaPastasPadraoEmpresa($empresasId);
}

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

$clienteDao = new ClienteDAO();
$retorno = $clienteDao->insertCliente($cliente);
$clienteId = $retorno['cliente_id'];

if ($retorno == false) {
    setcookie("insercaoSocio", "false", time()+2, '/');
    setcookie("mensagemSocio", "Falha ao inserir o sócio.", time()+2, '/');
    header("Location: " . $pasta . "/pipedrive-socios.php");
    die();
}

$clienteUsuarioDao = new ClienteUsuarioDAO();
$clienteUsuarioDao->insereClienteUsuario($clienteId, $usuariosId);

$dao = new PreEmpresaDAO();
$retorno = $dao->insereSocioPreEmpresa($clienteId, $empresasId, $_POST['porcentagem_societaria']);

if ($retorno == false) {
    setcookie("insercaoSocio", "false", time()+2, '/');
    setcookie("mensagemSocio", "Falha ao sócio a empresa.", time()+2, '/');
    header("Location: " . $pasta . "/pipedrive-socios.php");
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
    setcookie("insercaoSocio", "false", time()+2, '/');
    setcookie("mensagemSocio", "Falha ao inserir os dados do documento.", time()+2, '/');
    header("Location: " . $pasta . "/pipedrive-socios.php");
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
    setcookie("insercaoSocio", "false", time()+2, '/');
    setcookie("mensagemSocio", "Falha ao inserir o endereço.", time()+2, '/');
    header("Location: " . $pasta . "/pipedrive-socios.php");
    die();
}

setcookie("insercaoSocio", "true", time()+2, '/');
setcookie("mensagemSocio", "Sucesso ao inserir o sócio.", time()+2, '/');
header("Location: " . $pasta . "/pipedrive-socios.php");
die();
