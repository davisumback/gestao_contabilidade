<?php
namespace App\Model\Pipedrive;

use App\Config\Pipedrive\ApiPipedriveConfig;
use Devio\Pipedrive\Pipedrive;

class Person
{
    private $camposPerson = array();
    private $camposVazios = array();
    private $person;
    private $sincronizado = 'a4f88b10c8fb98f7bd09c536b38dfa9fbd454a4b';

    public function __construct()
    {
        $this->camposPerson["cpf"] = "18565a05ef1b9761ff069266b28f568b9de43c0b";
        $this->camposPerson["crm"] = "7c0eacf0888ecba39f91121ee1519bab756cb4f9";
        $this->camposPerson["primeira_mensalidade"] = "763fc66ec457ce63b4dfc918c882ee097855a0c0";
        $this->camposPerson["nome_1"] = "f5835625f29a6bf3fc12697869881ea1b60a8f98";
        $this->camposPerson["nome_2"] = "a300da9c9c2a64a0780303fb8d3b4a319435eace";
        $this->camposPerson["nome_3"] = "bc96f1b510687cf1a969405bf05647d1d5375338";
        $this->camposPerson["ies"] = "dad6877cc4c886d7cf172c30a85a10c5c0737709";
        $this->camposPerson["plano"] = "1b2b8933a0eb2fbfe596b2b32c8cf1d6618bd84b";
    }

    public function getCamposPerson()
    {
        return $this->camposPerson;
    }

    public function isPersonEnable($personId)
    {
        $token = ApiPipedriveConfig::TOKEN;
        $pipedrive = new Pipedrive($token);
        $persons = $pipedrive->persons()->find($personId);
        $person = $persons->getContent();

        return $person->data->active_flag;
    }

    public function getPerson($personId)
    {
        $token = ApiPipedriveConfig::TOKEN;
        $pipedrive = new Pipedrive($token);
        $persons = $pipedrive->persons()->find($personId);

        $this->verificaCamposVazios($persons->getContent());
        $this->person = $persons->getContent();

        if (empty($this->camposVazios)) {
            return $this->person;
        }

        return false;
    }

    public function setSincronizadoPerson($personId)
    {
        $token = ApiPipedriveConfig::TOKEN;
        $pipedrive = new Pipedrive($token);

        return $pipedrive->persons->update($personId, [$this->sincronizado => '8b045d808d445ac741b37af2ad489767']);
    }

    private function verificaCamposVazios($person)
    {
        foreach ($this->camposPerson as $chave => $tokenCampo) {
            if ($person->data->$tokenCampo == null) {
                $this->camposVazios[$chave] = 'Está vazio!';
            }
        }
    }

    public function getPersonObj()
    {
        return $this->person;
    }

    public function getCamposVazios()
    {
        return $this->camposVazios;
    }

    public function getAllPersonsFilter($limit = 50, $start = 0, $filterId = null)
    {
        $token = ApiPipedriveConfig::TOKEN;
        $companyDomain = ApiPipedriveConfig::DOMAIN;

        $filterIdRecursivo = $filterId;

        $url = 'https://' . $companyDomain . '.pipedrive.com/v1/persons?api_token='
            . $token . '&start=' . $start . '&limit=' . $limit . '&filter_id=' . $filterIdRecursivo;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($output, true);
        $deals = [];

        if (!empty($result['data'])) {
            foreach ($result['data'] as $deal) {
                $deals[] = $deal;
            }
        } else {
            return $result;
        }

        if (!empty($result['additional_data']['pagination']['more_items_in_collection']
            && $result['additional_data']['pagination']['more_items_in_collection'] === true)
        ) {
            $deals = array_merge($deals, $this->getAllPersonsFilter($limit, $result['additional_data']['pagination']['next_start']), $filterIdRecursivo);
        }

        return $deals;
    }
}
