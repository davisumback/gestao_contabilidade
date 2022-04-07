<?php
namespace App\Model\User;

use App\Helper\Helpers;
use App\Api\Saida\Cpf;
use App\DAO\ApiDAO;
use App\DAO\ClienteDAO;
use App\DAO\PreEmpresaDAO;
use App\DAO\PipedriveUserVendedorDAO;

class PreCadastroClientePipedrive
{
    private $cpf;
    private $crm;
    private $primeira_mensalidade;
    private $nome_1;
    private $nome_2;
    private $nome_3;
    private $email;
    private $telefone;
    private $ies_id;
    private $planos_id;
    private $pipedriveVendedorId;
    private $nomeCliente;
    private $dataNascimento;
    private $nomeMae;
    private $sexo;
    private $situacaoCadastral;
    public static $instance;

    private function __construct(){}

    public static function getInstance($clienteConvertido)
    {
        if (self::$instance === null) {
            self::$instance = new PreCadastroClientePipedrive();
        }

        self::$instance->cpf = Helpers::formataCpfBd($clienteConvertido['cpf']);
        self::$instance->crm = $clienteConvertido['crm'];
        self::$instance->primeira_mensalidade = Helpers::formataDataBd($clienteConvertido['primeira_mensalidade']);
        self::$instance->nome_1 = $clienteConvertido['nome_1'];
        self::$instance->nome_2 = $clienteConvertido['nome_2'];
        self::$instance->nome_3 = $clienteConvertido['nome_3'];
        self::$instance->email = $clienteConvertido['email'];
        self::$instance->telefone = $clienteConvertido['telefone'];
        self::$instance->ies_id = $clienteConvertido['ies_id'];
        self::$instance->planos_id = $clienteConvertido['planos_id'];
        self::$instance->pipedriveVendedorId = $clienteConvertido['vendedor'];

        return self::$instance;
    }

    private function setDadosCpf()
    {
        $apiDao = new ApiDAO();
        $api = $apiDao->getApi('cpf');
        $token = ($api['ativo'] == 1) ? $api['token'] : $api['token_teste'];

        $respostaApi = Cpf::consultaCpf(self::$instance->cpf ,$api['url'], $token);
        $retornoFormatado = json_decode($respostaApi['dados'], true);

        if ($api['ativo'] == 1) {
            $apiDao->setQuantidadeRequisicoesRestantes('cpf', $retornoFormatado['saldo']);
        }

        if ($retornoFormatado['status'] == 0 ) {
            self::$instance->nomeCliente = null;
            self::$instance->dataNascimento = null;
            self::$instance->nomeMae = null;
            self::$instance->sexo = null;
            self::$instance->situacaoCadastral = null;

            return;
        }

        $this->nomeCliente = $retornoFormatado['nome'];
        self::$instance->dataNascimento =  Helpers::formataDataBd($retornoFormatado['nascimento']);
        self::$instance->nomeMae =  $retornoFormatado['mae'];
        self::$instance->sexo =  $retornoFormatado['genero'];
        self::$instance->situacaoCadastral =  $retornoFormatado['situacao'];
    }

    public function convertClientePipedriveToCliente()
    {
        $this->setDadosCpf();

        $dao = new PipedriveUserVendedorDAO();
        $resultado = $dao->getIdVendendor($this->getPipedriveVendedorId());

        if ($resultado == false) {
            return false;
        }

        $clienteDao = new ClienteDAO();

        $retornoCliente = $clienteDao->inserePreCadastroPipedrive(self::$instance, $resultado['usuarios_id']);

        if ($retornoCliente == false) {
            return false;
        }

        $preEmpresaDAO = new PreEmpresaDAO();
        $retorno = $preEmpresaDAO->criaPreEmpresaPipedrive(self::$instance);

        if ($retorno == false) {
            $clienteDao->roolbackPreCadastroPipedrive($retornoCliente['clientes_id']);
            return false;
        }

        $preEmpresaDAO->insereSocioPreEmpresa($retornoCliente['clientes_id'], $retorno['pre_empresas_id']);

        return $retorno;
    }

    public function isPrecadastroExistente()
    {
        $clienteDao = new ClienteDAO();

        return $clienteDao->isPrecadastroExistente($this->getCpf());
    }

    /**
     * Get the value of Cpf
     *
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Get the value of Crm
     *
     * @return mixed
     */
    public function getCrm()
    {
        return $this->crm;
    }

    /**
     * Get the value of Primeira Mensalidade
     *
     * @return mixed
     */
    public function getPrimeiraMensalidade()
    {
        return $this->primeira_mensalidade;
    }

    /**
     * Get the value of Nome 1
     *
     * @return mixed
     */
    public function getNome1()
    {
        return $this->nome_1;
    }

    /**
     * Get the value of Nome 2
     *
     * @return mixed
     */
    public function getNome2()
    {
        return $this->nome_2;
    }

    /**
     * Get the value of Nome 3
     *
     * @return mixed
     */
    public function getNome3()
    {
        return $this->nome_3;
    }

    /**
     * Get the value of Data Nascimento
     *
     * @return mixed
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * Get the value of Email
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of Telefone
     *
     * @return mixed
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Get the value of Ies Id
     *
     * @return mixed
     */
    public function getIesId()
    {
        return $this->ies_id;
    }

    /**
     * Get the value of Planos Id
     *
     * @return mixed
     */
    public function getPlanosId()
    {
        return $this->planos_id;
    }


    /**
     * Get the value of Pipedrive Vendedor Id
     *
     * @return mixed
     */
    public function getPipedriveVendedorId()
    {
        return $this->pipedriveVendedorId;
    }

    /**
     * Get the value of Nome Cliente
     *
     * @return mixed
     */
    public function getNomeCliente()
    {
        return $this->nomeCliente;
    }

    /**
     * Get the value of Nome Mae
     *
     * @return mixed
     */
    public function getNomeMae()
    {
        return $this->nomeMae;
    }

    /**
     * Get the value of Sexo
     *
     * @return mixed
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Get the value of Situacao Cadastral
     *
     * @return mixed
     */
    public function getSituacaoCadastral()
    {
        return $this->situacaoCadastral;
    }

}
