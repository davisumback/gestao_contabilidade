<?php
use App\Arquivo\CriaPasta;
use App\Arquivo\UploadArquivo;
use App\DAO\GuiaDAO;
use App\Helper\Helpers;

require_once '../../../vendor/autoload.php';

session_start();
$pastaView = '../../' . $_SESSION['pasta'];
$caminhoRetorno = $pastaView . '/lista-guia-domestica.php?tipo=' . key($_POST['guias']);
$dataCompetencia = $_SESSION['dataCompetencia'];
$domesticaId = $_POST['domestica_id'];

$dao = new GuiaDAO();

foreach ($_POST['guias'] as $guia => $valor) {

    $retorno = $dao->isGuiaExistente($domesticaId, $guia, $dataCompetencia);

    if ($retorno != null) {
        setcookie("upload_guia", "false", time()+2, '/');
        setcookie("mensagem_upload_guia", "Erro! Já existe uma guia $guia para a competência " . $_SESSION['dataCompetencia'], time()+2, '/');
        header("Location: " . $caminhoRetorno);
        die();
    }
}

if(array_key_exists('sem_guia', $_POST) && ($_POST['sem_guia'] == 1 || $_POST['sem_guia'] == 'on')) {
    $dao = new GuiaDAO();

    foreach($_POST['guias'] as $guia => $valor) {
        $retorno = $dao->insereSemGuiaDomesticas($_POST['domestica_id'], $_POST['usuario_id'], $guia, $_SESSION['dataCompetencia'], 1);
        if($retorno == false) {
            setcookie("upload_guia", "false", time()+2, '/');
            setcookie("mensagem_upload_guia", "Falha ao informar a ausência dessa guia, nesse mês.", time()+2, '/');
        }
    }

    setcookie("upload_guia", "true", time()+2, '/');
    setcookie("mensagem_upload_guia", "Sucesso ao informar a ausência dessa(s) guia(s), nesse mês.", time()+2, '/');
    header("Location: " . $caminhoRetorno);
    die();
}

$caminhoBase = $_SERVER['DOCUMENT_ROOT'] . '/grupobfiles/domesticas/' . $_POST['domestica_id'] . '/guias';
$pasta = str_replace('/' , '-', $_SESSION['dataCompetencia']);
$pasta =  $caminhoBase . '/' . $pasta;

if(!is_dir($pasta)) {
    CriaPasta::criaPasta($pasta);
}

$nomeGuia = '';
foreach($_POST['guias'] as $guia => $valor) {
    $nomeGuia .= $guia . '-';
}

$nomeGuia = substr($nomeGuia, 0, -1);
$caminho = $caminhoBase . '/' . str_replace('/' , '-', $_SESSION['dataCompetencia']);
$resultadoUpload = UploadArquivo::uploadGuia($_FILES, $caminho, Helpers::formataNomeGuia($_FILES['fileUpload']['name'], $_POST['domestica_id'], $nomeGuia));

if($resultadoUpload == false) {
    setcookie("upload_guia", "false", time()+2, '/');
    setcookie("mensagem_upload_guia", "Falha ao fazer o upload da guia!", time()+2, '/');
    header("Location: " . $caminhoRetorno);
    die();
}

$dao = new GuiaDAO();
$guiaUnica = '';
foreach($_POST['guias'] as $guia => $valor) {
    $retorno = $dao->insereGuiaDomesticas(
        $_POST['domestica_id'],
        $guia,
        Helpers::formataDataBd($_POST['data_vencimento']),
        $_SESSION['dataCompetencia'],
        $_POST['usuario_id'],
        Helpers::formataNomeGuia($_FILES['fileUpload']['name'], $_POST['domestica_id'], $nomeGuia),
        $guiaUnica
    );

    $guiaUnica = true;

    if($retorno['retorno'] == false) {
        setcookie("upload_guia", "false", time()+2, '/');
        setcookie("mensagem_upload_guia", "Falha ao salvar os dados da guia no banco!", time()+2, '/');
        header("Location: " . $pastaView . "/index.php");
        die();
    }
}

setcookie("upload_guia", "true", time()+2, '/');
setcookie("mensagem_upload_guia", "Sucesso ao salvar guia", time()+2, '/');
header("Location: " . $caminhoRetorno);
die();