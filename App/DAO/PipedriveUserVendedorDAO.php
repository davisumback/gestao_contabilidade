<?php

namespace App\DAO;
use App\Config\BancoConfig;

class PipedriveUserVendedorDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function getIdVendendor($userIdPipedrive)
    {
        $query = "SELECT usuarios_id FROM pipedrive_users_vendedores WHERE user_pipedrive_id = $userIdPipedrive;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }
}
