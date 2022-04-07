<?php

namespace App\DAO;

use App\Config\BancoConfigPDO;
use App\Model\PegaPlantao\PegaPlantaoParceiro;

class PegaPlantaoParceiroDAO{
	
    public static function all(){
        $sql = "SELECT * FROM pega_plantao_parceiro WHERE Situacao='A'";
        $sth = BancoConfigPDO::conecta()->prepare($sql);
        $sth->execute();
        $parceiros = array();
        while ($pegaPlantaoParceiroDB = $sth->fetch(\PDO::FETCH_OBJ)) {
            $pegaPlantaoParceiro = new PegaPlantaoParceiro;
            $pegaPlantaoParceiro->setId($pegaPlantaoParceiroDB->Id)
            ->setCodigo($pegaPlantaoParceiroDB->Codigo)
            ->setNome($pegaPlantaoParceiroDB->Nome)
            ->setUrl($pegaPlantaoParceiroDB->Url)
            ->setToken($pegaPlantaoParceiroDB->Token)
            ->setSituacao($pegaPlantaoParceiroDB->Situacao);

            $parceiros[] = $pegaPlantaoParceiro;
        }
        
        return $parceiros;
    }

    public static function find($id){
        $sql = "SELECT * FROM pega_plantao_parceiro WHERE Situacao='A' AND Id=:Id";
        $sth = BancoConfigPDO::conecta()->prepare($sql);
        $sth->bindValue(":Id", $id, \PDO::PARAM_STR);
        $sth->execute();
        
        $pegaPlantaoParceiroDB = $sth->fetch(\PDO::FETCH_OBJ);
        $pegaPlantaoParceiro = new PegaPlantaoParceiro;
        $pegaPlantaoParceiro->setId($pegaPlantaoParceiroDB->Id)
        ->setCodigo($pegaPlantaoParceiroDB->Codigo)
        ->setNome($pegaPlantaoParceiroDB->Nome)
        ->setUrl($pegaPlantaoParceiroDB->Url)
        ->setToken($pegaPlantaoParceiroDB->Token)
        ->setSituacao($pegaPlantaoParceiroDB->Situacao);

        return $pegaPlantaoParceiro;
    }
}