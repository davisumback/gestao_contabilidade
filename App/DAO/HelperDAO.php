<?php

namespace App\DAO;
use App\Config\BancoConfig;

class HelperDAO{
    private $conexao;

    function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function verificaEmpresaSemEmail()
    {
        $query = "  SELECT
                            id
                    FROM
                            empresas
                    WHERE
                            id NOT IN (SELECT empresas_id FROM empresas_emails);";

        $retorno = mysqli_query($this->conexao, $query);
        $empresa = array();

        while($linha = mysqli_fetch_assoc($retorno)){
            $empresa[] = $linha;
        }

        return $empresa;
    }

    public function verificaSocioAdministrador($condicao = 'IS NULL')
    {
        $query =    "SELECT
                    	COUNT(empresas_id) as quantidade, empresas_id
                    FROM
                    	clientes_empresas
                    WHERE
                    	socio_administrador $condicao
                    group by
                    	empresas_id
                    having
                    	count(*) > 1;";

        $retorno = mysqli_query($this->conexao, $query);
        $duplicidade = array();

        while($linha = mysqli_fetch_assoc($retorno)){
            $duplicidade[] = $linha;
        }

        return $duplicidade;
    }

    public function cancelaInsercao($tabela, $id, $nomeId = 'id')
    {
        $query = "DELETE FROM $tabela WHERE $nomeId = $id;";

        return mysqli_query($this->conexao, $query);
    }
}
