<?php
use App\Helper\Helpers;
use App\Entidade\Contrato;
use App\Entidade\Empresa;
use App\Entidade\EnderecoEmpresa;
use App\Arquivo\ArquivoEmpresa;
use App\DAO\ContratoDAO;
use App\DAO\EmpresasPlanosDAO;
use App\DAO\EmpresaDAO;
use App\DAO\EnderecoEmpresaDAO;
use App\DAO\EmpresaUsuarioDAO;
use App\DAO\GestorEmpresaDAO;
use App\DAO\ContadorEmpresaDAO;
use App\DAO\ClienteEmpresaDAO;
use App\DAO\HelperDAO;

require_once '../../../vendor/autoload.php';

$pasta = '../../' . $_POST['pasta'];
$empresasId = $_POST['empresas_id'];
$helperDao = new HelperDAO();

$porcentagem = 0;
foreach($_POST['socios'] as $socio){
    $porcentagem += $socio['porcentagem'];
}

if($porcentagem < 100) {
    setcookie("resultado_insercao_empresa", "false", time()+2, '/');
    setcookie("mensagem_insercao", "A soma da porcentagem dos sócios é menor que 100!", time()+2, '/');
    header("Location: " . $pasta . '/form-empresa-2.php');
    die();
}elseif($porcentagem > 100) {
    setcookie("resultado_insercao_empresa", "false", time()+2, '/');
    setcookie("mensagem_insercao", "A soma da porcentagem dos sócios é maior que 100!", time()+2, '/');
    header("Location: " . $pasta . '/form-empresa-2.php');
    die();
}

$empresa = new Empresa();
$empresa->setId($_POST['empresas_id']);
$empresa->setTipoSocietario($_POST['tipo_societario']);
$empresa->setNomeEmpresa($_POST['empresa_nome']);
$empresa->setRegimeTributario($_POST['regime_tributario']);
$empresa->setCnpj(Helpers::formataCnpjBd($_POST['cnpj']));
$empresa->setObjeto($_POST['objeto']);
$empresa->setCapitalSocial(Helpers::formataMoedaBd($_POST['capital_social']));
$empresa->setPagamentoIrpjCsll($_POST['pagamento_irpj_csll']);
$empresa->setAtividadePrincipal($_POST['atividade_principal']);
$empresa->setInicioAtividades(Helpers::formataDataBd($_POST['inicio_atividade']));
if($_POST['sn_data'] == null){
    $empresa->setDataSn($_POST['sn_data']);
}else {
    $empresa->setDataSn(Helpers::formataDataBd($_POST['sn_data']));
}
$empresa->setPorte($_POST['porte']);
$empresa->setVinculo($_POST['vinculo']);

$empresaDAO = new EmpresaDAO();
$retorno = $empresaDAO->insereEmpresaMigrada($empresa);

if($retorno == false){
    setcookie("resultado_insercao_empresa", "false", time()+2, '/');
    setcookie("mensagem_insercao", "Falha ao cadastrar Empresa.", time()+2, '/');
    header("Location: " . $pasta . '/form-empresa-2.php');
    die();
}

$clienteEmpresaDao = new ClienteEmpresaDAO();
foreach ($_POST['socios'] as $socio) {
    $socioAdministrador = ($socio['socio_administrador'] == 'Sim') ? 1 : 0;
    $retorno = $clienteEmpresaDao->insereClienteEmpresaNew($socio['sociosId'], $empresasId, $socio['porcentagem'], $socioAdministrador);

    if ($retorno == false) {
        setcookie("resultado_insercao_empresa", "false", time()+2, '/');
        setcookie("mensagem_insercao", "Erro ao vincular cliente à empresa!", time()+2, '/');
        header("Location: " . $pasta . '/form-empresa-2.php');
        die();
    }
}

$enderecoEmpresa = new EnderecoEmpresa(
    $empresasId,
    $_POST['iptu'],
	str_replace("-","",$_POST['cep']),
    $_POST['logradouro'],
    $_POST['numero_endereco'],
    $_POST['bairro'],
    $_POST['cidade'],
    $_POST['uf_endereco'],
    $_POST['complemento']
);

$enderecoEmpresaDAO = new EnderecoEmpresaDAO();
$retorno = $enderecoEmpresaDAO->setEnderecoEmpresa($enderecoEmpresa);
$enderecoEmpresaId = $retorno['endereco_empresa_id'];
if($retorno['resultado'] == false){
    $helperDao->cancelaInsercao('empresas', $empresasId);
    setcookie("resultado_insercao_empresa", "false", time()+2, '/');
    setcookie("mensagem_insercao", "Falha ao cadastrar Empresa.", time()+2, '/');
    header("Location: " . $pasta . '/form-empresa-2.php');
    die();
}

$gestorEmpresaDAO = new GestorEmpresaDAO();
$retorno = $gestorEmpresaDAO->insereGestorEmpresa($empresasId, $_POST['gestor']);
$gestoresEmpresasId = $retorno['gestores_empresas_id'];
if($retorno['resultado'] == false) {
    $helperDao->cancelaInsercao('endereco_empresa', $enderecoEmpresaId);
    $helperDao->cancelaInsercao('empresas', $empresasId);
    setcookie("resultado_insercao_empresa", "false", time()+2, '/');
    setcookie("mensagem_insercao", "Falha ao cadastrar Empresa.", time()+2, '/');
    header("Location: " . $pasta . '/form-empresa-2.php');
    die();
}

$contadorEmpresaDAO = new ContadorEmpresaDAO();
$retorno = $contadorEmpresaDAO->insereContadorEmpresa($empresasId, $_POST['contador']);
$contadoresEmpresaId = $retorno['contadores_empresas_id'];
if($retorno['resultado'] == false) {
    $helperDao->cancelaInsercao('endereco_empresa', $enderecoEmpresaId);
    $helperDao->cancelaInsercao('gestores_empresas', $gestoresEmpresasId);
    $helperDao->cancelaInsercao('empresas', $empresasId);
    setcookie("resultado_insercao_empresa", "false", time()+2, '/');
    setcookie("mensagem_insercao", "Falha ao cadastrar Empresa.", time()+2, '/');
    header("Location: " . $pasta . '/form-empresa-2.php');
    die();
}

$contrato = new Contrato();
$contrato->setDiaVencimento($_POST['dia_honorarios']);
$contrato->setEmpresasId($empresasId);

$contratoDAO = new ContratoDAO();
$retorno = $contratoDAO->insereContrato($contrato);
$contratosId = $retorno['contratos_id'];
if($retorno['resultado'] == false) {
    $helperDao->cancelaInsercao('endereco_empresa', $enderecoEmpresaId);
    $helperDao->cancelaInsercao('gestores_empresas', $gestoresEmpresasId);
    $helperDao->cancelaInsercao('contadores_empresas', $contadoresEmpresaId);
    $helperDao->cancelaInsercao('empresas', $empresasId);
    setcookie("resultado_insercao_empresa", "false", time()+2, '/');
    setcookie("mensagem_insercao", "Falha ao cadastrar Empresa.", time()+2, '/');
    header("Location: " . $pasta . '/form-empresa-2.php');
    die();
}

$empresasPlanosDAO = new EmpresasPlanosDAO();
foreach ($_POST as $chave => $valor){
    similar_text($chave, 'planoid', $percentual);
    if($percentual > 85){
        $empresasPlanosDAO->setPlano($valor, $empresasId);
    }
}

$empresaUsuarioDAO = new EmpresaUsuarioDAO();
$retorno = $empresaUsuarioDAO->insereEmpresaUsuario($empresasId, $_POST['usuarios_id']);

$arquivoEmpresa = new ArquivoEmpresa();
$arquivoEmpresa->criaPastasPadraoEmpresa($empresasId);

session_start();
$_SESSION['socios'] = json_encode($_POST['socios']);
$_SESSION['quantidade_socios'] = count($_POST['socios']);
$_SESSION['empresas_id'] = $empresasId;
$_SESSION['empresa_nome'] = $_POST['empresa_nome'];
$_SESSION['cadastro_socio_etapa'] = 1;

setcookie("resultado_insercao_empresa", "true", time()+2, '/');
setcookie("mensagem_insercao", "Sucesso ao cadastrar Empresa", time()+2, '/');
header("Location: " . $pasta . "/form-cnpj-2.php");
die();
