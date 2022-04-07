<?php
namespace App\Model\Empresa;

abstract class RegimeTributario 
{
    const nenhum = 0;
    const simplesNacional = 1;
    const simplesNacionalExcesso = 2;
    const sormalLucroPresumido = 3;
    const normalLucroReal = 4;
}