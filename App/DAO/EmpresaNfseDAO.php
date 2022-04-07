<?php
namespace App\DAO;

class EmpresaNfseDAO
{
    private $conexao;
    
    public function __construct()
    {
        $this->conexao = \App\Config\BancoConfigPDO::conecta();
    }

    public function setCancelada(\App\Model\Nfse\NotaFiscalWebhook $notaFiscal)
    {
        $date = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "UPDATE empresas_nfse
                SET
                    prestador = :prestador,
                    tomador = :tomador,
                    numero_nfse = :numeroNfse,
                    status = :status,
                    updated_at = :updatedAt,
                    serie = :serie,
                    lote = :lote,
                    cancelada_at = :canceladaAt,
                    arquivo = :arquivo
                WHERE
                    id_tecnospeed = :idTecnospeed;";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':prestador', $notaFiscal->getPrestador(), \PDO::PARAM_STR); 
        $sth->bindValue(':tomador', $notaFiscal->getTomador(), \PDO::PARAM_STR); 
        $sth->bindValue(':numeroNfse', $notaFiscal->getNumeroNfse(), \PDO::PARAM_STR);
        $sth->bindValue(':status', $notaFiscal->getSituacao(), \PDO::PARAM_STR);
        $sth->bindValue(':updatedAt', $now, \PDO::PARAM_STR);
        $sth->bindValue(':serie', $notaFiscal->getSerie(), \PDO::PARAM_STR);
        $sth->bindValue(':lote', $notaFiscal->getLote(), \PDO::PARAM_STR);
        $sth->bindValue(':idTecnospeed', $notaFiscal->getId(), \PDO::PARAM_STR);
        $sth->bindValue(':canceladaAt', $notaFiscal->getCancelamento(), \PDO::PARAM_STR);
        $sth->bindValue(':arquivo', $notaFiscal->getArquivo(), \PDO::PARAM_STR);
        $sth->execute();
    }

    public function setProcessando($idTecnospeed, $mensagem, $protocol)
    {
        $date = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "UPDATE empresas_nfse
                SET
                    status = :status,
                    mensagem = :mensagem,
                    protocol = :protocol,
                    updated_at = :updatedAt
                WHERE
                    id_tecnospeed = :idTecnospeed;";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':status', 'PROCESSANDO', \PDO::PARAM_STR);
        $sth->bindValue(':mensagem', $mensagem, \PDO::PARAM_STR);
        $sth->bindValue(':protocol', $protocol, \PDO::PARAM_STR);
        $sth->bindValue(':updatedAt', $now, \PDO::PARAM_STR);
        $sth->bindValue(':idTecnospeed', $idTecnospeed, \PDO::PARAM_STR);
        $sth->execute();
    }

    public function updateInfos(\App\Model\Nfse\NotaFiscalWebhook $notaFiscal)
    {
        $date = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "UPDATE empresas_nfse
                SET
                    prestador = :prestador,
                    tomador = :tomador,
                    numero_nfse = :numeroNfse,
                    status = :status,
                    updated_at = :updatedAt,
                    serie = :serie,
                    lote = :lote,
                    emissao = :emissao,
                    arquivo = :arquivo
                WHERE
                    id_tecnospeed = :idTecnospeed;";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':prestador', $notaFiscal->getPrestador(), \PDO::PARAM_STR); 
        $sth->bindValue(':tomador', $notaFiscal->getTomador(), \PDO::PARAM_STR); 
        $sth->bindValue(':numeroNfse', $notaFiscal->getNumeroNfse(), \PDO::PARAM_STR);
        $sth->bindValue(':status', $notaFiscal->getSituacao(), \PDO::PARAM_STR);
        $sth->bindValue(':updatedAt', $now, \PDO::PARAM_STR);
        $sth->bindValue(':serie', $notaFiscal->getSerie(), \PDO::PARAM_STR);
        $sth->bindValue(':lote', $notaFiscal->getLote(), \PDO::PARAM_STR);
        $sth->bindValue(':idTecnospeed', $notaFiscal->getId(), \PDO::PARAM_STR);
        $sth->bindValue(':emissao', $notaFiscal->getEmissao(), \PDO::PARAM_STR);
        $sth->bindValue(':arquivo', $notaFiscal->getArquivo(), \PDO::PARAM_STR);
        $sth->execute();
    }

    public function getNotasPendentes()
    {
        $query = "SELECT id_tecnospeed, empresas_id FROM empresas_nfse WHERE status = 'AGENDADO' OR status = 'PROCESSANDO' LIMIT 5;";
        $sth = $this->conexao->prepare($query);
        $sth->execute();
        $objetos = $sth->fetchAll(\PDO::FETCH_OBJ);
        $saida = [];

        foreach ($objetos as $nota) {
            $notaFiscal = new \App\Model\Nfse\NotaFiscalWebhook();
            $notaFiscal->setId($nota->id_tecnospeed);
            $notaFiscal->setEmpresasId($nota->empresas_id);
            $saida[] = $notaFiscal;
        }

        return $saida;
    }

    public function getNotasConcluidas($data)
    {
        $query = "SELECT id_tecnospeed, empresas_id FROM empresas_nfse WHERE status = 'CONCLUIDO' AND MONTH(created_at) = MONTH(:dataEntrada)";
        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':dataEntrada', $data, \PDO::PARAM_STR); 
        $sth->execute();
        $objetos = $sth->fetchAll(\PDO::FETCH_OBJ);
        $saida = [];

        foreach ($objetos as $nota) {
            $notaFiscal = new \App\Model\Nfse\NotaFiscalWebhook();
            $notaFiscal->setId($nota->id_tecnospeed);
            $notaFiscal->setEmpresasId($nota->empresas_id);
            $saida[] = $notaFiscal;
        }

        return $saida;
    }

    public function updateArquivo($idTecnospeed, $caminhoPasta)
    {
        $query = "UPDATE empresas_nfse SET arquivo = :arquivo WHERE id_tecnospeed = :idTecnospeed; ";
        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':idTecnospeed', $idTecnospeed, \PDO::PARAM_STR);
        $sth->bindValue(':arquivo', $caminhoPasta, \PDO::PARAM_STR);
        $sth->execute();
    }

    public function getEmpresasId($idTecnospeed)
    {
        $query = "SELECT empresas_id FROM empresas_nfse WHERE id_tecnospeed = :idTecnospeed;";
        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':idTecnospeed', $idTecnospeed, \PDO::PARAM_STR);
        $sth->execute();
        $retorno = $sth->fetchAll(\PDO::FETCH_ASSOC);

        if ($retorno != null) {
            return $retorno[0]['empresas_id'];
        }

        return null;
    }

    public function updateStatus(\App\Model\Nfse\NotaFiscalWebhook $notaFiscal)
    {
        $date = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "UPDATE empresas_nfse
                SET
                    prestador = :prestador,
                    tomador = :tomador,
                    numero_nfse = :numeroNfse,
                    status = :status,
                    updated_at = :updatedAt,
                    serie = :serie,
                    lote = :lote,
                    codigo_verificacao = :codigoVerificacao,
                    data_autorizacao = :dataAutorizacao,
                    mensagem_retorno = :mensagemRetorno,
                    emissao = :emissao,
                    arquivo = :arquivo
                WHERE
                    id_tecnospeed = :idTecnospeed;";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':prestador', $notaFiscal->getPrestador(), \PDO::PARAM_STR); 
        $sth->bindValue(':tomador', $notaFiscal->getTomador(), \PDO::PARAM_STR); 
        $sth->bindValue(':numeroNfse', $notaFiscal->getNumeroNfse(), \PDO::PARAM_STR);
        $sth->bindValue(':status', $notaFiscal->getSituacao(), \PDO::PARAM_STR);
        $sth->bindValue(':updatedAt', $now, \PDO::PARAM_STR);
        $sth->bindValue(':serie', $notaFiscal->getSerie(), \PDO::PARAM_STR);
        $sth->bindValue(':lote', $notaFiscal->getLote(), \PDO::PARAM_STR);
        $sth->bindValue(':codigoVerificacao', $notaFiscal->getCodigoVerificacao(), \PDO::PARAM_STR);
        $sth->bindValue(':dataAutorizacao', $notaFiscal->getDataAutorizacao(), \PDO::PARAM_STR);
        $sth->bindValue(':mensagemRetorno', $notaFiscal->getMensagemRetorno(), \PDO::PARAM_STR);
        $sth->bindValue(':idTecnospeed', $notaFiscal->getId(), \PDO::PARAM_STR);
        $sth->bindValue(':emissao', $notaFiscal->getEmissao(), \PDO::PARAM_STR);
        $sth->bindValue(':arquivo', $notaFiscal->getArquivo(), \PDO::PARAM_STR);
        $sth->execute();
    }

    public function inserePrimeiroRetorno($empresasId, $idTecnospeed, $protocol, $mensagem, $valorNota)
    {
        $date = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO empresas_nfse (
                    empresas_id, id_tecnospeed, status, protocol, mensagem, created_at, valor_nota
                ) VALUES (
                    :empresasId, :idTecnospeed, :status, :protocol, :mensagem, :created_at, :valorNota
                );";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->bindValue(':idTecnospeed', $idTecnospeed, \PDO::PARAM_STR);
        $sth->bindValue(':status', 'PROCESSANDO', \PDO::PARAM_STR);
        $sth->bindValue(':protocol', $protocol, \PDO::PARAM_STR);
        $sth->bindValue(':mensagem', $mensagem, \PDO::PARAM_STR);
        $sth->bindValue(':created_at', $now, \PDO::PARAM_STR);
        $sth->bindValue(':valorNota', $valorNota, \PDO::PARAM_STR);
        $sth->execute();
    }

    public function getUltimasNotas($empresasId, $limite)
    {
        $query = "SELECT * FROM empresas_nfse WHERE empresas_id = :empresasId LIMIT :limite";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->bindValue(':limite', $limite, \PDO::PARAM_INT);
        $sth->execute();
        
        $objetosPadroes = $sth->fetchAll(\PDO::FETCH_OBJ);
        $objetos = [];

        foreach ($objetosPadroes as $object) {
            $notaFiscal = new \App\Model\Nfse\NotaFiscalWebhook();
            $notaFiscal->setId($object->id);
            $notaFiscal->setEmpresasId($object->empresas_id);
            $notaFiscal->setSituacao($object->status);
            $notaFiscal->setValor($object->valor_nota);
            $notaFiscal->setEmissao($object->created_at);
            $notaFiscal->setPdf($object->arquivo);

            $objetos[] = $notaFiscal;
        }

        return $objetos;
    }

    public function getAllMes($empresasId, $mes, $ano)
    {
        $query = "SELECT * FROM empresas_nfse WHERE empresas_id = :empresasId AND MONTH(created_at) = :mes AND YEAR(created_at) = :ano;";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->bindValue(':mes', $mes, \PDO::PARAM_STR);
        $sth->bindValue(':ano', $ano, \PDO::PARAM_STR);
        $sth->execute();
        
        $objetosPadroes = $sth->fetchAll(\PDO::FETCH_OBJ);
        $objetos = [];

        foreach ($objetosPadroes as $object) {
            $notaFiscal = new \App\Model\Nfse\NotaFiscalWebhook();
            $notaFiscal->setId($object->id);
            $notaFiscal->idTecnospeed = $object->id_tecnospeed;
            $notaFiscal->setEmpresasId($object->empresas_id);
            $notaFiscal->setSituacao($object->status);
            $notaFiscal->setValor($object->valor_nota);
            $notaFiscal->setEmissao($object->created_at);
            $notaFiscal->setPdf($object->arquivo);

            $objetos[] = $notaFiscal;
        }

        return $objetos;
    }
}