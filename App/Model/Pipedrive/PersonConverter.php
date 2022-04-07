<?php
namespace App\Model\Pipedrive;

use App\Model\Pipedrive\Person;
use App\Model\Pipedrive\Organization;

class PersonConverter
{
    private $personObj;
    private $camposPerson;

    public function __construct($personObj)
    {
        $person = new Person();
        $this->camposPerson = $person->getCamposPerson();
        $this->personObj = $personObj;
    }

    public function converterPersonToCliente()
    {
        $camposFormatados = array();

        foreach ($this->camposPerson as $chave => $tokenCampo) {
            foreach ($this->personObj->data as $key => $value) {

                if ($tokenCampo == $key && $chave == 'ies') {
                    $camposFormatados[$chave] = $value->value;
                } else if ($tokenCampo == $key && $chave == 'plano') {
                    $camposFormatados[$chave] = $value->value;
                } else if ($tokenCampo == $key) {
                    $camposFormatados[$chave] = $value;
                }
            }
        }

        $camposFormatados['email'] = $this->personObj->data->email[0]->value;
        $camposFormatados['telefone'] = $this->personObj->data->phone[0]->value;
        $camposFormatados['vendedor'] = $this->personObj->data->owner_id->id;

        $organization = new Organization();

        $ies = $organization->getOrganization($camposFormatados['ies']);
        $camposOrganization = $organization->getCamposOrganization();
        $idOrganizationPipedrive = $camposOrganization['id'];
        $camposFormatados['ies_id'] = $ies->data->$idOrganizationPipedrive;

        $plano = $organization->getOrganization($camposFormatados['plano']);
        $camposOrganization = $organization->getCamposOrganization();
        $idOrganizationPipedrive = $camposOrganization['id'];
        $camposFormatados['planos_id'] = $plano->data->$idOrganizationPipedrive;

        return $camposFormatados;
    }
}
