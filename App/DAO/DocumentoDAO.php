<?php

namespace App\DAO;
use App\Entidade\Documento;
use App\Config\BancoConfig;

class DocumentoDAO{
    private $conexao;

    function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function insereDocumentoCliente(Documento $documento)
    {
        $validade = ($documento->getValidade() == '') ? 'null' : "'" .$documento->getValidade(). "'";
        $naturalidade = ($documento->getNaturalidade() == '') ? 'null' : "'" .$documento->getNaturalidade(). "'";
        $caminho = ($documento->getCaminho() == '') ? 'null' : "'" .$documento->getCaminho(). "'";
        $uf = ($documento->getUf() == '') ? "'" .'0'. "'" : "'" .$documento->getUf(). "'";

        $query = "  INSERT INTO documentos (
                        cliente_id, numero, data_emissao, orgao_expedidor, naturalidade, validade, tipo_documento, uf, caminho
                    )
                    VALUES (
                        {$documento->getClienteId()},
                        '{$documento->getNumero()}',
                        '{$documento->getDataEmissao()}',
                        '{$documento->getOrgaoExpedidor()}',
                        $naturalidade,
                        $validade,
                        '{$documento->getTipoDocumento()}',
                        $uf,
                        $caminho
                    );";

        $dados['resultado'] =  mysqli_query($this->conexao, $query);
        $dados['documentosId'] =  mysqli_insert_id($this->conexao);

        return $dados;
    }
}
