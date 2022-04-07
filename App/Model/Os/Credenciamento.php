<?php
namespace App\Model\Os;

use App\Helper\Helpers;

class Credenciamento
{
    private $attributes;

    public function setAttributes($attributes)
    {
        if (empty($attributes)) {
            throw new \Exception("Você não pode acessar essa área do sistema.", 1);
        }
        $this->attributes = $attributes;
    }

    public function saveOsCredenciamento()
    {
        try {
            $dao = new \App\DAO\EmpresaDAO();

            if ($dao->isEmpresa($this->attributes['empresasId']) == null) {
                throw new \Exception("Erro! Empresa não encontrada.", 1);
            }

            $edital = new \App\Model\Empresa\Edital();
            $edital->setEdital($this->attributes['edital']);
            $pastaEdital = $edital->uploadEdital($this->attributes['empresasId']);
          
            $dao = new \App\DAO\OrdemDeServicoDAO();
            $retorno = $dao->insereOrdemDeServico('Credenciamento', $this->attributes['tipoOs']);

            $credenciamentoDao = new \App\DAO\CredenciamentoDAO();
            $credenciamentosId = $credenciamentoDao->insereCredencimaneto(
                $this->attributes['empresasId'], 
                $retorno['ordensDeServicosId'], 
                $pastaEdital,
                $this->attributes['edital']['name']
            );

            if ($this->attributes['possuiProposta'] == 'S') {
                foreach ($this->attributes['itensProposta'] as $chaveArray => $proposta) {
                    $credenciamentoDao->inserePropostaCredenciamento($credenciamentosId, Helpers::formataMoedaBd($proposta['valor']), $proposta['descricao']);
                    $dao->insertItensOs($retorno['ordensDeServicosId'], $chaveArray);
                }
            }
            
            $dao->insereUsuarioMedcontabilOsEmissao($retorno['ordensDeServicosId'], $this->attributes['usuariosId'], $this->attributes['empresasId']);
            $dao->insereUsuarioOsEmissao($retorno['ordensDeServicosId'], $this->attributes['usuariosId'], $this->attributes['empresasId']);
            $retornoGestor = $dao->getGestorEmpresa($this->attributes['empresasId']);
            $dao->insereUsuarioOsRecebe($retorno['ordensDeServicosId'], $this->attributes['empresasId'], $retornoGestor['gestorId']);

        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage(), 1);
        }
    }

    public function saveOsCredenciamentoMedcontabil()
    {
        try {
            $dao = new \App\DAO\EmpresaDAO();

            if ($dao->isEmpresa($this->attributes['empresasId']) == null) {
                throw new \Exception("Erro! Empresa não encontrada.", 1);
            }

            $edital = new \App\Model\Empresa\Edital();
            $edital->setEdital($this->attributes['edital']);
            $pastaEdital = $edital->uploadEdital($this->attributes['empresasId']);
          
            $dao = new \App\DAO\OrdemDeServicoDAO();
            $retorno = $dao->insereOrdemDeServico('Credenciamento', $this->attributes['tipoOs']);

            $credenciamentoDao = new \App\DAO\CredenciamentoDAO();
            $credenciamentosId = $credenciamentoDao->insereCredencimaneto(
                $this->attributes['empresasId'], 
                $retorno['ordensDeServicosId'], 
                $pastaEdital,
                $this->attributes['edital']['name']
            );

            if ($this->attributes['possuiProposta'] == 'S') {
                foreach ($this->attributes['itensProposta'] as $chaveArray => $proposta) {
                    $credenciamentoDao->inserePropostaCredenciamento($credenciamentosId, Helpers::formataMoedaBd($proposta['valor']), $proposta['descricao']);
                    $dao->insertItensOs($retorno['ordensDeServicosId'], $chaveArray);
                }
            }
            
            $dao->insereUsuarioMedcontabilOsEmissao($retorno['ordensDeServicosId'], $this->attributes['usuariosId'], $this->attributes['empresasId']);
            $retornoGestor = $dao->getGestorEmpresa($this->attributes['empresasId']);
            $dao->insereUsuarioOsRecebe($retorno['ordensDeServicosId'], $this->attributes['empresasId'], $retornoGestor['gestorId']);

        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage(), 1);
        }
    }

    public function getDadosCredenciamento($ordensDeServicosId) 
    {
        $credenciamentoDao = new \App\DAO\CredenciamentoDAO();
        
        return $credenciamentoDao->getDadosCredenciamento($ordensDeServicosId);
    }

    public function atendeCredenciamento()
    {
        if (empty($this->attributes['arquivos']['name'][0])) {
            throw new \Exception("Erro! Você precisa fazer dos arquivos do credenciamento.", 1);            
        }

        foreach ($this->attributes['arquivos'] as $arquivo => $valorArray) {
            if ($arquivo == 'type') {
                foreach($valorArray as $valor) {
                    if ($valor != 'application/pdf' && $valor != 'application/octet-stream' && $valor != 'application/msword' && $valor != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                        throw new \Exception("Os arquivos só podem ser no formato PDF, .DOC ou .DOCX", 1);
                    }
                }
            }
        }

        $empresasId = $this->attributes['empresasId'];
        $pastaCredenciamento = '../../../grupobfiles/empresas/' . $empresasId . '/credenciamento' . '/' . $this->attributes['pastaCredenciamento'];
        
        if (! \is_dir($pastaCredenciamento)) {
            throw new \Exception("Erro! A pasta do credenciamento não foi encontrada.", 1);
        }
        
        foreach ($this->attributes['arquivos']['name'] as $arquivo) {
            if (is_file($pastaCredenciamento . '/' . $arquivo)) {
                throw new \Exception("Erro! Já existe um arquivo com o mesmo nome.", 1);
            }
        }

        $uploadArquivo = new \App\Arquivo\UploadArquivo();

        foreach ($this->attributes['arquivos']['name'] as $chave => $arquivo) {
            $retornoUpload = $uploadArquivo->uploadArchive(
                $this->attributes['arquivos']['tmp_name'][$chave],
                $arquivo,
                $pastaCredenciamento
            );
        }

        $ordemDeServico = new OrdemDeServico();
        $ordemDeServico->updateOs('FINALIZADA', $this->attributes['ordemDeServicoId']);

        if ($this->attributes['enviaEmail'] == 'on') {
            // Obter endereço de email do cliente através do número da empresas
            $dao = new \App\DAO\EmpresaEmailDAO();
            $empresaEmail = $dao->getEmpresaEmail($this->attributes['empresasId']);

            // Nome da empresa do cliente
            $empresaNome = $empresaEmail[0]['nome_completo'];
            
            // Email do gestor
            $emailGestor = $empresaEmail[0]['email_gestor'];
            $emailsCopia [] = $emailGestor;
            
            if (sizeof($empresaEmail) > 1) {
                for ($i=1; $i < sizeof($empresaEmail); $i++) {
                    $emailsCopia [] = $empresaEmail[$i]['email'];
                }
            } else {
                $emailsCopia [] = $empresaEmail[0]['email'];
            }

            try {
                $anexo = array();

                foreach ($this->attributes['arquivos']['name'] as $arquivo) {
                    $anexo[] = $pastaCredenciamento . '/' . $arquivo;
                }

                $this->attributes['usuariosId'] = $empresaEmail[0]['gestorId']; 
                $credenciamento = new \App\Model\Email\Os\CredenciamentoEmail($this->attributes);
                $credenciamento->enviaEmail($empresaEmail[0]['email'], $empresaNome, $emailsCopia, $anexo);

            } catch (\Exception $e) {
                throw new \Exception('OS atendida, porém não foi enviado e-mail ao cliente! ' . $e->getMessage(), 1);
            }
        }
    }
}