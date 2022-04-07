<?php

namespace App\System;

class VerificaGuiaPresumido{
    private $empresasComGuias = array();
    private $empresasAptas = array();

    public function __construct($empresasGuias)
    {
        $this->setArrayEmpresasComGuias($empresasGuias);
        $this->setArrayEmpresasAptasParaEmail();
    }

    public function setArrayEmpresasComGuias($empresasGuias)
    {
        foreach ($empresasGuias as $empresa ) {
            $this->empresasComGuias[] = $empresa['id'];
        }
    }

    public function setArrayEmpresasAptasParaEmail()
    {
        $numeroDeGuiasPresumido = 9;
        $retorno = array_count_values($this->empresasComGuias);

        foreach ($retorno as $chave => $valor) {
            if($valor >= $numeroDeGuiasPresumido) {
                $this->empresasAptas[] = $chave;
            }
        }
    }

    public function getEmpresasAptasParaEmail()
    {
        return $this->empresasAptas;
    }
}
