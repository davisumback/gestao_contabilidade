<?php

namespace App\DAO;
use App\Usuario\Cliente as ClienteOld;
use App\Model\User\Cliente;
use App\Config\BancoConfig;
use App\Model\User\PreCadastroClientePipedrive;

class ClienteDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function getQuantidadeClientes()
    {
        $query = "SELECT COUNT(id) as quantidade FROM clientes;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function updatePisCliente($clientesId, $pis)
    {
        $query = "UPDATE clientes SET pis ='$pis' WHERE id = $clientesId;";
        
        return \mysqli_query($this->conexao, $query);       
    }

    public function getAllClienteSemPis()
    {
        $query = "SELECT 
                    id as clientesId, nome_completo, cpf
                FROM 
                    clientes
                WHERE
                    pis IS NULL";

        $retorno = \mysqli_query($this->conexao, $query);
        $linhas = array();

        while ($linha = \mysqli_fetch_assoc($retorno)) {
            $linhas[] = $linha;
        }

        return $linhas;
    }

    public function getQuantidadeDirecionamentoIR()
    {
        $query = "SELECT 
                    COUNT(id) 
                AS 
                    quantidade 
                FROM 
                    imposto_renda_direcionamento;";

        $retorno = \mysqli_query($this->conexao, $query);

        return $linha = \mysqli_fetch_assoc($retorno);        
    }

    public function getDirecionamentoIRAll()
    {
        $query = "SELECT 
                    ird.cpf, c.nome_completo, ce.empresas_id, ird.trabalhou_pf,
                    ird.recibo_pf, ird.obteve_recebimentos, ird.possui_imovel,
                    ird.data_imovel, ird.valor_imovel, ird.soma_bens, ird.possui_veiculo, 
                    ird.data_veiculo, ird.valor_veiculo, ird.proprietario_consorcio, 
                    ird.renda_rural, ird.ganho_capital, ird.heranca, ird.pensao, ird.aluguel
                FROM 
                    imposto_renda_direcionamento  as ird
                LEFT JOIN 
                    clientes as c
                ON 
                    ird.cpf = c.cpf
                LEFT JOIN
                    clientes_empresas as ce
                ON
                    ce.clientes_id = c.id;";

        $retorno = \mysqli_query($this->conexao, $query);
        $linhas = array();

        while ($linha = \mysqli_fetch_assoc($retorno)) {
            $linhas[] = $linha;
        }

        return $linhas;
    }

    public function exportDirecionamentoIR()
    {
        $query = "SELECT 
                    ird.cpf, c.nome_completo, ce.empresas_id, ird.trabalhou_pf,
                    ird.recibo_pf, ird.obteve_recebimentos, ird.possui_imovel,
                    ird.data_imovel, ird.valor_imovel, ird.soma_bens, ird.possui_veiculo, 
                    ird.data_veiculo, ird.valor_veiculo, ird.proprietario_consorcio, 
                    ird.renda_rural, ird.ganho_capital, ird.heranca, ird.pensao, ird.aluguel
                FROM 
                    imposto_renda_direcionamento  as ird
                LEFT JOIN 
                    clientes as c
                ON 
                    ird.cpf = c.cpf
                LEFT JOIN
                    clientes_empresas as ce
                ON
                    ce.clientes_id = c.id;";

        $retorno = \mysqli_query($this->conexao, $query);
        $linhas = array();

        $linhaTitulo = array();
        $linhaTitulo[0] = 'CPF';
        $linhaTitulo[1] = 'Nome Completo';
        $linhaTitulo[2] = 'Empresa';
        $linhaTitulo[3] = 'Trabalhou Pessoa Física';
        $linhaTitulo[4] = 'Recibo Pessoa Física';
        $linhaTitulo[5] = 'Obteve Recebimentos';
        $linhaTitulo[6] = 'Possui Imoveis';
        $linhaTitulo[7] = 'Data Imovel';
        $linhaTitulo[8] = 'Valor Imovel';
        $linhaTitulo[9] = 'Soma Bens';
        $linhaTitulo[10] = 'Possui Veículo';
        $linhaTitulo[11] = 'Data Veículo';
        $linhaTitulo[12] = 'Valor Veículo';
        $linhaTitulo[13] = 'Proprietário Consórcio';
        $linhaTitulo[14] = 'Renda Rural';
        $linhaTitulo[15] = 'Ganho Capital';
        $linhaTitulo[16] = 'Herança';
        $linhaTitulo[17] = 'Pensão';
        $linhaTitulo[18] = 'Aluguel';

        $linhas[] = $linhaTitulo;


        while ($linha = \mysqli_fetch_assoc($retorno)) {
            $linhas[] = $linha;
        }

        return $linhas;
    }

    public function getDirecionamentoImpostoRenda()
    {
        $query = "SELECT 
                    ird.cpf, c.nome_completo, ce.empresas_id
                FROM 
                    imposto_renda_direcionamento  as ird
                LEFT JOIN 
                    clientes as c
                ON 
                    ird.cpf = c.cpf
                LEFT JOIN
                    clientes_empresas as ce
                ON
                    ce.clientes_id = c.id;";

        $retorno = \mysqli_query($this->conexao, $query);
        $linhas = array();

        while ($linha = \mysqli_fetch_assoc($retorno)) {
            $linhas[] = $linha;
        }

        return $linhas;
    }

    public function getEmailsAEnviar()
    {
        $query = "SELECT id, email, nome_completo FROM clientes WHERE email IS NOT NULL;";
        $clientes = [];
        $retorno = mysqli_query($this->conexao, $query);

        while ($linha = mysqli_fetch_assoc($retorno)) {
            $clientes[] = $linha;
        }

        return $clientes;
    }

    public function getQuantidadeClienteAConfirmarPipedrive()
    {
        $query = "SELECT COUNT(id) as quantidade from clientes WHERE pipedrive_cadastro = 'NAO_VERIFICADO';";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function getClientesAConfirmarPipedriveResumido($vendedorId)
    {
        $query =    "SELECT
                    	cli.nome_completo, cli.cpf, cli.id
                    FROM
                    	clientes as cli
                    LEFT JOIN
                    	ies as i
                    ON
                    	i.id = cli.ies_id
                    LEFT JOIN
                    	clientes_pre_empresas
                    ON
                    	cli.id = clientes_pre_empresas.clientes_id
                    LEFT JOIN
                    	pre_empresas as pre
                    ON
                    	pre.id = clientes_pre_empresas.pre_empresas_id
                    LEFT JOIN
                    	planos as p
                    ON
                    	pre.planos_id = p.id
                    LEFT JOIN
                    	cliente_usuario as cliusu
                    ON
                    	cliusu.clientes_id = cli.id
                    WHERE
                    	cli.pipedrive_cadastro = 'NAO_VERIFICADO'
                    AND
                    	cliusu.usuarios_id = $vendedorId;";

        $retorno = mysqli_query($this->conexao, $query);
        $linhas = array();

        while ($linha = mysqli_fetch_assoc($retorno)){
            $linhas[] = $linha;
        }

        return $linhas;
    }

    public function getClienteAConfirmarPipedrive($clienteId, $vendedorId)
    {
        $query =    "SELECT
                    	cli.id as id_cliente, cli.nome_completo, cli.sexo, cli.situacao_cadastral, cli.cpf, cli.situacao_cadastral, cli.email, cli.data_nascimento, cli.crm, cli.telefone_celular, cli.nome_mae,
                        i.id as ies_id, pre.primeira_mensalidade, pre.nome_1, pre.nome_2, pre.nome_3, pre.empresa_outro_escritorio, p.nome as nome_plano,
                        p.valor, p.id as id_plano, pre.id as pre_empresa_id
                    FROM
                    	clientes as cli
                    LEFT JOIN
                    	ies as i
                    ON
                    	i.id = cli.ies_id
                    LEFT JOIN
                    	clientes_pre_empresas
                    ON
                    	cli.id = clientes_pre_empresas.clientes_id
                    LEFT JOIN
                    	pre_empresas as pre
                    ON
                    	pre.id = clientes_pre_empresas.pre_empresas_id
                    LEFT JOIN
                    	planos as p
                    ON
                    	pre.planos_id = p.id
                    LEFT JOIN
                    	cliente_usuario as cliusu
                    ON
                    	cliusu.clientes_id = cli.id
                    WHERE
                    	cli.pipedrive_cadastro = 'NAO_VERIFICADO'
                    AND
                    	cliusu.usuarios_id = $vendedorId
                    AND
                        cli.id = $clienteId;";

        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function getSocio($cpf)
    {
        $query = "SELECT * FROM clientes WHERE cpf = $cpf;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function insertCliente(Cliente $cliente)
    {
        $nomeMae = ($cliente->getNomeMae() == '') ? 'null' : "'" .$cliente->getNomeMae(). "'";
        $telefoneComercial = ($cliente->getTelefoneComercial() == '') ? 'null' : "'" .$cliente->getTelefoneComercial(). "'";
        $estadoCivil = ($cliente->getEstadoCivil() == '') ? 'null' : "'" .$cliente->getEstadoCivil(). "'";
        $regimeCasamento = ($cliente->getRegimeCasamento() == '') ? 'null' : "'" .$cliente->getRegimeCasamento(). "'";
        $crm = ($cliente->getCrm() == '') ? 'null' : "'" .$cliente->getCrm(). "'";
        $email = ($cliente->getEmail() == '') ? 'null' : "'" .$cliente->getEmail(). "'";
        $iesId = ($cliente->getIesId() == '') ? 'null' : "'" .$cliente->getIesId(). "'";
        $socioAdministrador = ($cliente->getSocioAdministrador() == '') ? '0' : "'" .$cliente->getSocioAdministrador(). "'";

        $query = "  INSERT INTO clientes (
                        nome_completo, cpf, situacao_cadastral, email, data_nascimento, crm,
                        telefone_comercial, telefone_celular, cadastro_completo, sexo, estado_civil, regime_casamento,
                        ies_id, ativo, nome_mae, profissao, socio_administrador
                    )
                    VALUES (
                        '{$cliente->getNome()}',
                        '{$cliente->getCpf()}',
                        '{$cliente->getSituacaoCadastral()}',
                        $email,
                        '{$cliente->getDataNascimento()}',
                        $crm,
                        $telefoneComercial,
                        '{$cliente->getTelefoneCelular()}',
                        1,
                        '{$cliente->getSexo()}',
                        $estadoCivil,
                        $regimeCasamento,
                        $iesId,
                        1,
                        $nomeMae,
                        '{$cliente->getProfissao()}',
                        $socioAdministrador
                    );";

        $dados['resultado'] =  mysqli_query($this->conexao, $query);
        $dados['cliente_id'] =  mysqli_insert_id($this->conexao);

        return $dados;
    }

    public function insereCliente(ClienteOld $cliente)
    {
        $nomeMae = ($cliente->getNomeMae() == '') ? 'null' : "'" .$cliente->getNomeMae(). "'";
        $telefoneComercial = ($cliente->getTelefoneComercial() == '') ? 'null' : "'" .$cliente->getTelefoneComercial(). "'";
        $regimeCasamento = ($cliente->getRegimeCasamento() == '') ? 'null' : "'" .$cliente->getRegimeCasamento(). "'";
        $crm = ($cliente->getCrm() == '') ? 'null' : "'" .$cliente->getCrm(). "'";
        $email = ($cliente->getEmail() == '') ? 'null' : "'" .$cliente->getEmail(). "'";
        $iesId = ($cliente->getIesId() == '') ? 'null' : "'" .$cliente->getIesId(). "'";
        $socioAdministrador = ($cliente->getSocioAdministrador() == '') ? '0' : "'" .$cliente->getSocioAdministrador(). "'";

        $query = "  INSERT INTO clientes (
                        nome_completo, cpf, situacao_cadastral, email, data_nascimento, crm,
                        telefone_comercial, telefone_celular, cadastro_completo, sexo, estado_civil, regime_casamento,
                        ies_id, ativo, nome_mae, profissao, socio_administrador
                    )
                    VALUES (
                        '{$cliente->getNome()}',
                        '{$cliente->getCpf()}',
                        '{$cliente->getSituacaoCadastral()}',
                        $email,
                        '{$cliente->getDataNascimento()}',
                        $crm,
                        $telefoneComercial,
                        '{$cliente->getTelefoneCelular()}',
                        1,
                        '{$cliente->getSexo()}',
                        '{$cliente->getEstadoCivil()}',
                        $regimeCasamento,
                        $iesId,
                        1,
                        $nomeMae,
                        '{$cliente->getProfissao()}',
                        $socioAdministrador
                    );";

        $dados['resultado'] =  mysqli_query($this->conexao, $query);
        $dados['cliente_id'] =  mysqli_insert_id($this->conexao);

        return $dados;
    }

    public function confirmaClientePipedrive(Cliente $cliente)
    {
        $nomeMae = ($cliente->getNomeMae() == '') ? 'null' : "'" .$cliente->getNomeMae(). "'";
        $telefoneComercial = ($cliente->getTelefoneComercial() == '') ? 'null' : "'" .$cliente->getTelefoneComercial(). "'";
        $estadoCivil = ($cliente->getEstadoCivil() == '') ? 'null' : "'" .$cliente->getEstadoCivil(). "'";
        $regimeCasamento = ($cliente->getRegimeCasamento() == '') ? 'null' : "'" .$cliente->getRegimeCasamento(). "'";
        $crm = ($cliente->getCrm() == '') ? 'null' : "'" .$cliente->getCrm(). "'";
        $email = ($cliente->getEmail() == '') ? 'null' : "'" .$cliente->getEmail(). "'";
        $iesId = ($cliente->getIesId() == '') ? 'null' : "'" .$cliente->getIesId(). "'";
        $socioAdministrador = ($cliente->getSocioAdministrador() == '') ? '0' : "'" .$cliente->getSocioAdministrador(). "'";

        $id =  $cliente->getId();

        $query = "  UPDATE clientes
                    SET
                        nome_completo = '{$cliente->getNome()}',
                        cpf = '{$cliente->getCpf()}',
                        situacao_cadastral = '{$cliente->getSituacaoCadastral()}',
                        email = $email,
                        data_nascimento = '{$cliente->getDataNascimento()}',
                        crm = $crm,
                        telefone_comercial = $telefoneComercial,
                        telefone_celular = '{$cliente->getTelefoneCelular()}',
                        cadastro_completo = 1,
                        sexo = '{$cliente->getSexo()}',
                        estado_civil = $estadoCivil,
                        regime_casamento = $regimeCasamento,
                        ies_id = $iesId,
                        ativo = 1,
                        nome_mae = $nomeMae,
                        profissao = '{$cliente->getProfissao()}',
                        socio_administrador = $socioAdministrador,
                        pipedrive_cadastro = 'VERIFICADO'
                    WHERE
                        id = $id
                    ;";

        return  mysqli_query($this->conexao, $query);
    }

    public function inserePrimeiraSenha($id, $nascimento, $cpf)
    {
        $primeira_senha = substr($nascimento, 0, 2) . '@@' . substr($cpf, 0, 3);
        $query = "UPDATE clientes SET senha = '{$primeira_senha}' WHERE id = $id;";

        return mysqli_query($this->conexao, $query);
    }

    public function verificaUsuarioESenha($cpf, $senha)
    {
        $cpf = mysqli_real_escape_string($this->conexao, $cpf);
        $password = mysqli_real_escape_string($this->conexao, $senha);
        $query = "SELECT * FROM clientes WHERE cpf = '{$cpf}' AND senha = '{$password}';";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function ativaDesativaCliente($id, $acao)
    {
        $query = "UPDATE clientes SET ativo = $acao WHERE id = $id";

        return mysqli_query($this->conexao, $query);
    }

    public function getPreClientes()
    {
        $clientes_array = array();
        $query = "  SELECT c.id, c.cpf, c.nome_completo, cliu.data_cadastro, p.aceitou, u.usuario FROM cliente_usuario as cliu
                    LEFT JOIN
                        clientes as c
                    ON
                        cliu.clientes_id = c.id
                    LEFT JOIN
                        propostas as p
                    ON
                        c.cpf = p.cpf_cliente
                    LEFT JOIN
                        usuarios as u
                    ON
                        u.id = cliu.usuarios_id
                    WHERE
                        c.cadastro_completo = 0
                    OR
                        c.cadastro_completo = null
                    ;";

        $retorno = mysqli_query($this->conexao, $query);
        while ($cliente = mysqli_fetch_assoc($retorno)) {
            array_push($clientes_array, $cliente);
        }

        return $clientes_array;
    }

    public function isCpfCadastrado($cpf)
    {
        $query = "SELECT * FROM clientes WHERE cpf = '{$cpf}';";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function isPrecadastroExistente($cpf)
    {
        $query = "SELECT * FROM clientes WHERE cpf = '$cpf';";
        $retorno = mysqli_query($this->conexao, $query);

        if (mysqli_fetch_assoc($retorno) == null) {
            return false;
        }

        return true;
    }

    public function inserePreCadastroPipedrive(PreCadastroClientePipedrive $cliente, $vendedorId)
    {
        $iesId = $cliente->getIesId();

        $query = "  INSERT INTO clientes (
                        nome_completo, cpf, situacao_cadastral, email, data_nascimento, crm, ies_id,
                        telefone_celular, nome_mae, sexo, ativo, cadastro_completo, pipedrive_cadastro
                    )
                    VALUES (
                        '{$cliente->getNomeCliente()}', '{$cliente->getCpf()}', '{$cliente->getSituacaoCadastral()}', '{$cliente->getEmail()}',
                        '{$cliente->getDataNascimento()}','{$cliente->getCrm()}', $iesId,
                        '{$cliente->getTelefone()}', '{$cliente->getNomeMae()}', '{$cliente->getSexo()}', true, false, 'NAO_VERIFICADO'
                    );";

        if (mysqli_query($this->conexao, $query)) {
            $cliente_id = mysqli_insert_id($this->conexao);
            $retorno['clientes_id'] = $cliente_id;
            $retorno['resultado'] = $this->insereClienteVendedor($vendedorId, $cliente_id);

            if ($retorno['resultado'] == false) {
                return false;
            }

            return $retorno;
        }

        return false;
    }

    public function insereClienteVendedor($vendedorId, $clienteId)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d');
        $query = "INSERT INTO cliente_usuario (clientes_id, usuarios_id, data_cadastro) VALUES ($clienteId, $vendedorId, '{$data}');";

        return mysqli_query($this->conexao, $query);
    }

    public function roolbackPreCadastroPipedrive($clientesId)
    {
        $query = "DELETE FROM cliente_usuario WHERE clientes_id = $clientesId;";
        mysqli_query($this->conexao, $query);
        $query = "DELETE FROM clientes WHERE id = $clientesId;";
        mysqli_query($this->conexao, $query);
    }

    public function getQuantidadeGuiaPendenteDomesticas($tipo){
        $query =    "SELECT
                    	count(distinct d.id) as quantidade
                    FROM                    	
                        domesticas as d
                    LEFT JOIN
                        responsaveis_domesticas as rd
                    ON
                    	d.responsaveis_domesticas_cpf = rd.cpf
                    WHERE NOT EXISTS 
                        (SELECT * FROM guias_domesticas as gd 
                        WHERE 
                            gd.domesticas_id = d.id 
                        AND 
                            gd.tipo = '$tipo')
                    ;";

        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();

        while($guia = mysqli_fetch_assoc($retorno)){
            $guias[] = $guia;
        }

        return $guias;
    }
}
