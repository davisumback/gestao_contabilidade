<?php

namespace App\DAO;
use App\Config\BancoConfig;

class ClienteEmpresaDAO
{
    private $conexao;

    function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function getSocios($numeroEmpresa)
    {
        $query = "  SELECT
                    	cli_emp.clientes_id, cli_emp.empresas_id, cli_emp.porcentagem_societaria, cli.nome_completo, cli.cpf, cli.socio_administrador
                    FROM
                    	clientes_empresas as cli_emp
                    LEFT JOIN
                    	clientes as cli
                    ON
                    	cli_emp.clientes_id = cli.id
                    WHERE cli_emp.empresas_id = $numeroEmpresa;
                ;";
        $empresas = array();
        $retorno = mysqli_query($this->conexao, $query);
        while($empresa = mysqli_fetch_assoc($retorno)){
            $empresas[] = $empresa;
        }

        return $empresas;
    }

    public function insereClienteEmpresaNew($clientesId, $empresasId, $porcentagemSocietaria, $socioAdministrador)
    {
        $query = "  INSERT INTO clientes_empresas (clientes_id, empresas_id, porcentagem_societaria, socio_administrador)
                    VALUES(
                        $clientesId,
                        $empresasId,
                        $porcentagemSocietaria,
                        $socioAdministrador
                    );";

        return mysqli_query($this->conexao, $query);
    }

    public function insereClienteEmpresa($clientesId, $empresasId, $porcentagemSocietaria)
    {
        $query = "  INSERT INTO clientes_empresas (clientes_id, empresas_id, porcentagem_societaria)
                    VALUES(
                        $clientesId,
                        $empresasId,
                        $porcentagemSocietaria
                    );";

        return mysqli_query($this->conexao, $query);
    }
}
