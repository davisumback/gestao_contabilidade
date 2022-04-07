<?php
namespace App\Model\Empresa;

abstract class RegimeTributarioEspecial 
{
    const semRegimeTributarioEspecial = 0;
    const microEmpresaMunicipal = 1;
    const estimativa = 2;
    const sociedadeDeProfissionais = 3;
    const cooperativa = 4;
    const microempresarioIndividual = 5;
    const microempresaOuPequenoPorte = 6;
}