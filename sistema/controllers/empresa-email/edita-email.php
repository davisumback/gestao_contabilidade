<?php
use App\DAO\EmpresaEmailDAO;
use App\DAO\GestorEmpresaDAO;

include __DIR__ . '/../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];
$caminho = $pasta . '/empresa-emails.php';

$email = $_POST['email'];
$id = $_POST['id'];
$empresasId = $_POST['empresasId'];

$empresaEmailDao = new EmpresaEmailDAO();
$retorno = $empresaEmailDao->isEmailExistente($empresasId, $email);

if ($retorno != null) {
    setcookie('insercaoEmail', 'false', time()+2, '/');
    setcookie('mensagemInsercaoEmail', 'Esse email já possui cadastro para essa empresa.', time()+2, '/');
    header('Location: ' . $caminho);
    die();
}

$retorno = $empresaEmailDao->updateEmailEmpresa($id, $email);

if ($retorno == false) {
    setcookie('insercaoEmail', 'false', time()+2, '/');
    setcookie('mensagemInsercaoEmail', 'Falha ao editar esse email.', time()+2, '/');
    header('Location: ' . $caminho);
    die();
}

setcookie('insercaoEmail', 'true', time()+2, '/');
setcookie('mensagemInsercaoEmail', 'Sucesso ao editar o email.', time()+2, '/');
header('Location: ' . $caminho);
die();