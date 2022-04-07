<?php

use App\DAO\ClienteDAO;
use App\Usuario\Cliente;
use App\Entidade\ClienteEmail;
use App\DAO\ClienteEmailDAO;
use App\Entidade\Proposta;
use App\DAO\PropostaPadraoDAO;
use App\Helper\MontaProposta;

require_once('../../api/envia-email.php');
require_once('../../../vendor/autoload.php');

session_start();
$pasta = '../../' . $_SESSION['pasta'];

echo '<pre>';
print_r($_POST);
echo '</pre>';
die();

$cliente = new Cliente(
    Helpers::formataCpfBd($cpf), $_POST['nome'], $_POST['situacao_cadastral'], $_POST['email'], $_POST['data_nascimento'], $_POST['crm'], $_POST['ies_id'],
    $_POST['plano_id'], $_POST['telefone_comercial'], $_POST['telefone_celular'], $_POST['vencimento_mensalidade']
);

$cliente_dao = new ClienteDAO();
$retorno = $cliente_dao->inserePreCadastro($cliente, $_POST['id_usuario']);

if($retorno['resultado'] == false) {
    setcookie("resultado_insercao", "false", time()+2, "/");
    setcookie("resposta_insercao", "Erro ao inserir pré-cadastro", time()+2, "/");
}else {
    $proposta_dao = new PropostaPadraoDAO();
    $proposta_padrao = $proposta_dao->getPropostaPadrao(1);

    $cpf_hash = md5($cpf);
    $link_aceite = '//sistema.grupobcontabil.com.br/sistema/email-view/aceitou.php?resultado='.$cpf_hash.'&unassigned='.$retorno['id_cliente'];
    $link_rejeite = '//sistema.grupobcontabil.com.br/sistema/email-view/rejeitou.php?resultado='.$cpf_hash.'&unassigned='.$retorno['id_cliente'];

    $monta_proposta = new MontaProposta($proposta_padrao['titulo'], $proposta_padrao['corpo']);
    $monta_proposta->setLinkAceite($link_aceite);
    $monta_proposta->setLinkRejeite($link_rejeite);
    $conteudo = $monta_proposta->montaProposta();

    $retorno_email = enviaEmail($_POST['email'], $_POST['nome'], $proposta_padrao['titulo'], $conteudo);
    $cliente_email = new ClienteEmail($retorno['id_cliente'], $_POST['id_usuario'], $retorno_email, 1);

    $cliente_email_dao = new ClienteEmailDAO();
    $retorno_cliente_email = $cliente_email_dao->insereEmailEnviado($cliente_email);

    $proposta = new Proposta($proposta_padrao['titulo'], $proposta_padrao['corpo'], $cpf);
    $proposta_dao->insereProposta($proposta);

    setcookie("resultado_insercao", "true", time()+2, "/");
    setcookie("resposta_insercao", "Sucesso ao salvar", time()+2, "/");
}

header("Location: " . $pasta . "/form-cpf.php");
die();
