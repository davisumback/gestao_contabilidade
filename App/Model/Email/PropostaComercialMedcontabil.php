<?php
namespace App\Model\Email;

use App\Helper\Helpers;

class PropostaComercialMedcontabil
{
    private $valorFuncionario;
    private $valorSocio;
    private $valorPlano;
    private $valorDomestica;
    private $honorarioAtual;
    private $attributes;
    private $dadosUsuario;
    private $conexao;

    public function __construct()
    {
        $this->conexao = \App\Config\BancoConfig::conecta();
        $this->valorFuncionario = 40;
        $this->valorSocio = 40;
        $this->valorPlano = 178;
        $this->valorDomestica = 70;
    }

    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    public function setHonorarioAtual($honorario, $isDecimoTerceiro)
    {
        $honorario = \App\Helper\Helpers::formataMoedaBd($honorario);

        if ($isDecimoTerceiro == 'sim') {
            $this->honorarioAtual = $honorario * 13;
            return;
        }

        $this->honorarioAtual = $honorario * 12;

        return;
    }

    public function setDadosUsuario()
    {
        $usuarioDao = new \App\DAO\UsuarioDAO();
        $retornoUsuario = $usuarioDao->getDadosUsuarioEmailMecontabil($this->attributes['usuariosId']);
        $dados ['usuarioEmail'] = $retornoUsuario['email_integracao'];
        $dados ['usuarioCelular'] = $retornoUsuario['telefone_celular'];
        $dados ['usuarioSenhaEmail'] = $retornoUsuario['senha_email'];
        $dados ['usuarioAvatar'] = $retornoUsuario['avatar'];
        $dados ['usuarioNomeCompleto'] = $retornoUsuario['nome_completo'];
        $dados ['usuario'] = $retornoUsuario['usuario'];
        $dados ['logradouro'] = $retornoUsuario['logradouro'];
        $dados ['numero'] = $retornoUsuario['numero'];
        $dados ['bairro'] = $retornoUsuario['bairro'];
        $dados ['cidade'] = $retornoUsuario['cidade'];
        $dados ['uf'] = $retornoUsuario['uf'];
        $dados ['complemento'] = $retornoUsuario['complemento'];

        $this->dadosUsuario = $dados;

        return $dados;
    }

    public function calculaProposta()
    {
        $dados['valorFuncionario'] = $this->valorFuncionario * $this->attributes['empresas'][1]['quantidadeFuncionarios'];
        $dados['valorSocio'] = $this->valorSocio *  $this->attributes['empresas'][1]['quantidadeSocios'];
        $dados['valorPlano'] = $this->valorPlano * $this->attributes['empresas'][1]['faturamento'];
        $dados['valorDomestica'] = $this->valorDomestica * $this->attributes['empresas'][1]['domestica'];

        $dados['valorFinal'] = $dados['valorFuncionario'] + $dados['valorSocio'] + $dados['valorPlano'] + $dados['valorDomestica'];
        $dados['totalEconomia'] = $this->honorarioAtual - ($dados['valorFinal'] * 12);

        if ($dados['totalEconomia'] <= 0) {
            throw new \Exception("Não será enviado e-mail para o cliente, pois ele não terá econômia alguma", 1);
        }

        return $dados;
    }

    public function getCorpoEmail()
    {
        $dadosProposta = $this->calculaProposta();
        $dadosUsuario = $this->setDadosUsuario();

        // $faturamentoMensal = \App\Helper\HelperView::getValorFaixaPrecoMedcontabil($this->attributes['empresas'][1]['faturamento']);

        // $caminhoFoto = 'http://sistema.grupobcontabil.com.br/sistema/images/avatar/' . $this->dadosUsuario['usuario'] . '.png';

        // $corpoEmail = file_get_contents('../../views/email/proposta/proposta-comercial-medcontabil.php');
        // $corpoEmail = str_replace('{{nomeContato}}', $this->attributes['nome'], $corpoEmail);
        // $corpoEmail = str_replace('{{nomeEmpresa}}', $this->attributes['empresas'][1]['nome'], $corpoEmail);
        // $corpoEmail = str_replace('{{mensalidade}}', Helpers::formataMoedaView($dadosProposta['valorPlano']), $corpoEmail);
        // $corpoEmail = str_replace('{{quantidadeSocios}}', str_pad($this->attributes['empresas'][1]['quantidadeSocios'], 2, "0", STR_PAD_LEFT), $corpoEmail);
        // $corpoEmail = str_replace('{{socios}}', Helpers::formataMoedaView($dadosProposta['valorSocio']), $corpoEmail);
        // $corpoEmail = str_replace('{{quantidadeFuncionarios}}', str_pad($this->attributes['empresas'][1]['quantidadeFuncionarios'], 2, "0", STR_PAD_LEFT), $corpoEmail);
        // $corpoEmail = str_replace('{{funcionarios}}', Helpers::formataMoedaView($dadosProposta['valorFuncionario']), $corpoEmail);
        // $corpoEmail = str_replace('{{total}}', Helpers::formataMoedaView($dadosProposta['valorFinal']), $corpoEmail);
        // $corpoEmail = str_replace('{{faturamentoMensal}}', $faturamentoMensal, $corpoEmail);
        // $corpoEmail = str_replace('{{emailUsuario}}', $dadosUsuario['usuarioEmail'], $corpoEmail);
        // $corpoEmail = str_replace('{{totalAtual}}', Helpers::formataMoedaView($this->honorarioAtual), $corpoEmail);
        // $corpoEmail = str_replace('{{totalEconomia}}', Helpers::formataMoedaView($dadosProposta['totalEconomia']), $corpoEmail);
        // $corpoEmail = str_replace('{{caminhoImagem}}', $caminhoFoto, $corpoEmail);
        // $corpoEmail = str_replace('{{nomeUsuario}}', $this->dadosUsuario['usuarioNomeCompleto'], $corpoEmail);

        // if ($dadosUsuario['logradouro'] != null) {
        //     $corpoEmail = str_replace('{{logradouroNumero}}', $dadosUsuario['logradouro'] . ', ' . $dadosUsuario['numero'] . '.', $corpoEmail);
        // } else {
        //     $corpoEmail = str_replace('{{logradouroNumero}}', '', $corpoEmail);
        // }
    
        // if ($dadosUsuario['complemento'] != null) {
        //     $corpoEmail = str_replace('{{complemento}}', $dadosUsuario['complemento'], $corpoEmail);
        // } else {
        //     $corpoEmail = str_replace('{{complemento}}', '', $corpoEmail);
        // }
    
        // if ($dadosUsuario['cidade'] != null) {
        //     $corpoEmail = str_replace('{{cidadeUf}}', $dadosUsuario['cidade'] . '-' . $dadosUsuario['uf'], $corpoEmail);
        // } else {
        //     $corpoEmail = str_replace('{{cidadeUf}}', '', $corpoEmail);
        // }
    
        // if ($dadosUsuario['usuarioCelular'] != null) {
        //     $corpoEmail = str_replace('{{telefoneUsuario}}', Helpers::mask($dadosUsuario['usuarioCelular'], '(##) # ####-####'), $corpoEmail);
        // } else {
        //     $corpoEmail = str_replace('{{telefoneUsuario}}', '', $corpoEmail);
        // }

        // return $corpoEmail;
    }

    public function enviaProposta()
    {
        $corpoEmail = $this->getCorpoEmail();
        
        // $configuracoes['host'] = 'smtpi.kinghost.net';
        // $configuracoes['user_name'] = $this->dadosUsuario['usuarioEmail'];
        // $configuracoes['senha'] = $this->dadosUsuario['usuarioSenhaEmail'];
        // $configuracoes['titulo_email'] = 'medcontábil | Proposta de Negócio';
        // $configuracoes['nome_email_de_resposta'] = $this->dadosUsuario['usuarioNomeCompleto'];

        // $emailsCopia [] = $this->dadosUsuario['usuarioEmail'];

        // try {
        //     $retorno = \App\Email\EmailProposta::send(
        //         $configuracoes,
        //         $this->attributes['email'],
        //         $this->attributes['nome'],
        //         'medcontábil | Proposta de Negócio',
        //         $corpoEmail,
        //         $emailsCopia);
        // } catch (\Exception $e) {
        //     throw new \Exception($e->getMessage(), 1);
        // }

        $propostasMedcontabilId = $this->saveDadosProposta();
        $this->saveEnvioEmail($propostasMedcontabilId);
    }

    public function saveEnvioEmail($propostasMedcontabilId)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO prospects_emails (
            prospects_id, propostas_medcontabil_id, usuarios_id, created_at, email_enviado
        ) VALUES (
            {$this->attributes['prospect']},
            {$propostasMedcontabilId},
            {$this->attributes['usuariosId']},
            '{$now}',
            'NAO'
        );";

        if (\mysqli_query($this->conexao, $query) == false) {
            throw new \Exception('Email enviado, porém não foi salvo os dados do email no Banco de Dados.');
        }
    }

    public function saveDadosProposta()
    {
        $dadosProposta = $this->calculaProposta();
        $valorFinal = Helpers::formataMoedaBd($dadosProposta['valorFinal']);
        $totalEconomia = Helpers::formataMoedaBd($dadosProposta['totalEconomia']);

        $pagaDecimo = strtoupper($this->attributes['empresas'][1]['decimoTerceiro']);
        $honorarioAtual = $this->honorarioAtual;
        $totalAtual = Helpers::formataMoedaBd($this->honorarioAtual);

        $caminhoFoto = 'http://sistema.grupobcontabil.com.br/sistema/images/avatar/' . $this->dadosUsuario['usuario'] . '.png';

        $query = "INSERT INTO propostas_medcontabil (
            aos_cuidados, empresa_nome, mensalidade_faixa, socios, funcionarios, valor_total, economia_total,
            paga_decimo, caminho_imagem, email_usuario, telefone_usuario, total_atual, nome_usuario
        ) VALUES (
            '{$this->attributes['nome']}',
            '{$this->attributes['empresas'][1]['nome']}',
            {$this->attributes['empresas'][1]['faturamento']},
            {$this->attributes['empresas'][1]['quantidadeSocios']},
            {$this->attributes['empresas'][1]['quantidadeFuncionarios']},
            {$valorFinal},
            {$totalEconomia},
            '{$pagaDecimo}',
            '{$caminhoFoto}',
            '{$this->dadosUsuario['usuarioEmail']}',
            '{$this->dadosUsuario['usuarioCelular']}',
            {$totalAtual},
            '{$this->dadosUsuario['usuarioNomeCompleto']}'
        );";

        if (\mysqli_query($this->conexao, $query) == false) {
            throw new \Exception('Email enviado, porém não foi salvo os dados da proposta no Banco de Dados.');
        }

        $idPropostaMedcontabil = \mysqli_insert_id($this->conexao);
        $proposal = \md5($idPropostaMedcontabil);

        $query = "UPDATE propostas_medcontabil SET proposal = '{$proposal}' WHERE id = $idPropostaMedcontabil;";

        \mysqli_query($this->conexao, $query);

        return $idPropostaMedcontabil;
    }
}
