<?php
namespace App\Model\Empresa;

use App\Config\BancoConfig;

class EmpresaCertidao
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function insereCertidaoEmpresa($empresasId, $certidoesTipos, $dataValidade, $nomeArquivo)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO empresas_certidoes (
            empresas_id, certidoes_tipos, data_validade, created_at, nome_arquivo
        ) VALUES (
            $empresasId, $certidoesTipos, '$dataValidade', '$now', '$nomeArquivo'
        );";

        return \mysqli_query($this->conexao, $query);
    }
}