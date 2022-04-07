<?php

namespace App\System;

use App\Email\EnviaEmail;
use App\Helper\Helpers;

class EnviaGuiasMes{
    private $guiaDao;
    private $empresasPendentes = array();
    private $anexos = array();
    private $caminhoBase = '/var/www/html/medb/grupobfiles/empresas/';

    public function __construct($guiaDao, $empresasPendentes){
        $this->guiaDao = $guiaDao;
        $this->empresasPendentes = $empresasPendentes;
    }

    public function setAnexos($empresasId, $dataCompetencia){
        $pasta = Helpers::formataDataPasta($dataCompetencia);
        $this->caminhoBase .= $empresasId . '/impostos' .'/'. $pasta .'/';

        $retorno = $this->guiaDao->getNomeGuiasAnexo($dataCompetencia, $empresasId);

        foreach ($retorno as $valorArray) {
            $this->anexos[] = $this->caminhoBase . $valorArray['nome_guia'];
        }
    }

    public function enviaEmail(){
        echo '<pre>';
        print_r($this->empresasPendentes);
        echo '</pre>';


        foreach ($this->empresasPendentes as $valor){
            $this->setAnexos($valor['empresas_id'], $valor['data_competencia']);
        }

        echo '<pre>';
        print_r($this->anexos);
        echo '</pre>';
        die();

        $cliente = $this->empresasPendentes[0];
        return EnviaEmail::enviaEmail(
            $cliente['email'],
            $cliente['nome_completo'],
            'Guias do Mês',
            'Teste de Corpo de Guia',
            'thiagogaia@msn.com',
            $this->anexos
        );
    }
}
