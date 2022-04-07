<?php
namespace App\Model\Email\Os;

class CertidaoEmail
{
    private $attributes;
    private $tituloEmail;
    private $gestor;

    public function __construct($attributes = array())
    {
        $this->attributes = $attributes;
        $this->tituloEmail = 'Referente ao Atendimeno da OS - Emissão de Certidão';        
    }

    public function getCorpoEmail()
    {
        $ordemDeServico = new \App\Model\Os\OrdemDeServico();
        $os = $ordemDeServico->getOsCertidao($this->attributes['ordemDeServicoId']);

        $usuarioDao = new \App\DAO\UsuarioDAO();
        $gestor = $usuarioDao->getUsuario($this->attributes['usuariosId']);
        $this->gestor = $gestor;

        $corpoEmail = file_get_contents('../../views/email/os/index.php');
        $corpoEmail = \str_replace('{{numeroOs}}', $this->attributes['ordemDeServicoId'], $corpoEmail);
        $corpoEmail = \str_replace('{{descricaoGestor}}', $os[1]['descricao'], $corpoEmail);
        $corpoEmail = \str_replace('{{imagemGestor}}', 'http://sistema.grupobcontabil.com.br/sistema/images/avatar/'.$gestor['usuario'].'.png', $corpoEmail);
        $corpoEmail = \str_replace('{{nomeGestor}}', $gestor['nome_completo'], $corpoEmail);

        return $corpoEmail;
    }

    public function enviaEmail($empresaEmail, $empresaNome, $emailsCopia, $anexos)
    {
        try {
            $corpoEmail = $this->getCorpoEmail();
            $configuracoes['HOST'] = 'smtpi.kinghost.net';
            $configuracoes['USER_NAME'] = $this->gestor['email_medb'];
            $configuracoes['SENHA'] = $this->gestor['senha_email_medb'];
            $configuracoes['TITULO_EMAIL'] = 'Medb | Ordem de Serviço';
            $configuracoes['NOME_EMAIL_DE_RESPOSTA'] = $this->gestor['nome_completo'];

            \App\Email\EmailOsMedb::send($configuracoes, $empresaEmail, $empresaNome, $configuracoes['TITULO_EMAIL'], $corpoEmail, $emailsCopia, $anexos);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);            
        }
    }
}