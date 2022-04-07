<?php
namespace App\Model\Empresa;

class Edital
{
    private $edital;

    public function setEdital($edital)
    {
        if (empty($edital) || $edital['error'] != 0) {
            throw new \Exception("Erro! Você precisa fazer o upload de um edital", 1);
        }

        // if ($edital['type'] != 'application/pdf') {
        //     throw new \Exception("Erro! Só é aceito edital em PDF", 1);
        // }

        $this->edital = $edital;
    }

    public function uploadEdital($empresasId)
    {        
        $pastaCredencimentos = '../../../grupobfiles/empresas/' . $empresasId . '/credenciamento';
        $contador = 1;
        $pastaCredencimento = $pastaCredencimentos . '/credenciamento-';

        if (! is_dir($pastaCredencimentos)) {
            $criaPasta = new \App\Arquivo\CriaPasta();
            $criaPasta->criaPasta($pastaCredencimentos);
        }

        while (is_dir($pastaCredencimento . $contador)) {
            $contador ++;
        }

        if (! is_dir($pastaCredencimento . $contador)) {
            $criaPasta = new \App\Arquivo\CriaPasta();
            $retorno = $criaPasta->criaPasta($pastaCredencimento . $contador);
            $pastaCredencimento .= $contador;
        }

        if (is_file($pastaCredencimentos . '/' . $this->edital['name'])) {
            throw new \Exception("Erro! Já existe um arquivo PDF de edital com esse nome.", 1);
        }
        
        $uploadArquivo = new \App\Arquivo\UploadArquivo();
        $retorno = $retornoUpload = $uploadArquivo->uploadArchive(
            $this->edital['tmp_name'],
            $this->edital['name'],
            $pastaCredencimento
        );

        if ($retorno == false) {
            throw new \Exception("Erro ao fazer o upload do Edital.", 1);
        }

        return 'credenciamento-' . $contador;
    }
}