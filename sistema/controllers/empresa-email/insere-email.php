<?php
use App\DAO\EmpresaEmailDAO;
use App\DAO\GestorEmpresaDAO;
use App\Model\Inconsistencia\EmpresaCadastroInconsistencia;

include __DIR__ . '/../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];
$caminho = $pasta . '/empresa-emails.php';

$empresasId = $_POST['empresasId'];
$email = $_POST['email'];

$empresaEmailDao = new EmpresaEmailDAO();
$retorno = $empresaEmailDao->isEmailExistente($empresasId, $email);

if ($retorno != null) {
    setcookie('insercaoEmail', 'false', time()+2, '/');
    setcookie('mensagemInsercaoEmail', 'Esse email já possui cadastro para essa empresa.', time()+2, '/');
    header('Location: ' . $caminho);
    die();
}

$dao = new GestorEmpresaDAO();
$retorno = $dao->getGestorIdEmpresa($empresasId);
$gestorId = $retorno['usuarios_id'];

$retorno = $empresaEmailDao->insereEmailEmpresa($empresasId, $gestorId, $email);

if ($retorno == false) {
    setcookie('insercaoEmail', 'false', time()+2, '/');
    setcookie('mensagemInsercaoEmail', 'Falha ao inserir um novo email para essa empresa.', time()+2, '/');
    header('Location: ' . $caminho);
    die();
}

// tira a pendencia de emails
$empresaCadastroInconsistencia = new EmpresaCadastroInconsistencia();
$retorno = $empresaCadastroInconsistencia->updateInconsistenciaEmpresa($empresasId, 1, 'FINALIZADA');

setcookie('insercaoEmail', 'true', time()+2, '/');
setcookie('mensagemInsercaoEmail', 'Sucesso ao cadastrar novo email.', time()+2, '/');
header('Location: ' . $caminho);
die();
