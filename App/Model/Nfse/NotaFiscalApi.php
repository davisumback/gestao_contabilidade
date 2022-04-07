<?php
namespace App\Model\Nfse;

use App\Model\Nfse\NotaFiscal;
use App\Api\CurlNew;
use App\Api\CurlPdf;

class NotaFiscalApi
{
    const METHOD = '/nfse';

    public function cancela($notaFiscalId)
    {
        $dao = new \App\DAO\ApiDAO();
        $dados = $dao->getDadosApi('nfse');

        $url = $dados['url'] . self::METHOD . '/cancelar/' . $notaFiscalId;
        $token = $dados['token'];

        $header = [
            "x-api-key: $token"
        ];

        return CurlNew::executaCurl($url, '', $header, 'POST');
    }

    public function savePdf(\App\Model\Nfse\NotaFiscalWebhook $notaFiscal, $caminhoCompleto, $caminhoPasta)
    {
        $dao = new \App\DAO\ApiDAO();
        $dados = $dao->getDadosApi('nfse');

        $url = $dados['url'] . self::METHOD . '/pdf/' . $notaFiscal->getId();
        $token = $dados['token'];

        $header = [
            "x-api-key: $token",
            "accept: application/pdf"
        ];

        $fp = \fopen($caminhoCompleto, 'w+');

        $retorno = CurlPdf::executa($url, $header, $fp);

        if ($retorno['respostaHttp'] != 200) {
            \fclose($fp);
            unlink($caminhoCompleto);
            return;
        }

        $notaFiscal->setArquivo($caminhoPasta);

        $dao = new \App\DAO\EmpresaNfseDAO();
        $dao->updateInfos($notaFiscal);

        \fclose($fp);

        return $retorno;
    }

    public function envia(NotaFiscal $notaFiscal)
    {
        $dao = new \App\DAO\ApiDAO();
        $dados = $dao->getDadosApi('nfse');

        $url = $dados['url'] . self::METHOD;
        $token = $dados['token'];

        $post = json_encode(array($notaFiscal), JSON_UNESCAPED_UNICODE);

        $header = [
            "x-api-key: $token",
            "Content-Length: " . strlen($post),
            "Content-Type: application/json; charset=utf-8"
        ];

        return CurlNew::executaCurl($url, $post, $header);
    }

    public function consulta($idNotaFiscal)
    {
        $dao = new \App\DAO\ApiDAO();
        $dados = $dao->getDadosApi('nfse');

        $url = $dados['url'] . self::METHOD . '/' . $idNotaFiscal;
        $token = $dados['token'];

        $header = [
            "x-api-key: $token"
        ];

        return CurlNew::executaCurl($url, null, $header);
    }

    public function getPdf($idNotaFiscal)
    {
        $dao = new \App\DAO\ApiDAO();
        $dados = $dao->getDadosApi('nfse');

        $url = $dados['url'] . self::METHOD . '/pdf/' . $idNotaFiscal;
        $token = $dados['token'];

        $header = [
            "x-api-key: $token"
        ];

        return CurlNew::executaCurl($url, null, $header);
    }

    public function savePdfWebhook(\App\Model\Nfse\NotaFiscalWebhook $notaFiscal, $caminhoCompleto, $caminhoPasta)
    {
        $dao = new \App\DAO\ApiDAO();
        $dados = $dao->getDadosApi('nfse');

        $url = $dados['url'] . self::METHOD . '/pdf/' . $notaFiscal->getId();
        $token = $dados['token'];

        $header = [
            "x-api-key: $token",
            "accept: application/pdf"
        ];

        $fp = \fopen($caminhoCompleto, 'w+');

        $retorno = CurlPdf::executa($url, $header, $fp);

        if ($retorno['respostaHttp'] != 200) {
            \fclose($fp);
            unlink($caminhoCompleto);
            return;
        }

        $notaFiscal->setArquivo($caminhoPasta);
        // $notaFiscal->setPdf($caminhoPasta);

        $dao = new \App\DAO\EmpresaNfseDAO();
        $dao->updateStatus($notaFiscal);
        // $dao->updateArquivo($notaFiscal->getId(), $caminhoPasta);

        \fclose($fp);

        return $retorno;
    }
}