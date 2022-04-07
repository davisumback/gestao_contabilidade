<?php
use App\Model\ValueObject\Telefone;
use App\Model\ValueObject\Cnpj;
use App\DAO\ProspectDAO;

include __DIR__ . '/../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];

if (empty($_POST)) {
    header("Location: " . $pasta . "/prospect.php");
    die();
}

// CASO Whats = NULL ENTAO Whats = NAO No MySQL
$_POST['whatsapp'] = 'NAO';
if (array_key_exists('WhatsApp', $_POST)) {
    $_POST['whatsapp'] = 'SIM';
}

// Valida Campos Nome Doutor & Nome Contato
if ($_POST['nome_doutor'] == '' && $_POST['nome_contato'] == '') {
    setcookie('mensagemDadosProspect', 'Erro! você precisa inserir o nome do doutor ou nome do contato', time() + 2, '/');
    setcookie('resultadoDadosProspect', 'false', time() + 2, '/');
    header("Location: " . $pasta . "/prospect.php");
    die();
}

// Valida Campos Email & Telefone
if ($_POST['email'] == '' && $_POST['telefone'] == '') {
    setcookie('mensagemDadosProspect', 'Erro! Você precisa inserir o email ou telefone', time() + 2, '/');
    setcookie('resultadoDadosProspect', 'false', time() + 2, '/');
    header("Location: " . $pasta . "/prospect.php");
    die();
}

// Chama Classe Telefone
$telefone = $_POST['telefone'];
$telefone = new Telefone($telefone);
$_POST['telefone'] = $telefone->getTelefone();

// Chama Classe Celular
$celular = $_POST['celular'];
$celular = new Telefone($celular);
$_POST['celular'] = $celular->getTelefone();

if ($_POST['cnpj'] != null) {
    // Chama Classe CNPJ
    try {
        $cnpj = $_POST['cnpj'];
        $cnpj = new Cnpj($cnpj);
        $_POST['cnpj'] = $cnpj->getCnpj();
    } catch (\Throwable $th) {
        setcookie('mensagemDadosProspect', 'Error! ' . $th->getMessage(), time() + 2, '/');
        setcookie('resultadoDadosProspect', 'false', time() + 2, '/');
        header("Location: " . $pasta . "/prospect.php");
        die();
    }
}

//Inserir Dados Cliente DAO
$dao = new ProspectDAO();
$retorno = $dao->isDadoExistente($_POST['cnpj']);

if ($retorno != null) {
    setcookie('mensagemDadosProspect', 'CNPJ já cadastrado', time() + 2, '/');
    setcookie('resultadoDadosProspect', 'false', time() + 2, '/'); //TIME COOKIE NAVEGADOR
    header("Location: " . $pasta . "/prospect.php");
    die();
}

$retorno = $dao->insereDadosProspect($_POST);

if ($retorno == false) {
    setcookie('mensagemDadosProspect', 'Erro ao preencher o formulário', time() + 2, '/');
    setcookie('resultadoDadosProspect', 'false', time() + 2, '/'); //TIME COOKIE NAVEGADOR
    header("Location: " . $pasta . "/prospect.php");
    die();
}

//DADOS DO CLIENTE
if ($retorno == true) {
    setcookie('mensagemDadosProspect', 'Dados cadastrados com sucesso!', time() + 2, '/');
    setcookie('resultadoDadosProspect', 'true', time() + 2, '/');  //TIME COOKIE NAVEGADOR
    header("Location: " . $pasta . "/prospect.php");
    die();
}
