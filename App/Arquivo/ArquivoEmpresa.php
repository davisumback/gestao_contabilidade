<?php

namespace App\Arquivo;

class ArquivoEmpresa
{
    private $diretorioRoot;
    private $diretorioEmpresas;
    const DIRETORIO_EMPRESAS = '/grupobfiles/empresas';
    const PASTA_ABERTURA = '/abertura';
    const PASTA_ALVARA = '/alvara';
    const PASTA_CERTIDAO_DE_CONDUTA = '/certidao-de-conduta';
    const PASTA_CERTIDAO_DE_DEBITOS = '/certidao-de-debitos';
    const PASTA_CERTIDAO_DE_INSCRICAO = '/certidao-de-inscricao';
    const PASTA_CERTIDAO_ESTADUAL = '/certidao-estadual';
    const PASTA_CERTIDAO_FEDERAL = '/certidao-federal';
    const PASTA_CERTIDAO_FGTS = '/certidao-fgts';
    const PASTA_CERTIDAO_MUNICIPAL = '/certidao-municipal';
    const PASTA_CERTIDAO_TRABALHISTA = '/certidao-trabalhista';
    const PASTA_CNPJ = '/cnpj';
    const PASTA_CONTRATO_SOCIAL = '/contrato-social';
    const PASTA_CREDENCIAMENTO = '/credenciamento';
    const PASTA_DECLARACAO = '/declaracao';
    const PASTA_ENQUADRAMENTO = '/enquadramento';
    const PASTA_IMPOSTOS = '/impostos';
    const PASTA_IRPF = '/irpf';
    const PASTA_NOTA_FISCAL = '/nota-fiscal';
    const PASTA_PROCURACAO_ELETRONICA = '/procuracao-eletronica';
    const PASTA_SIMPLES_NACIONAL = '/simples-nacional';

    public function __construct()
    {
        $this->diretorioRoot = $_SERVER['DOCUMENT_ROOT'];
    }

    public function criaPastasPadraoEmpresa($numeroEmpresa)
    {
        $this->diretorioEmpresas = $this->diretorioRoot . self::DIRETORIO_EMPRESAS;
        $diretorioEmpresa = $this->diretorioEmpresas . '/' . $numeroEmpresa;

        $oldmask = umask(0);
        mkdir($diretorioEmpresa, 0777);
        mkdir($diretorioEmpresa.self::PASTA_ABERTURA, 0777);
        mkdir($diretorioEmpresa.self::PASTA_ALVARA, 0777);
        mkdir($diretorioEmpresa.self::PASTA_CERTIDAO_DE_CONDUTA, 0777);
        mkdir($diretorioEmpresa.self::PASTA_CERTIDAO_DE_DEBITOS, 0777);
        mkdir($diretorioEmpresa.self::PASTA_CERTIDAO_DE_INSCRICAO, 0777);
        mkdir($diretorioEmpresa.self::PASTA_CERTIDAO_ESTADUAL, 0777);
        mkdir($diretorioEmpresa.self::PASTA_CERTIDAO_FEDERAL, 0777);
        mkdir($diretorioEmpresa.self::PASTA_CERTIDAO_FGTS, 0777);
        mkdir($diretorioEmpresa.self::PASTA_CERTIDAO_MUNICIPAL, 0777);
        mkdir($diretorioEmpresa.self::PASTA_CERTIDAO_TRABALHISTA, 0777);
        mkdir($diretorioEmpresa.self::PASTA_CNPJ, 0777);
        mkdir($diretorioEmpresa.self::PASTA_CONTRATO_SOCIAL, 0777);
        mkdir($diretorioEmpresa.self::PASTA_CREDENCIAMENTO, 0777);
        mkdir($diretorioEmpresa.self::PASTA_DECLARACAO, 0777);
        mkdir($diretorioEmpresa.self::PASTA_ENQUADRAMENTO, 0777);
        mkdir($diretorioEmpresa.self::PASTA_IMPOSTOS, 0777);
        mkdir($diretorioEmpresa.self::PASTA_IRPF, 0777);
        mkdir($diretorioEmpresa.self::PASTA_NOTA_FISCAL, 0777);
        mkdir($diretorioEmpresa.self::PASTA_PROCURACAO_ELETRONICA, 0777);
        mkdir($diretorioEmpresa.self::PASTA_SIMPLES_NACIONAL, 0777);
        umask($oldmask);
    }
}
