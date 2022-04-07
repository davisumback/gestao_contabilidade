<?php

namespace App\System;

class VerificaGuiasSn{
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
        $retorno = array_count_values($this->empresasComGuias);

        foreach ($retorno as $chave => $valor) {
            if ($valor >= 5) {
                // salvar na tabela que a empresa está sem guias para esse mês
                $this->empresasAptas[] = $chave;
            }
        }
    }

    public function getEmpresasAptasParaEmail()
    {
        return $this->empresasAptas;
    }
}
