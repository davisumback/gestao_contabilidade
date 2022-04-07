<?php
namespace App\Model\Empresa;

use App\Helper\Helpers;
use App\Arquivo\UploadArquivo;
use App\Arquivo\CriaPasta;

class Alvara
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = \App\Config\BancoConfigPDO::conecta();
    }

    public function save($attributes)
    {
        $caminhoPasta = '../../../grupobfiles/empresas/' . $attributes['empresasId'] . '/alvara';
        $attributes['dataVencimento'] = Helpers::formataDataBd($attributes['dataVencimento'], '00/00/0000');

        if (! \is_dir($caminhoPasta)) {
            $criaPasta = new CriaPasta();
            $retorno = $criaPasta->criaPasta($caminhoPasta);
            var_dump($retorno);
        }

        if (\is_file($caminhoPasta . '/' . $attributes['files']['name'])) {
            throw new \Exception("Já existe um arquivo com esse nome!", 1);            
        }

        $scriptUpload = new \App\Arquivo\UploadArquivo();        
        $retorno = $scriptUpload->enviaArquivoAlvara($attributes['files'], $caminhoPasta);
        
        $name = $attributes['files']['name'];
        $ext = strtolower(substr($name,-4));
        $nomeArquivo = 'ALVARA' . $ext;

        if ($retorno == false) {
            throw new \Exception("Tipo de arquivo não permitido", 1);           
        }

        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO alvara (
                    empresas_id, nome_arquivo, data_vencimento, created_at
                ) VALUES (
                    :empresasId, :nome_arquivo, :data_vencimento, :created_at
                );";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $attributes['empresasId'], \PDO::PARAM_INT);
        $sth->bindValue(':nome_arquivo', $nomeArquivo, \PDO::PARAM_STR);
        $sth->bindValue(':data_vencimento', $attributes['dataVencimento'], \PDO::PARAM_STR);
        $sth->bindValue(':created_at', $now, \PDO::PARAM_STR);
        $sth->execute();
    }

    public function getAlvara($empresasId)
    {
        $query = "SELECT 
                    *
                FROM 
                    alvara
                WHERE 
                    empresas_id = :empresasId;";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->execute();

        return $sth->fetch(\PDO::FETCH_ASSOC);
    }
}