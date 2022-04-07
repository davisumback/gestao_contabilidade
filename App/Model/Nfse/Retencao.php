<?php
namespace App\Model\Nfse;

class Retencao
{
    public $pis;
    public $cofins;
    public $csll;
    public $inss;
    public $irrf;

    public function setPis($pis)
    {
        $this->pis = $pis;
    }

    public function setCofins($cofins)
    {
        $this->cofins = $cofins;
    }

    public function setCsll($csll)
    {
        $this->csll = $csll;
    }

    public function setInss($inss)
    {
        $this->inss = $inss;
    }

    public function setIrrf($irrf)
    {
        $this->irrf = $irrf;
    }
}