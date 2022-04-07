<?php
namespace App\Model\Pipedrive;

use Devio\Pipedrive\Pipedrive;
use App\Config\Pipedrive\ApiPipedriveConfig;

class User
{
    private $camposUser = array();

    public function __construct()
    {
        $this->camposUser["id"] = "fb1ffe8fe7180aef73596b9d3060cebda2de5032";
    }

    public function getUser($userId)
    {
        $token = ApiPipedriveConfig::TOKEN;
        $pipedrive = new Pipedrive($token);
        $users = $pipedrive->users()->find($userId);

        // $this->organization = $users->getContent();

        return $users->getContent();
    }

    public function getCamposUser()
    {
        return $this->camposUser;
    }
}
