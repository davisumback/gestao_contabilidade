<?php
use App\Model\Pipedrive\Person;
use App\Model\Pipedrive\Pipedrive;

include __DIR__ . '/../../vendor/autoload.php';

$person = new Person();
$personsNaoSincronizadas = $person->getAllPersonsFilter('', '', 15);

if (array_key_exists('data', $personsNaoSincronizadas)) {
    die();
}

$pipedrive = new Pipedrive();

foreach ($personsNaoSincronizadas as $persons => $valor) {
    $pipedrive->verificaPersonPendenciaScript($valor);
}
