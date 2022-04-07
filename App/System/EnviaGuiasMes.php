<?php

namespace App\System;

use App\Email\EmailGuiasSn;
use App\Helper\Helpers;

class EnviaGuiasMes
{
    private $guiaDao;
    private $empresasPendentes;
    private $anexos = array();
    private $caminhoBase = '/var/www/html/medb/admin/grupobfiles/empresas/';

    public function __construct($guiaDao, $empresasPendentes)
    {
        $this->guiaDao = $guiaDao;
        $this->empresasPendentes = $empresasPendentes;
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

    public function enviaEmail($corpoEmail)
    {
        $this->setAnexos($this->empresasPendentes['empresas_id'], $this->empresasPendentes['data_competencia']);

        return EmailGuiasSn::enviaEmail(
            $this->empresasPendentes['email'],
            $this->empresasPendentes['nome_completo'],
            'Guias do Mês',
            $corpoEmail,
            $this->empresasPendentes['email_gestor'],
            $this->anexos
        );
    }
}
