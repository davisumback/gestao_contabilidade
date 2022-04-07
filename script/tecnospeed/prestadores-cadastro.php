<?php

include __DIR__ . '/../../vendor/autolaod.php';

$dao = new \App\DAO\EmpresaDAO();
$dao->getEmpresasCadastroTecnospeed();

$prestador = new \App\Model\Nfse\Prestador(
    $cnpj,
    $inscricaoMunicipal,
    $razaoSocial,
    $regimeTributario,
    $endereco,
    $certificadoId,
    $config
);


// $prestador = new \App\Model\Nfse\Prestador($cpfCnpjEntrada, $inscricaoMunicipal, $razaoSocial, $simplesNacional = true, Endereco $endereco, $certificadoId, $config);