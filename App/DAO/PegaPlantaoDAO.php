<?php

namespace App\DAO;

use App\Config\BancoConfigPDO;
use App\Model\PegaPlantao\PegaPlantao;

class PegaPlantaoDAO{
	
    public static function create(PegaPlantao $pegaPlantao){

    	$sql = "INSERT INTO pega_plantao(ProfissionalPlantao,InicioPlantao,FimPlantao,Valor,Descricao,CodigoProfissinalFixo,CodigoProfissionalPlantao,CreatedAt,Parceiro)";
    	$sql .= "VALUES (:ProfissionalPlantao, :InicioPlantao, :FimPlantao, :Valor, :Descricao, :CodigoProfissinalFixo, :CodigoProfissionalPlantao, :CreatedAt, :Parceiro)";

    	$date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

    	$sth = BancoConfigPDO::conecta()->prepare($sql);
    	$sth->bindValue(":ProfissionalPlantao", $pegaPlantao->getProfissionalDePlantao(), \PDO::PARAM_STR);
    	$sth->bindValue(":InicioPlantao", $pegaPlantao->getInicio(), \PDO::PARAM_STR);
    	$sth->bindValue(":FimPlantao", $pegaPlantao->getFim(), \PDO::PARAM_STR);
    	$sth->bindValue(":Valor", $pegaPlantao->getValor(), \PDO::PARAM_STR);
    	$sth->bindValue(":Descricao", $pegaPlantao->getDescricao(), \PDO::PARAM_STR);
    	$sth->bindValue(":CodigoProfissinalFixo", $pegaPlantao->getCodigoProfissionalFixo(), \PDO::PARAM_STR);
    	$sth->bindValue(":CodigoProfissionalPlantao", $pegaPlantao->getCodigoProfissionalDePlantao(), \PDO::PARAM_STR);
		$sth->bindValue(":CodigoProfissionalPlantao", $pegaPlantao->getCodigoProfissionalDePlantao(), \PDO::PARAM_STR);
		$sth->bindValue(":Parceiro", $pegaPlantao->getParceiro()->getId(), \PDO::PARAM_STR);
		$sth->bindValue(":CreatedAt", $now, \PDO::PARAM_STR);

    	$sth->execute();
    }
}

