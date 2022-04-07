<?php

use App\DAO\ClienteDAO;
use App\Entidade\ClienteEmail;
use App\DAO\ClienteEmailDAO;

require_once('../api/envia-email.php');
require_once('../../vendor/autoload.php');
require_once('../helper/helpers.php');

$cpf = formataCpfBd($_POST['cpf']);
$cliente_dao = new ClienteDAO();
$retorno = $cliente_dao->isCpfCadastrado($cpf);

if($retorno == null){
    setcookie('resultado_envio_proposta', 'false', time()+2, '/');
    setcookie('resposta_envio_proposta', 'Este CPF não possui cadastro em nosso sistema.', time()+2, '/');

}else {
    //$retorno_email = enviaEmail( $_POST['email'], $_POST['nome'], 'Proposta Comercial', "Corpo da proposta");
    //$cliente_email = new ClienteEmail($retorno['clientes_id'], $_POST['id_usuario'], $retorno_email, 1);

    //$cliente_email_dao = new ClienteEmailDAO($conexao);
    //$retorno = $cliente_email_dao->insereEmailEnviado($cliente_email);
}

header("Location: enviar-proposta-form.php");
die();
