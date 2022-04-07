<?php
use App\Model\Pipedrive\PersonConverter;
use App\Model\Pipedrive\Person;
use App\Model\Pipedrive\User;
use App\Model\Pipedrive\Organization;
use App\Model\Entity\PreCadastroCliente;
use Devio\Pipedrive\Pipedrive;
use App\Config\Pipedrive\ApiPipedriveConfig;

require_once 'vendor/autoload.php';

$token = ApiPipedriveConfig::TOKEN;
$pipedrive = new Pipedrive($token);

$persons = $pipedrive->persons->all();

// $person = new Person();
// $personObj = $person->getPerson(15);
//
// $personConverter = new PersonConverter($personObj);
// $clienteConvertido = $personConverter->converterPersonToCliente();
// $preCadastroCliente = new PreCadastroCliente($clienteConvertido);

// $user = new User();
// $userObj = $user->getUser(6777275);

echo '<pre>';
print_r($persons);
echo '</pre>';

// $organization = new Organization();
// $resultado = $organization->getOrganization(3);
// echo '<pre>';
// print_r($resultado);
// echo '</pre>';
