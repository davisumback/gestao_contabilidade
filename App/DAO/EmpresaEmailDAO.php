<?php

namespace App\DAO;

use App\Config\BancoConfig;

class EmpresaEmailDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function isEmailExistente($empresasId, $email)
    {
        $query = "SELECT email FROM empresas_emails WHERE email = '$email' AND empresas_id = $empresasId;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function deletaEmailEmpresa($id)
    {
        $query = "DELETE FROM empresas_emails WHERE id = '$id';";

        return mysqli_query($this->conexao, $query);
    }

    public function updateEmailEmpresa($id, $email)
    {
        $query = "UPDATE empresas_emails SET email = '$email' WHERE id = $id;";

        return mysqli_query($this->conexao, $query);
    }

    public function insereEmailEmpresa($empresasId, $gestorId, $email)
    {
        $query = "INSERT INTO empresas_emails (empresas_id, usuarios_id, email) VALUES ($empresasId, $gestorId, '$email');";

        return mysqli_query($this->conexao, $query);
    }

    public function getEmpresaEmails($empresasId)
    {
        $query = "SELECT
                    	email, id
                    FROM
                    	empresas_emails
                    WHERE
                    	empresas_id = $empresasId;";

        $retorno = mysqli_query($this->conexao, $query);
        $saida = [];

        while ($linha = mysqli_fetch_assoc($retorno)) {
            $saida[] = $linha;
        }

        return $saida;
    }

    public function getEmpresaEmail($empresasId)
    {
        $query = "SELECT
                    	e.vinculo, ee.empresas_id, ee.email, e.nome_empresa as nome_completo, u.email as email_gestor, u.id as gestorId
                    FROM
                    	empresas_emails ee
                    LEFT JOIN
                    	empresas as e
                    ON
                    	ee.empresas_id = e.id
                    LEFT JOIN
                    	gestores_empresas as ge
                    ON
                    	ee.empresas_id = ge.empresas_id
                    LEFT JOIN
                    	usuarios as u
                    ON
                    	ge.usuarios_id = u.id
                    WHERE
                    	ee.empresas_id = $empresasId;";

        $retorno = mysqli_query($this->conexao, $query);
        $saida = [];

        while ($linha = mysqli_fetch_assoc($retorno)) {
            $saida[] = $linha;
        }

        return $saida;
    }
}