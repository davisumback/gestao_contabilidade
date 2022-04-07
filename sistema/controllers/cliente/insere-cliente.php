<?php
/***********************************************************************
1 - Tabela clientes_empresas está fora do roolback criado por mim;
***********************************************************************/
use App\DAO\ClienteDAO;
use App\DAO\DocumentoDAO;
use App\DAO\EnderecoClienteDAO;
use App\DAO\ClienteUsuarioDAO;
use App\DAO\HelperDAO;
use App\Helper\Helpers;
use App\Usuario\Cliente;
use App\Entidade\Documento;
use App\Entidade\EnderecoCliente;

require_once '../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];

$clienteDAO = new ClienteDAO();
$retorno = $clienteDAO->getSocio(Helpers::formataCpfBd($_POST['cpf']));

if ($retorno != null) {
    setcookie("resultado_insercao_socio", "false", time()+2, '/');
    setcookie("mensagem_insercao", "Cliente já possui cadastro.", time()+2, '/');
    header("Location: " . $pasta . "/form-cliente.php");
    die();
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

$retorno = $clienteDAO->insereCliente($cliente);
$clienteId = $retorno['cliente_id'];
if ($retorno['resultado'] == false) {
    setcookie("resultado_insercao_socio", "false", time()+2, '/');
    setcookie("mensagem_insercao", "Falha ao salvar o cliente.", time()+2, '/');
    header("Location: " . $pasta . "/form-cliente.php");
    die();
}

$clienteUsuarioDAO = new ClienteUsuarioDAO();
$retorno = $clienteUsuarioDAO->insereClienteUsuario($clienteId, $_POST['usuarios_id']);
$clienteUsuarioId = $retorno['clienteUsuarioId'];
$helperDao = new HelperDAO();
if (!$retorno['resultado']) {
    $helperDao->cancelaInsercao('clientes', $clienteId);
    setcookie("resultado_insercao_socio", "false", time()+2, '/');
    setcookie("mensagem_insercao", "Falha ao salvar o cliente.", time()+2, '/');
    header("Location: " . $pasta . "/form-cliente.php");
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

$documentoDAO = new DocumentoDAO();
$retorno = $documentoDAO->insereDocumentoCliente($documento);
$documentosId = $retorno['documentosId'];
if (!$retorno['resultado']) {
    $helperDao->cancelaInsercao('cliente_usuario', $clienteUsuarioId);
    $helperDao->cancelaInsercao('clientes', $clienteId);
    setcookie("resultado_insercao_socio", "false", time()+2, '/');
    setcookie("mensagem_insercao", "Falha ao salvar o cliente.", time()+2, '/');
    header("Location: " . $pasta . "/form-cliente.php");
    die();
}

$enderecoCliente = new EnderecoCliente(
    $clienteId,
    '',
	str_replace("-","",$_POST['cep']),
    $_POST['logradouro'],
    $_POST['numero-endereco'],
    $_POST['bairro'],
    $_POST['cidade'],
    $_POST['uf_endereco'],
    $_POST['complemento']
);

$enderecoClienteDao = new EnderecoClienteDAO();
$retorno = $enderecoClienteDao->insereEnderecoCliente($enderecoCliente);
if(!$retorno){
    $helperDao->cancelaInsercao('cliente_usuario', $clienteUsuarioId);
    $helperDao->cancelaInsercao('documentos', $documentosId);
    $helperDao->cancelaInsercao('endereco_empresa', $enderecoEmpresaId);
    $helperDao->cancelaInsercao('clientes', $clienteId);
    setcookie("resultado_insercao_socio", "false", time()+2, '/');
    setcookie("mensagem_insercao", "Falha ao salvar o cliente.", time()+2, '/');
    header("Location: " . $pasta . "/form-cliente.php");
    die();
}

setcookie("mensagem_insercao", "Sucesso ao salvar o cliente.", time()+2, '/');
header("Location: " . $pasta . "/form-cliente.php");
die();
