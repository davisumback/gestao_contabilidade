<?php
namespace App\Controller;

class ProspectController
{

    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    public function verificaParametros()
    {
        if (empty($this->attributes)) {
            throw new \Exception("Você não pode acessar essa área do sistema diretamente!", 1);
        }
    }

    public function store()
    {
        $this->verificaParametros();

        $usuario = new \App\Model\Grupob\Usuario();
        $nomeUsuario = $usuario->getNomeUsuario($this->attributes["usuariosId"]);

        $attachments = array([
            'fallback' => 'Veja o novo Prospect Cadastrado!',
            'pretext'  => ':medal: Novo Prospect Cadastrado :medal:',
            'color'    => '#09814a',
            'fields'   => array(
                [
                    'title' => 'Cadastrado Por',
                    'value' =>  $nomeUsuario
                ],
                [
                    'title' => 'Email',
                    'value' =>  $this->attributes["email"],
                    'short' => true
                ],
                [
                    'title' => 'Nome Doutor',
                    'value' =>  $this->attributes["nome_doutor"],
                    'short' => true
                ],
                [
                    'title' => 'Nome Contato',
                    'value' =>  $this->attributes["nome_contato"],
                    'short' => true
                ],
                [
                    'title' => 'Telefone',
                    'value' =>  $this->attributes["telefone"],
                    'short' => true
                ],
                [
                    'title' => 'Celular',
                    'value' =>  $this->attributes["celular"],
                    'short' => true
                ],
                [
                    'title' => 'Sexo',
                    'value' =>  $this->attributes["sexo"],
                    'short' => true
                ],
                [
                    'title' => 'Nome Empresa',
                    'value' =>  $this->attributes["nome_empresa"],
                    'short' => true
                ],
                [
                    'title' => 'CNPJ',
                    'value' =>  $this->attributes["cnpj"],
                    'short' => true
                ],
                [
                    'title' => 'Estado',
                    'value' =>  $this->attributes["estado"],
                    'short' => true
                ],
                [
                    'title' => 'Cidade',
                    'value' =>  $this->attributes["cidade"],
                    'short' => true
                ],
                [
                    'title' => 'Empresa Vínculo',
                    'value' =>  $this->attributes["empresa_vinculo"],
                    'short' => true
                ],
                [
                    'title' => 'Profissão',
                    'value' =>  $this->attributes["profissao"],
                    'short' => true
                ],
                [
                    'title' => 'Especialidade',
                    'value' =>  $this->attributes["especialidade"],
                    'short' => true
                ]
            )
        ]);
        
        $prospect = new \App\Model\Prospect\Prospect();
        $prospect->save($this->attributes);

        $slackWrite = new \App\Model\Slack\SlackWrite();
        $slackWrite->sendMessage($attachments, '#prospect');
        // $slackWrite->sendMessage($attachments, '#prospect-teste');

        return 'Sucesso ao salvar o prospect.';
    }

    public function update()
    {
        $this->verificaParametros();

        $usuario = new \App\Model\Grupob\Usuario();
        $nomeUsuario = $usuario->getNomeUsuario($this->attributes["usuariosId"]);

        $attachments = array([
            'fallback' => 'Veja o Prospect Alterado!',
            'pretext'  => ':writing_hand: Prospect Editado! :writing_hand:',
            'color'    => '#ffca18',
            'fields'   => array([
                    'title' => 'Alterado Por',
                    'value' =>  $nomeUsuario
                ],
                [
                    'title' => 'Email',
                    'value' => $this->attributes["email"],
                    'short' => true
                ],
                [
                    'title' => 'Nome Doutor',
                    'value' => $this->attributes["nome_doutor"],
                    'short' => true
                ],
                [
                    'title' => 'Nome Contato',
                    'value' => $this->attributes["nome_contato"],
                    'short' => true
                ],
                [
                    'title' => 'Telefone',
                    'value' => $this->attributes["telefone"],
                    'short' => true
                ],
                [
                    'title' => 'Celular',
                    'value' => $this->attributes["celular"],
                    'short' => true
                ],
                [
                    'title' => 'Nome Empresa',
                    'value' => $this->attributes["nome_empresa"],
                    'short' => true
                ],
                [
                    'title' => 'CNPJ',
                    'value' => $this->attributes["cnpj"],
                    'short' => true
                ],
                [
                    'title' => 'Profissão',
                    'value' => $this->attributes["profissao"],
                    'short' => true
                ],
                [
                    'title' => 'Especialidade',
                    'value' => $this->attributes["especialidade"],
                    'short' => true
                ]
            )
        ]);

        $prospect = new \App\Model\Prospect\Prospect();
        $prospect->update($this->attributes);

        $slackWrite = new \App\Model\Slack\SlackWrite();
        $slackWrite->sendMessage($attachments, '#prospect');
        // $slackWrite->sendMessage($attachments, '#prospect-teste');

        return 'Sucesso ao alterar o prospect.';
    }

    public function updateSexo()
    {
        $this->verificaParametros();

        $prospect = new \App\Model\Prospect\Prospect();
        $prospect->updateSexo($this->attributes);

        return 'Sucesso ao alterar o prospect.';
    }

    public function delete()
    {
        $this->verificaParametros();

        $usuario = new \App\Model\Grupob\Usuario();
        $nomeUsuario = $usuario->getNomeUsuario($this->attributes["usuariosId"]);

        $attachments = array([
            'fallback' => 'Veja o Prospect Deletado!',
            'pretext'  => ':bangbang: Prospect Deletado! :bangbang:',
            'color'    => '#ec1c24',
            'fields'   => array([
                    'title' => 'Deletado Por',
                    'value' =>  $nomeUsuario
                ],
                [
                    'title' => 'Email',
                    'value' => $this->attributes["email"],
                    'short' => true
                ],
                [
                    'title' => 'Nome Doutor',
                    'value' => $this->attributes["nome_doutor"],
                    'short' => true
                ],
                [
                    'title' => 'Nome Contato',
                    'value' => $this->attributes["nome_contato"],
                    'short' => true
                ],
                [
                    'title' => 'Celular',
                    'value' => $this->attributes["celular"],
                    'short' => true
                ]
            )
        ]);

        $prospect = new \App\Model\Prospect\Prospect();
        $prospect->delete($this->attributes);

        $slackWrite = new \App\Model\Slack\SlackWrite();
        $slackWrite->sendMessage($attachments, '#prospect');
        // $slackWrite->sendMessage($attachments, '#prospect-teste');

        return 'Sucesso ao deletar o prospect.';
    }
}
