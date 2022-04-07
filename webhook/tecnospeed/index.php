<?php
require_once '../../vendor/autoload.php';

$entrada = file_get_contents('php://input');

file_put_contents('/var/www/html/logs/tecnospeed.log', $entrada . "\n", FILE_APPEND);

$entrada = json_decode($entrada);

$notaFiscalWebhook = new \App\Model\Nfse\NotaFiscalWebhook();
$notaFiscalWebhook->setId($entrada->id);
$notaFiscalWebhook->setSituacao($entrada->situacao);
$notaFiscalWebhook->setTomador($entrada->tomador);
$notaFiscalWebhook->setPrestador($entrada->prestador);
$notaFiscalWebhook->setNumeroNfse($entrada->numeroNfse);
$notaFiscalWebhook->setSerie($entrada->serie);
$notaFiscalWebhook->setLote($entrada->lote);
$notaFiscalWebhook->setCodigoVerificacao($entrada->codigoVerificacao);
$notaFiscalWebhook->setDataAutorizacao($entrada->autorizacao);
$notaFiscalWebhook->setMensagemRetorno($entrada->mensagem);
$notaFiscalWebhook->setEmissao($entrada->emissao);

if (! empty($entrada) && $entrada->situacao == 'CONCLUIDO') {
    $notaFiscalApi = new \App\Model\Nfse\NotaFiscalApi();
    
    $dao = new \App\DAO\EmpresaNfseDAO();
    $empresasId = $dao->getEmpresasId($notaFiscalWebhook->getId());

    if ($empresasId != null) {
        $caminhoBase = '/var/www/html/grupob/grupobfiles/empresas/' . $empresasId . '/nota-fiscal';

        $data = \DateTime::createFromFormat('Y-m-d', $notaFiscalWebhook->getEmissao());
        $pasta = $data->format('m-Y');

        if (! is_dir($caminhoBase . '/' . $pasta)) {
            $criaPasta = new \App\Arquivo\CriaPasta();
            $criaPasta->criaPasta($caminhoBase . '/' . $pasta);
        }

        $notaFiscalApi->savePdfWebhook(
            $notaFiscalWebhook,
            $caminhoBase . '/' . $pasta . '/' . $notaFiscalWebhook->getId() . '.pdf',
            $pasta . '/' . $notaFiscalWebhook->getId() . '.pdf'
        );
    }

} elseif (! empty($entrada) && $entrada->situacao == 'CANCELADO') {

    $notaFiscal = new \App\Model\NFse\NotaFiscalWebhook();
    $notaFiscal->setId($entrada->id);
    $notaFiscal->setPrestador($entrada->prestador);
    $notaFiscal->setTomador($entrada->tomador);
    $notaFiscal->setSituacao($entrada->situacao);
    $notaFiscal->setSerie($entrada->serie);
    $notaFiscal->setLote($entrada->lote);
    $notaFiscal->setCancelamento($entrada->cancelamento);

    $dao = new \App\DAO\EmpresaNfseDAO();
    $dao->setCancelada($notaFiscal);

} elseif (! empty($entrada) && $entrada->situacao == 'REJEITADO') {

    $notaFiscal = new \App\Model\NFse\NotaFiscalWebhook();
    $notaFiscal->setId($entrada->id);
    $notaFiscal->setPrestador($entrada->prestador);
    $notaFiscal->setTomador($entrada->tomador);
    $notaFiscal->setSituacao($entrada->situacao);
    $notaFiscal->setSerie($entrada->serie);
    $notaFiscal->setLote($entrada->lote);
    $notaFiscal->setEmissao($entrada->emissao);

    $dao = new \App\DAO\EmpresaNfseDAO();
    $dao->updateInfos($notaFiscal);
}