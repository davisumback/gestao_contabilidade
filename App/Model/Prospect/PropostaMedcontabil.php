<?php
namespace App\Model\Prospect;

use App\Config\BancoConfig;

class PropostaMedcontabil
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function getQuantidadePropostasEnviadas($usuarioNomeCompleto)
    {
        $query = "SELECT count(id) as quantidade FROM propostas_medcontabil WHERE nome_usuario = '$usuarioNomeCompleto';";
        $retorno = \mysqli_query($this->conexao, $query);

        return \mysqli_fetch_assoc($retorno);
    }
}
