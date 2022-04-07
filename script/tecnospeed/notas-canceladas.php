<?php

include __DIR__ . '/../../vendor/autoload.php';

$dao = new \App\DAO\EmpresaNfseDAO();
$notas = $dao->getNotasConcluidas('2019-04-02');

$notaFiscalApi = new \App\Model\Nfse\NotaFiscalApi();

foreach ($notas as $nota) {
    $retorno = $notaFiscalApi->consulta($nota->getId());
    $dados = json_decode($retorno['dados'], true);

    if ($retorno['respostaHttp'] == 200 && $dados['status'] == 'CANCELADO') {

        $notaFiscal = new \App\Model\NFse\NotaFiscalWebhook();
        $notaFiscal->setId($dados['id']);
        $notaFiscal->setPrestador($dados['prestador']['cpfCnpj']);
        $notaFiscal->setTomador($dados['tomador']['cpfCnpj']);
        $notaFiscal->setSituacao($dados['status']);
        $notaFiscal->setSerie($dados['rps']['serie']);
        $notaFiscal->setLote($dados['rps']['lote']);
        $notaFiscal->setEmissao($dados['rps']['dataEmissao']);

        $dao = new \App\DAO\EmpresaNfseDAO();
        $dao->updateInfos($notaFiscal);
    }
}