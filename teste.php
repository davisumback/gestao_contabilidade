<?php

include __DIR__ . '/vendor/autoload.php';

$dao = new \App\DAO\EmpresaNfseDAO();
$notas = $dao->getNotasPendentes();

$notaFiscalApi = new \App\Model\Nfse\NotaFiscalApi();

foreach ($notas as $nota) {
    $retorno = $notaFiscalApi->consulta($nota->getId());
    $dados = json_decode($retorno['dados'], true);

    if ($retorno['respostaHttp'] == 200 && $dados['status'] == 'CONCLUIDO') {

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
        // $caminhoBase = 'grupobfiles/empresas/' . $nota->getEmpresasId() . '/nota-fiscal';

        $data = \DateTime::createFromFormat('Y-m-d', $notaFiscal->getEmissao());
        $pasta = $data->format('m-Y');

        if (! is_dir($caminhoBase . '/' . $pasta)) {
            $criaPasta = new \App\Arquivo\CriaPasta();
            $criaPasta->criaPasta($caminhoBase . '/' . $pasta);
        }

        $notaFiscalApi->savePdf(
            $notaFiscal,            
            $caminhoBase . '/' . $pasta . '/' . $notaFiscal->getId() . '.pdf',
            $pasta . '/' . $notaFiscal->getId() . '.pdf'
        );
    }
}



// echo '<pre>';
// print_r($retorno);
// echo '</pre>';
// die();

// echo '<pre>';
// print_r($notas);
// echo '</pre>';


// savePdf(\App\Model\Nfse\NotaFiscalWebhook $notaFiscal, $caminhoCompleto, $caminhoPasta)


// $dao = new \App\DAO\ApiDAO();
// $dados = $dao->getDadosApi('nfse');

// $url = $dados['url'] . '/nfse/pdf/5c8bdee2a60693f804256885';
// $token = $dados['token'];

// $header = [
//     "x-api-key: $token"
// ];

// $fp = \fopen('a.pdf', 'w+');

// $retorno = \App\Api\CurlPdf::executa($url, $header, $fp);

// var_dump($retorno);

// $dao = new \App\DAO\EmpresaNfseDAO();
// $dao->getEmpresasId('5bc9d29fdb171a6d480f7af9');

// $notaFiscal = new \App\Model\Nfse\NotaFiscalWebhook();
// $notaFiscalApi = new \App\Model\Nfse\NotaFiscalApi();

// $caminhoBase = 'grupobfiles/empresas/620/nota-fiscal';
// $emissao = '15/10/2018';

// $data = \DateTime::createFromFormat('d/m/Y', $emissao);
// $pasta = $data->format('m-Y');

// if (! is_dir($caminhoBase . '/' . $pasta)) {
//     $criaPasta = new \App\Arquivo\CriaPasta();
//     $criaPasta->criaPasta($caminhoBase . '/' . $pasta);
// }

// $notaFiscal->setId('5c91485ba60693f4b1257ee7');
// $notaFiscalApi->savePdfWebhook(
//     $notaFiscal,
//     $caminhoBase . '/' . $pasta . '/' . $notaFiscal->getId() . '.pdf'
// );

// $notaFiscalApi = new \App\Model\Nfse\NotaFiscalApi();
// $retorno = $notaFiscalApi->getPdf('5c8bdee2a60693f804256885');
// $retorno = $notaFiscalApi->consulta('5c8bdee2a60693f804256885');
// $retorno = json_decode($retorno['dados'], true);

// $header = [
//     "x-api-key: 2da392a6-79d2-4304-a8b7-959572c7e44d",
//     "Accept: application/pdf"
// ];

// $fp = fopen('a.pdf', 'w+');

// $ch = curl_init('https://api.sandbox.plugnotas.com.br/nfse/pdf/5c8bec8ea6069307ee25688a');

// curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
// curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
// curl_setopt($ch, CURLOPT_FILE, $fp);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// $resultado = curl_exec($ch);
// fclose($fp);

// // header('Cache-Control: public'); 
// // header('Content-type: application/pdf');
// // header('Content-Disposition: attachment; filename="new.pdf"');
// // header('Content-Length: '.strlen($Result));
// // echo $Result;

// // $downloadPath = "aaa.pdf";
// // $file = fopen($downloadPath, "w+");
// // fputs($file, $Result);
// // fclose($file);

// // header('Cache-Control: public'); 
// // header('Content-type: application/pdf');
// // header('Content-Disposition: attachment; filename="new.pdf"');
// // header('Content-Length: '.strlen($Result));
// // echo $Result;