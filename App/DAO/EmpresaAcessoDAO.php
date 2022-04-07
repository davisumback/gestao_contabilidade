<?php

namespace App\DAO;
use App\Config\BancoConfig;

class EmpresaAcessoDAO{
    private $conexao;

    function __construct(){
        $this->conexao = BancoConfig::conecta();
    }

    public function insereAcesso($empresasId, $site, $login, $senha){
        $query = "  INSERT INTO empresas_acessos(
                        login, senha, site, empresas_id
                    ) VALUES (
                        '{$login}',
                        '{$senha}',
                        '{$site}',
                        $empresasId
                    );";

        return mysqli_query($this->conexao, $query);
    }


    public function getAcessos($empresasId){
        $query = "SELECT * FROM empresas_acessos WHERE empresas_id = $empresasId;";
        $retorno = mysqli_query($this->conexao, $query);

        $acessos = array();
        while($acesso = mysqli_fetch_assoc($retorno)){
            $acessos[] = $acesso;
        }

        return $acessos;
    }
}
