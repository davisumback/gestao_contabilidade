<?php
namespace App\DAO;

use App\Model\Empresa\Certificado;

class CertificadoDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = \App\Config\BancoConfigPDO::conecta();
    }

    public function all()
    {
        $query = 'SELECT * FROM empresas_certificados ORDER BY validade ASC';

        $sth = $this->conexao->prepare($query);
        $sth->execute();
        $certificadosBd = $sth->fetchAll(\PDO::FETCH_OBJ);
        $certificados = [];

        foreach ($certificadosBd as $certificadoBd) {
            $certificado = new Certificado();
            $certificado->setEmpresasId($certificadoBd->empresas_id);
            $certificado->setArquivo($certificadoBd->arquivo);
            $certificado->setSenha($certificadoBd->senha);
            $certificado->setValidade($certificadoBd->validade);
            $certificado->setIdIntegracao($certificadoBd->id_integracao);

            $certificados[] = $certificado;
        }

        return $certificados;
    }
}