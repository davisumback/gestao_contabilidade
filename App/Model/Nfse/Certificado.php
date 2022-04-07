<?php
namespace App\Model\Nfse;

use App\Config\BancoConfig;
use App\Config\NfseConfig;
use App\Helper\Helpers;
use App\Arquivo\UploadArquivo;
use App\Arquivo\CriaPasta;
use App\DAO\ApiDAO;
use App\Api\CurlNew;
use App\DAO\EmpresaDAO;
use App\Api\CurlPut;

class Certificado
{
    private $conexao;
    private $id;
    private $arquivo;
    private $senha;
    private $empresasId;
    private $email;
    private $dataValidade;
    private $pastaCertificado;
    private $idIntegracao;

    public function setAttributes($arquivo, $senha, $dataValidade, $empresasId = null, $email = NfseConfig::EMAIL_AVISO_VALIDADE_CERTIFICADO)
    {
        $this->setArquivo($arquivo);
        $this->senha = $senha;
        $this->setDataValidade($dataValidade);
        $this->empresasId = $empresasId;
        $this->email = $email;
        $this->conexao = BancoConfig::conecta();
    }

    public function save()
    {
        $dadosIntegracao = $this->enviaCertificado();
        $idIntegracao = $dadosIntegracao['data']['id'];

        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO empresas_certificados (
            empresas_id, senha, arquivo, validade, email, id_integracao, created_at
        ) VALUES (
            $this->empresasId,
            '{$this->senha}',
            '{$this->arquivo['name']}',
            '{$this->dataValidade}',
            '{$this->email}',
            '{$idIntegracao}',
            '$now'
        );";

        if (\mysqli_query($this->conexao, $query) == false) {
            throw new \Exception("Certificado enviado para a integradora, porém não foi salvo os dados do mesmo no banco.", 1);
        }
    }

    public function enviaCertificado()
    {
        $dao = new ApiDAO();
        $retorno = $dao->getDadosApi('nfse');

        $url = $retorno['url'] . '/certificado';
        $token = $retorno['token'];
        $certificadoArquivo = $this->pastaCertificado . '/' . $this->arquivo['name'];
        $senha = $this->senha;
        $email = NfseConfig::EMAIL_AVISO_VALIDADE_CERTIFICADO;

        $header = ["x-api-key: $token"];
        $post = [
            'arquivo' => curl_file_create($certificadoArquivo),
            "senha" => "$senha",
            'email' => "$email"
        ];

        $nomeArquivoCertificado = $this->arquivo['name'];

        $retorno = CurlNew::executaCurl($url, $post, $header);

        if ($retorno['respostaHttp'] != 200 && $retorno['respostaHttp'] != 201) {
            throw new \Exception("Erro ao enviar o certificado para a empresa integradora.", 1);
        }

        return json_decode($retorno['dados'], true);
    }

    public function update()
    {
        $dadosIntegracao = $this->enviaUpdateCertificado();
        $idIntegracao = $dadosIntegracao['data']['id'];

        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "UPDATE empresas_certificados 
                SET
                    senha = '{$this->senha}',
                    arquivo = '{$this->arquivo['name']}',
                    validade = '{$this->dataValidade}',
                    email = '{$this->email}',
                    id_integracao = '{$idIntegracao}',
                    updated_at = '$now'
                WHERE
                    empresas_id = $this->empresasId;";

        if (\mysqli_query($this->conexao, $query) == false) {
            throw new \Exception("Certificado enviado para a integradora, porém não foi salvo os dados do mesmo no banco.", 1);
        }
    }

    public function enviaUpdateCertificado()
    {
        $dao = new ApiDAO();
        $retorno = $dao->getDadosApi('nfse');

        $url = $retorno['url'] . '/certificado/' . $this->idIntegracao;
        $token = $retorno['token'];
        $certificadoArquivo = $this->pastaCertificado . '/' . $this->arquivo['name'];
        $senha = $this->senha;
        $email = NfseConfig::EMAIL_AVISO_VALIDADE_CERTIFICADO;

        $header = ["x-api-key: $token"];
        $post = [
            'id' => $this->idIntegracao,
            'arquivo' => curl_file_create($certificadoArquivo),
            'senha' => "$senha",
            'email' => "$email"
        ];

        $retorno = CurlPut::executaCurl($url, $post, $header);

        if ($retorno['respostaHttp'] != 200 && $retorno['respostaHttp'] != 201) {
            throw new \Exception("Erro ao fazer a alteração do certificado para a empresa integradora.", 1);
        }

        return json_decode($retorno['dados'], true);
    }

    public function setPastaCertificado($pastaCertificado)
    {
        $this->pastaCertificado = $pastaCertificado;
    }

    public function uploadCertificado()
    {
        $empresaDao = new EmpresaDAO();

        if ($empresaDao->isEmpresa($this->empresasId) == null) {
            throw new \Exception("Erro! Empresa inexistente.", 1);
        }

        $pastaCertificado = '../../../grupobfiles/empresas/' . $this->empresasId . '/certificados';

        if (!is_dir($pastaCertificado)) {
            $criaPasta = new CriaPasta();
            $retorno = $criaPasta->criaPasta($pastaCertificado);

            if ($retorno == false) {
                throw new \Exception("Falha ao criar a pasta do certificado!", 1);
            }
        }

        $upload = new UploadArquivo();
        $retorno = $upload->uploadArquivo($_FILES, $pastaCertificado);

        if ($retorno == false) {
            throw new \Exception("Não foi possível fazer o upload do certificado", 1);
        }
    }

    public function setArquivo($arquivo)
    {
        if ($arquivo['type'] != 'application/x-pkcs12') {
            throw new \Exception("Erro! O certificado não possui a extensão .pfx", 1);
        }

        $this->arquivo = $arquivo;
    }

    public function setDataValidade($dataValidade)
    {
        try {
            $dataValidade = Helpers::formataDataBd($dataValidade);
            $data = new \DateTime($dataValidade);
        } catch (\Exception $e) {
            throw new \Exception("Erro! Data de validade inválida", 1);
        }

        $this->dataValidade = $data->format('Y-m-d');
    }

    /**
     * Set the value of idIntegracao
     *
     * @return  self
     */
    public function setIdIntegracao($idIntegracao)
    {
        $this->idIntegracao = $idIntegracao;

        return $this;
    }
}