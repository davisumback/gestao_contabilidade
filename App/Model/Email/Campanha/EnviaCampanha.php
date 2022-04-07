<?php
namespace App\Model\Email\Campanha;

use App\Email\EnviaEmailCampanha;
use App\DAO\EmailMarketingCampanhaDAO;

class EnviaCampanha
{
    private $contatos;

    public function __construct($contatos)
    {
        $this->contatos = $contatos;
    }

    public function enviar()
    {
        $dao = new EmailMarketingCampanhaDAO();

        foreach ($this->contatos as $contato) {
            $html = file_get_contents('../../sistema/views/email/campanha/outback.php');
            $corpoEmail = str_replace('{{clienteMedb}}', $contato['nome'], $html);
            $retornoEmail = EnviaEmailCampanha::send($contato['email_cliente'], $contato['nome'], 'RESPONDA E CONCORRA A UM VOUCHER PARA O OUTBACK', $corpoEmail, 'medbmkt@gmail.com');

            if ($retornoEmail == true) {
                $dao->updateEmails($contato['clientes_id'], $contato['campanha']);
            }
        }
    }

    public function enviaEmailIrpf2018()
    {
        $irpf = new \App\Model\Irpf($this->contatos);
        $irpf->enviaEmail();
    }

    public function enviaEmailGanhador()
    {
        $dao = new EmailMarketingCampanhaDAO();

        foreach ($this->contatos as $contato) {
            $corpoEmail = file_get_contents('../../sistema/views/email/campanha/outback_ganhador.php');
            $retornoEmail = EnviaEmailCampanha::send($contato['email_cliente'], $contato['nome'], 'GANHADOR DO VOUCHER PARA O OUTBACK', $corpoEmail, 'medbmkt@gmail.com');

            if ($retornoEmail == true) {
                $dao->updateEmails($contato['clientes_id'], $contato['campanha']);
            }
        }
    }
}