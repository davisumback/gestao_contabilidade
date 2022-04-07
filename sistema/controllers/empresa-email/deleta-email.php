<?php
use App\DAO\EmpresaEmailDAO;
use App\DAO\GestorEmpresaDAO;

include __DIR__ . '/../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];
$caminho = $pasta . '/empresa-emails.php';

$id = $_POST['id'];

$empresaEmailDao = new EmpresaEmailDAO();

$retorno = $empresaEmailDao->deletaEmailEmpresa($id);

if ($retorno == false) {
    setcookie('insercaoEmail', 'false', time()+2, '/');
    setcookie('mensagemInsercaoEmail', 'Falha ao deletar esse email.', time()+2, '/');
    header('Location: ' . $caminho);
    die();
}

setcookie('insercaoEmail', 'true', time()+2, '/');
setcookie('mensagemInsercaoEmail', 'Sucesso ao deletar o email.', time()+2, '/');
header('Location: ' . $caminho);
die();
