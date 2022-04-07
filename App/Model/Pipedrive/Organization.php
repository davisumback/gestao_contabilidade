<?php
namespace App\Model\Pipedrive;

use Devio\Pipedrive\Pipedrive;
use App\Config\Pipedrive\ApiPipedriveConfig;

class Organization
{
    private $camposOrganization = array();

    public function __construct()
    {
        $this->camposOrganization["id"] = "fb1ffe8fe7180aef73596b9d3060cebda2de5032";
    }

    public function getOrganization($organizationId)
    {
        $token = ApiPipedriveConfig::TOKEN;
        $pipedrive = new Pipedrive($token);
        $organizations = $pipedrive->organizations()->find($organizationId);

        $this->organization = $organizations->getContent();

        return $this->organization;
    }

    public function getCamposOrganization()
    {
        return $this->camposOrganization;
    }
}
