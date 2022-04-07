<?php

namespace App\System;

use App\Email\EmailGuiasMedcontabil;
use App\Helper\Helpers;

class EnviaGuiasMedcontabil
{
    private $guiaDao;
    private $empresasPendentes;
    private $anexos = array();
    private $caminhoBase = '/var/www/html/grupob/grupobfiles/empresas/';
    private $dataCompetencia;

    public function __construct($guiaDao, $empresasPendentes, $dataCompetencia)
    {
        $this->guiaDao = $guiaDao;
        $this->empresasPendentes = $empresasPendentes;
        $this->dataCompetencia = $dataCompetencia;
    }

    public function setAnexos($empresasId, $dataCompetencia)
    {
        $pasta = Helpers::formataDataPasta($dataCompetencia);
        $this->caminhoBase .= $empresasId . '/impostos' .'/'. $pasta .'/';

        $retorno = $this->guiaDao->getNomeGuiasAnexo($dataCompetencia, $empresasId);

        foreach ($retorno as $valorArray) {
            $this->anexos[] = $this->caminhoBase . $valorArray['nome_guia'];
        }
    }

    public function enviaEmail($corpoEmail, $emails)
    {
        $this->setAnexos($this->empresasPendentes['empresas_id'], $this->dataCompetencia);

        return EmailGuiasMedcontabil::enviaEmail(
            $this->empresasPendentes['email'],
            $this->empresasPendentes['nome_completo'],
            'Guias do Mês',
            $corpoEmail,
            $this->empresasPendentes['email_gestor'],
            $this->anexos,
            $emails
        );
    }
}
