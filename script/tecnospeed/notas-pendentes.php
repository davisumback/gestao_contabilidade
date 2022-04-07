<?php

include __DIR__ . '/../../vendor/autoload.php';

$dao = new \App\DAO\EmpresaNfseDAO();
$notas = $dao->getNotasPendentes();

$notaFiscalApi = new \App\Model\Nfse\NotaFiscalApi();

foreach ($notas as $nota) {
    $retorno = $notaFiscalApi->consulta($nota->getId());
    $dados = json_decode($retorno['dados'], true);

    if ($retorno['respostaHttp'] == 200 && $dados['status'] == 'CONCLUIDO') { // TEM QUE COLOCAR UM ELSE AQUI PARA AVISAR OS OUTROS ESTADOS

        $notaFiscal = new \App\Model\NFse\NotaFiscalWebhook();
        $notaFiscal->setId($dados['id']);
        $notaFiscal->setPrestador($dados['prestador']['cpfCnpj']);
        $notaFiscal->setTomador($dados['prestador']['cpfCnpj']);
        $notaFiscal->setNumeroNfse($dados['numeroNfse']);
        $notaFiscal->setSituacao($dados['status']);
        $notaFiscal->setSerie($dados['rps']['serie']);
        $notaFiscal->setLote($dados['rps']['lote']);
        $notaFiscal->setEmissao($dados['rps']['dataEmissao']);

        $caminhoBase = '/var/www/html/medb/admin/grupobfiles/empresas/' . $nota->getEmpresasId() . '/nota-fiscal';

        $data = \DateTime::createFromFormat('Y-m-d', $notaFiscal->getEmissao());
        $pasta = $data->format('m-Y');

        if (!is_dir($caminhoBase . '/' . $pasta)) {
            $criaPasta = new \App\Arquivo\CriaPasta();
            $criaPasta->criaPasta($caminhoBase . '/' . $pasta);
        }

        $notaFiscalApi->savePdf(
            $notaFiscal,
            $caminhoBase . '/' . $pasta . '/' . $notaFiscal->getId() . '.pdf',
            $pasta . '/' . $notaFiscal->getId() . '.pdf'
        );

    } elseif ($retorno['respostaHttp'] == 200 && ($dados['status'] != 'CONCLUIDO' && $dados['status'] != 'PROCESSANDO')) {

        $notaFiscal = new \App\Model\NFse\NotaFiscalWebhook();
        $notaFiscal->setId($dados['id']);
        $notaFiscal->setPrestador($dados['prestador']['cpfCnpj']);
        $notaFiscal->setTomador($dados['prestador']['cpfCnpj']);
        $notaFiscal->setSituacao($dados['status']);
        $notaFiscal->setSerie($dados['rps']['serie']);
        $notaFiscal->setLote($dados['rps']['lote']);
        $notaFiscal->setEmissao($dados['rps']['dataEmissao']);

        $dao = new \App\DAO\EmpresaNfseDAO();
        $dao->updateInfos($notaFiscal);
    }
}