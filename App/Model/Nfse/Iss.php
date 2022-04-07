<?php
namespace App\Model\Nfse;

class Iss
{
    public $aliquota;

    public function __construct($aliquota)
    {
        $this->aliquota = \intval($aliquota);
    }
}