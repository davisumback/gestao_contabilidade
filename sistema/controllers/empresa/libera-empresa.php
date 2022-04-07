<?php
use App\DAO\EmpresaDAO;
use App\Helper\Helpers;

include __DIR__ . '/../../../vendor/autoload.php';

session_start();
$pastaView = '../../' . $_SESSION['pasta'];

if (!array_key_exists('liberacao', $_POST)) {
    setcookie('liberacaoEmpresa', 'false', time()+2, '/');
    setcookie('mensagemLiberacao', 'Nenhuma liberação realizada', time()+2, '/');
    header('Location: ' . $pastaView . '/lista-liberacoes.php');
    die();
}

$empresasLiberacoes = $_POST['liberacao'];
$dataCompetencia = $_POST['data_competencia'];
$dataCompetenciaAnterior = Helpers::formataDataPeriodo('sub', $dataCompetencia, 'P1M', 'Y-m-d');

$empresaDao = new EmpresaDAO();

foreach ($empresasLiberacoes as $empresasId => $empresaArray) {
    $retorno = $empresaDao->insereEmpresaLiberacao($empresasId, $dataCompetencia);

    if ($retorno == false) {
        setcookie('liberacaoEmpresa', 'false', time()+2, '/');
        setcookie('mensagemLiberacao', 'Falha ao liberar a empresa ' . $empresasId, time()+2, '/');
        header('Location: ' . $pastaView . '/lista-liberacoes.php');
        die();
    }

    foreach ($empresaArray as $prolaboreCompetencia => $valor) {
        $retorno = $empresaDao->getProlabore($empresasId, $prolaboreCompetencia);

        if ($retorno != null) { // Serve para o primeiro caso, em que não existia nenhum prolabore para essa competência;
            $prolaboreBd = $retorno['prolabore'];
            $prolaborePost = Helpers::formataMoedaBd($empresaArray[$prolaboreCompetencia]);

            if ($prolaboreBd != $prolaborePost) { // Quando
                // update
                $retorno = $empresaDao->updateEmpresaProlabore($empresasId, $empresaArray[$prolaboreCompetencia], $prolaboreCompetencia);

                if ($retorno == false) {
                    setcookie('liberacaoEmpresa', 'false', time()+2, '/');
                    setcookie('mensagemLiberacao', 'Falha ao inserir o prolabore da empresa ' . $empresasId, time()+2, '/');
                    header('Location: ' . $pastaView . '/lista-liberacoes.php');
                    die();
                }
            }
        } else {
            $retorno = $empresaDao->insereEmpresaProlabores($empresasId, $empresaArray[$prolaboreCompetencia], $prolaboreCompetencia);

            if ($retorno == false) {
                setcookie('liberacaoEmpresa', 'false', time()+2, '/');
                setcookie('mensagemLiberacao', 'Falha ao inserir o prolabore da empresa ' . $empresasId, time()+2, '/');
                header('Location: ' . $pastaView . '/lista-liberacoes.php');
                die();
            }
        }
    }
}

setcookie('liberacaoEmpresa', 'true', time()+2, '/');
setcookie('mensagemLiberacao', 'Liberações realizadas com sucesso', time()+2, '/');
header('Location: ' . $pastaView . '/lista-liberacoes.php');
die();
