<?php
namespace App\DAO;
use App\Config\BancoConfig;

class EmailMarketingCampanhaDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function getEmailsAEnviarIrpf()
    {
        $query = "SELECT 
                    c.id, c.email, c.nome_completo
                FROM 
                    imposto_renda_direcionamento as i
                LEFT JOIN
                    clientes as c
                ON
                    i.cpf = c.cpf;";

        $clientes = [];
        $retorno = mysqli_query($this->conexao, $query);

        while ($linha = mysqli_fetch_assoc($retorno)) {
            $clientes[] = $linha;
        }

        return $clientes;
    }

    public function updateEmails($clientesId, $campanha)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "UPDATE emailsmarketing_campanhas SET email_enviado = 'ENVIADO', enviado_at = '$now' WHERE clientes_id = $clientesId AND campanha = '$campanha';";

        return mysqli_query($this->conexao, $query);
    }

    public function insereEmails($clientesId, $emailCliente, $nome, $campanha)
    {
        if ($this->isEmailExistente($clientesId, $campanha) != null ) {
            return;
        }

        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query =    "INSERT INTO emailsmarketing_campanhas (
                        clientes_id, email_cliente, created_at, email_enviado, campanha, nome
                    )VALUES(
                        $clientesId, '$emailCliente', '$now', 'PENDENTE', '$campanha', '$nome'
                    );";

        return mysqli_query($this->conexao, $query);
    }

    public function isEmailExistente($clientesId, $campanha)
    {
        $query = "SELECT * FROM emailsmarketing_campanhas WHERE clientes_id = $clientesId AND campanha = '$campanha';";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function getEmailsPendentes($campanha)
    {
        $query = "SELECT
                    ird.*, email_cliente, nome, campanha, clientes_id 
                FROM 
                    emailsmarketing_campanhas 
                LEFT JOIN
                    clientes as c
                ON
                    emailsmarketing_campanhas.clientes_id = c.id
                LEFT JOIN
                    imposto_renda_direcionamento as ird
                ON
                    c.cpf = ird.cpf
                WHERE 
                    email_enviado = 'PENDENTE' 
                AND 
                    campanha = '$campanha'
                LIMIT 2;";

        $emails = [];
        $retorno = mysqli_query($this->conexao, $query);

        while ($linha = mysqli_fetch_assoc($retorno)) {
            $emails[] = $linha;
        }

        return $emails;
    }
}
