<?php

namespace App\DAO;

use App\Config\BancoConfigPDO;
use App\Model\PegaPlantao\PegaPlantaoLog;
use App\DAO\PegaPlantaoParceiroDAO;

class PegaPlantaoLogDAO{
	
    public static function create(PegaPlantaoLog $pegaPlantaoLog){

    	$sql = "INSERT INTO pega_plantao_log(Descricao,CreatedAt, Parceiro) VALUES (:Descricao, :CreatedAt, :Parceiro)";

    	$date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

    	$sth = BancoConfigPDO::conecta()->prepare($sql);
        $sth->bindValue(":Descricao", $pegaPlantaoLog->getDescricao(), \PDO::PARAM_STR);
        $sth->bindValue(":Parceiro", $pegaPlantaoLog->getParceiro()->getId(), \PDO::PARAM_STR);
    	$sth->bindValue(":CreatedAt", $now, \PDO::PARAM_STR);

    	$sth->execute();
    }

    public static function all(){
        $sql = "SELECT * FROM pega_plantao_log ORDER BY CreatedAt DESC";
        $sth = BancoConfigPDO::conecta()->prepare($sql);
        $sth->execute();

        $logs = array();
        while ($pegaPlantaoLogDB = $sth->fetch(\PDO::FETCH_OBJ)) {
            $pegaPlantaoLog = new PegaPlantaoLog;
            $pegaPlantaoLog->setId($pegaPlantaoLogDB->id)
            ->setDescricao($pegaPlantaoLogDB->Descricao)
            ->setParceiro(PegaPlantaoParceiroDAO::find($pegaPlantaoLogDB->Parceiro))
            ->setCreatedAt($pegaPlantaoLogDB->CreatedAt);
            $logs[] = $pegaPlantaoLog;
        }
        return $logs;
    }
}