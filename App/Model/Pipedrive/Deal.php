<?php
namespace App\Model\Pipedrive;

class Deal
{
    private $dealJson;

    public function __construct($dealJson)
    {
        $this->dealJson = json_decode($dealJson);
    }

    public function isWonDeal()
    {
        return ($this->dealJson->current->status == 'won') ? true : false;
    }

    public function getDealJson()
    {
        return $this->dealJson;
    }
}
