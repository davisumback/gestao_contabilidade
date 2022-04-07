<?php
namespace App\Model;

use App\Helper\Helpers;
use App\Arquivo\UploadArquivo;
use App\Arquivo\CriaPasta;

class UploadArquivoModel
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = \App\Config\BancoConfigPDO::conecta();
    }

    public function save($attributes)
    {
        $caminhoPasta = '../../../grupobfiles/empresas/' . $attributes['empresasId'] . '/' . $attributes['tipo'];

        if (! \is_dir($caminhoPasta)) {
            $criaPasta = new CriaPasta();
            $retorno = $criaPasta->criaPasta($caminhoPasta);
            var_dump($retorno);
        }

        if (\is_file($caminhoPasta . '/' . $attributes['files']['name'])) {
            throw new \Exception("Já existe um arquivo com esse nome!", 1);            
        }

        $scriptUpload = new \App\Arquivo\UploadArquivo();
        $retorno = $scriptUpload->enviaArquivo($attributes['files'], $caminhoPasta);

        if ($retorno == false) {
            throw new \Exception("Tipo de arquivo não permitido", 1);           
        }

        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO arquivos_clientes_medcontabil (
                    empresas_id, nome_arquivo, tipo, created_at
                ) VALUES (
                    :empresasId, :nome_arquivo, :tipo, :created_at
                );";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $attributes['empresasId'], \PDO::PARAM_INT);
        $sth->bindValue(':nome_arquivo', $attributes['files']['name'], \PDO::PARAM_STR);
        $sth->bindValue(':tipo', $attributes['tipo'], \PDO::PARAM_STR);
        $sth->bindValue(':created_at', $now, \PDO::PARAM_STR);
        $sth->execute();
    }

    public function saveDiversos($attributes)
    {
        $caminhoPasta = '../../../grupobfiles/empresas/' . $attributes['empresaId'] . '/arquivos-diversos';

        if (! \is_dir($caminhoPasta)) {
            $criaPasta = new CriaPasta();
            $retorno = $criaPasta->criaPasta($caminhoPasta);
            var_dump($retorno);
        }

        if (\is_file($caminhoPasta . '/' . $attributes['files']['name'])) {
            throw new \Exception("Já existe um arquivo com esse nome!", 1);            
        }

        $scriptUpload = new \App\Arquivo\UploadArquivo();
        $retorno = $scriptUpload->enviaArquivoDiversos($attributes['files'], $caminhoPasta);

        if ($retorno == false) {
            throw new \Exception("Tipo de arquivo não permitido", 1);           
        }

        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO empresas_arquivos_diversos (
                    empresas_id, nome_arquivo, descricao, usuarios_id, created_at
                ) VALUES (
                    :empresasId, :nome_arquivo, :descricao, :usuarios_id, :created_at
                );";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $attributes['empresaId'], \PDO::PARAM_INT);
        $sth->bindValue(':nome_arquivo', $attributes['files']['name'], \PDO::PARAM_STR);
        $sth->bindValue(':descricao', $attributes['descricao'], \PDO::PARAM_STR);
        $sth->bindValue(':usuarios_id', $attributes['usuario_id'], \PDO::PARAM_INT);
        $sth->bindValue(':created_at', $now, \PDO::PARAM_STR);
        $sth->execute();
    }
}