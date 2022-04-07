<?php
use App\Arquivo\ArquivoEmpresa;
use App\Model\User\Cliente;
use App\Helper\Helpers;
use App\DAO\ClienteDAO;
use App\DAO\PreEmpresaDAO;
use App\DAO\EmpresasPlanosDAO;

include __DIR__ . '/../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];

$empresasId = $_POST['pre_empresa_id'];
$clienteId = $_POST['id_cliente'];
$vendedorId = $_POST['vendedorId'];

$caminhoPastaEmpresa = $_SERVER['DOCUMENT_ROOT'] . '/grupobfiles/empresas/' . $empresasId;

if (file_exists($caminhoPastaEmpresa) == false) {
    $arquivoEmpresa = new ArquivoEmpresa();
    $retorno = $arquivoEmpresa->criaPastasPadraoEmpresa($empresasId);
}

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
    setcookie("insercaoClienteOutroEscritorio", "false", time()+2, '/');
    setcookie("mensagemClienteOutroEscritorio", "Falha ao confirmar os dados do cliente", time()+2, '/');
    header("Location: " . $pasta . "/pipedrive-empresa.php?clienteId=" . $clienteId);
    die();
}

$dao = new PreEmpresaDAO();
$retorno = $dao->confirmaPreEmpresaConstituidaPipedrive(
    $_POST['tipo_societario'],
    Helpers::formataCnpjBd($_POST['cnpj']),
    Helpers::formataDataBd($_POST['primeira_mensalidade']),
    $empresasId
);

if ($retorno == false) {
    setcookie("insercaoClienteOutroEscritorio", "false", time()+2, '/');
    setcookie("mensagemClienteOutroEscritorio", "Falha ao confirmar dados da Empresa.", time()+2, '/');
    header("Location: " . $pasta . "/pipedrive-empresa.php?clienteId=" . $clienteId);
    die();
}

$empresasPlanosDAO = new EmpresasPlanosDAO();

foreach ($_POST['planos'] as $chave => $plano) {
    $empresasPlanosDAO->setPlano($plano, $empresasId);
}

$retorno = $dao->updateSocioPreEmpresa($clienteId, $empresasId, Helpers::formataMoedaBd($_POST['porcentagem_societaria']));

if ($retorno == false) {
    setcookie("insercaoClienteOutroEscritorio", "false", time()+2, '/');
    setcookie("mensagemClienteOutroEscritorio", "Falha ao confirmar a porcentagem societária.", time()+2, '/');
    header("Location: " . $pasta . "/pipedrive-empresa.php?clienteId=" . $clienteId);
    die();
}

setcookie("insercaoClienteOutroEscritorio", "true", time()+2, '/');
setcookie("mensagemClienteOutroEscritorio", "Sucesso ao confirmar os dados do cliente vindo de outro escritório.", time()+2, '/');
header("Location: " . $pasta . "/pipedrive-clientes.php");
die();
