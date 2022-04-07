<?php
namespace App\Model\ValueObject;

use App\Helper\Helpers;

class Cep
{
    private $cep;

    public function __construct($cep)
    {
        $this->cep = Helpers::formataCepBd($cep);
    }

    public function getCep()
    {
        return $this->cep;
    }
}
