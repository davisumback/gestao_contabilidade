<?php
namespace App\Controller\Nfse;

class NotaFiscalController
{
    private $attributes;

    public function setAttributes($attributes)
    {
        if (empty($attributes)) {
            throw new \Exception("Sem parametros!", 1);
        }
        $this->attributes = $attributes;
    }

    public function cancelaNota()
    {
        $notaFiscalApi = new \App\Model\Nfse\NotaFiscalApi();
        $retorno = $notaFiscalApi->cancela($this->attributes['notaFiscalId']);

        if ($retorno['respostaHttp'] == 200) {
            $dados = json_decode($retorno['dados']);
            
            $dao = new \App\DAO\EmpresaNfseDAO();
            $dao->setProcessando($this->attributes['notaFiscalId'], $dados->message, $dados->data->protocol);

            return 'Sucesso ao informar o cancelamento.';    
        }

        return 'Falha ao informar o cancelamento.';
    }

    public function emitePresumido()
    {
        $empresasId = $this->attributes['empresasId'];
        
        $empresa = new \App\Model\Empresa\Empresa();
        $empresa->isEmpresa($empresasId);
        
        $cnae = $empresa->getCnaePrincipal($empresasId);
        
        $cnpjRazaoSocial = $empresa->getCnpjRazaoSocial($empresasId);
        $cnpj = $cnpjRazaoSocial['cnpj'];
        $razaoSocial = $cnpjRazaoSocial['razaoSocial'];

        $enderecoBd = $empresa->getEndereco($empresasId);

        $auxiliar = new \App\Model\Nfse\AuxiliarApi();
        $retorno = $auxiliar->consultaCep($enderecoBd['cep']);
        $retorno = json_decode($retorno['dados']);
        $codigoCidade = $retorno->ibge;

        $endereco = new \App\Model\Nfse\Endereco($enderecoBd['logradouro'], $enderecoBd['numero'], $codigoCidade, $enderecoBd['cep']);
        $certificadoId = $empresa->getCertificadoId($empresasId);

        $inscricaoMunicipal = $empresa->getInscricaoMunicipal($empresasId);
        $regimeTributario = $empresa->getRegimeTributario($empresasId);
        $regimeTributario = ($regimeTributario == 'SN') ? true : false;

        $acessoBd = $empresa->getAcesso($empresasId);
        $prefeitura = new \App\Model\Nfse\Prefeitura($acessoBd['login'], $acessoBd['senha']);

        $config = new \App\Model\Nfse\Config();
        $config->setPrefeitura($prefeitura);

        $prestador = new \App\Model\Nfse\Prestador(
            $cnpj,
            $inscricaoMunicipal,
            $razaoSocial,
            $regimeTributario,
            $endereco,
            $certificadoId,
            $config
        );

        $cnpjValueObject = new \App\Model\ValueObject\Cnpj($this->attributes['cnpjTomador']);
        $retornoCnpj = $auxiliar->consultaCnpj($cnpjValueObject->getCnpj());
        $retornoCnpj = json_decode($retornoCnpj['dados']);
        $razaoSocialTomador = $retornoCnpj->razao_social;

        $auxiliar = new \App\Model\Nfse\AuxiliarApi();
        $retorno = $auxiliar->consultaCep($retornoCnpj->endereco->cep);
        $retorno = json_decode($retorno['dados']);
        $codigoCidade = $retorno->ibge;

        $enderecoTomador = new \App\Model\Nfse\Endereco(
            $retornoCnpj->endereco->logradouro, $retornoCnpj->endereco->numero, $codigoCidade, $retornoCnpj->endereco->cep
        );
        $enderecoTomador->setBairro($retornoCnpj->endereco->bairro);
        $enderecoTomador->setDescricaoCidade($retornoCnpj->endereco->municipio);
        $enderecoTomador->setEstado($retornoCnpj->endereco->uf);
        
        $tomador = new \App\Model\Nfse\Tomador($this->attributes['cnpjTomador'], $razaoSocialTomador, $this->attributes['emailTomador'], $enderecoTomador);

        $iss = new \App\Model\Nfse\Iss($this->attributes['issAliquota']);

        $valor = new \App\Model\Nfse\Valor(\App\Helper\Helpers::formataMoedaBd($this->attributes['valorNota']));

        $descricaoTemp = json_encode(\App\Helper\Helpers::retiraCaracteresEspeciais($this->attributes['descricao']), JSON_UNESCAPED_UNICODE);
        $descricaoTemp = str_replace('\r\n', '||', $descricaoTemp);

        $servico = new \App\Model\Nfse\Servico(
            $this->attributes['codigoServico'],
            $descricaoTemp,
            $cnae,
            $iss,
            $valor
        );

        $retencao = new \App\Model\Nfse\Retencao();

        if ($this->attributes['pisAliquota'] != 0) {
            $pis = new \App\Model\Nfse\Pis($this->attributes['pisAliquota'], $this->attributes['pisValor']);
            $retencao->setPis($pis);
        }

        if ($this->attributes['cofinsAliquota'] != 0) {
            $cofins = new \App\Model\Nfse\Cofins($this->attributes['cofinsAliquota'], $this->attributes['cofinsValor']);
            $retencao->setCofins($cofins);
        }

        if ($this->attributes['csllAliquota'] != 0) {
            $csll = new \App\Model\Nfse\Csll($this->attributes['csllAliquota'], $this->attributes['csllValor']);
            $retencao->setCsll($csll);
        }

        if ($this->attributes['irrfAliquota'] != 0) {
            $irrf = new \App\Model\Nfse\Irrf($this->attributes['irrfAliquota'], $this->attributes['irrfValor']);
            $retencao->setIrrf($irrf);
        }

        $servico->setRetencao($retencao);

        $notaFiscal = new \App\Model\Nfse\NotaFiscal($prestador, $tomador, $servico);

        $notaFiscalApi = new \App\Model\Nfse\NotaFiscalApi();
        $retorno = $notaFiscalApi->envia($notaFiscal);

        if ($retorno['respostaHttp'] != 200) {
            throw new \Exception("Erro ao emitir a Nota Fiscal!", 1);            
        }

        $retornoFormatado = json_decode($retorno['dados'], true);

        $dao = new \App\DAO\EmpresaNfseDAO();
        $dao->inserePrimeiroRetorno(
            $empresasId,
            $retornoFormatado['documents'][0]['id'],
            $retornoFormatado['protocol'],
            $retornoFormatado['message'],
            \App\Helper\Helpers::formataMoedaBd($this->attributes['valorNota'])
        );
        
        return 'Sucesso ao enviar a Nota Fiscal.';
    }
    
    public function emiteSimplesNacional()
    {
        $empresasId = $this->attributes['empresasId'];
        
        $empresa = new \App\Model\Empresa\Empresa();
        $empresa->isEmpresa($empresasId);
        
        $cnae = $empresa->getCnaePrincipal($empresasId);
        
        $cnpjRazaoSocial = $empresa->getCnpjRazaoSocial($empresasId);
        $cnpj = $cnpjRazaoSocial['cnpj'];
        $razaoSocial = $cnpjRazaoSocial['razaoSocial'];

        $enderecoBd = $empresa->getEndereco($empresasId);

        $auxiliar = new \App\Model\Nfse\AuxiliarApi();
        $retorno = $auxiliar->consultaCep($enderecoBd['cep']);
        $retorno = json_decode($retorno['dados']);
        $codigoCidade = $retorno->ibge;

        $endereco = new \App\Model\Nfse\Endereco($enderecoBd['logradouro'], $enderecoBd['numero'], $codigoCidade, $enderecoBd['cep']);

        $certificadoId = $empresa->getCertificadoId($empresasId);

        $inscricaoMunicipal = $empresa->getInscricaoMunicipal($empresasId);
        $regimeTributario = $empresa->getRegimeTributario($empresasId);
        $regimeTributario = ($regimeTributario == 'SN') ? true : false;

        $acessoBd = $empresa->getAcesso($empresasId);
        $prefeitura = new \App\Model\Nfse\Prefeitura($acessoBd['login'], $acessoBd['senha']);

        $config = new \App\Model\Nfse\Config();
        $config->setPrefeitura($prefeitura);

        $prestador = new \App\Model\Nfse\Prestador(
            $cnpj,
            $inscricaoMunicipal,
            $razaoSocial,
            $regimeTributario,
            $endereco,
            $certificadoId,
            $config
        );

        $cnpjValueObject = new \App\Model\ValueObject\Cnpj($this->attributes['cnpjTomador']);
        $retornoCnpj = $auxiliar->consultaCnpj($cnpjValueObject->getCnpj());
        $retornoCnpj = json_decode($retornoCnpj['dados']);
        $razaoSocialTomador = $retornoCnpj->razao_social;

        $auxiliar = new \App\Model\Nfse\AuxiliarApi();
        $retorno = $auxiliar->consultaCep($retornoCnpj->endereco->cep);
        $retorno = json_decode($retorno['dados']);
        $codigoCidade = $retorno->ibge;

        $enderecoTomador = new \App\Model\Nfse\Endereco(
            $retornoCnpj->endereco->logradouro, $retornoCnpj->endereco->numero, $codigoCidade, $retornoCnpj->endereco->cep
        );
        $enderecoTomador->setBairro($retornoCnpj->endereco->bairro);
        $enderecoTomador->setDescricaoCidade($retornoCnpj->endereco->municipio);
        $enderecoTomador->setEstado($retornoCnpj->endereco->uf);

        $tomador = new \App\Model\Nfse\Tomador($this->attributes['cnpjTomador'], $razaoSocialTomador, $this->attributes['emailTomador'], $enderecoTomador);

        $iss = new \App\Model\Nfse\Iss($this->attributes['issAliquota']);

        $valor = new \App\Model\Nfse\Valor(\App\Helper\Helpers::formataMoedaBd($this->attributes['valorNota']));

        $descricaoTemp = json_encode(\App\Helper\Helpers::retiraCaracteresEspeciais($this->attributes['descricao']), JSON_UNESCAPED_UNICODE);
        $descricaoTemp = str_replace('\r\n', '||', $descricaoTemp);

        $servico = new \App\Model\Nfse\Servico(
            $this->attributes['codigoServico'],
            $descricaoTemp,
            $cnae,
            $iss,
            $valor
        );

        $notaFiscal = new \App\Model\Nfse\NotaFiscal($prestador, $tomador, $servico);

        $notaFiscalApi = new \App\Model\Nfse\NotaFiscalApi();
        $retorno = $notaFiscalApi->envia($notaFiscal);

        if ($retorno['respostaHttp'] != 200) {
            throw new \Exception("Erro ao emitir a Nota Fiscal!", 1);            
        }

        $retornoFormatado = json_decode($retorno['dados'], true);

        $dao = new \App\DAO\EmpresaNfseDAO();
        $dao->inserePrimeiroRetorno(
            $empresasId,
            $retornoFormatado['documents'][0]['id'],
            $retornoFormatado['protocol'],
            $retornoFormatado['message'],
            \App\Helper\Helpers::formataMoedaBd($this->attributes['valorNota'])
        );

        return 'Sucesso ao enviar a Nota Fiscal.';
    }
}