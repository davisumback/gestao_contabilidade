<?php
namespace App\Model\Os;

class DeclaracaoRendimentos
{
    private $attributes;

    public function setAttributes($attributes)
    {
        if (empty($attributes)) {
            throw new \Exception("Você não pode acessar essa área do sistema.", 1);
        }
        $this->attributes = $attributes;
    }

    public function saveOsDeclaracaoRendimentos()
    {
        try {
            $dao = new \App\DAO\OrdemDeServicoDAO();
            $retorno = $dao->insereOrdemDeServico('Declaração de Rendimentos', $this->attributes['tipoOs']);
            $dao->insertItensOsDeclaracaoRendimentos($retorno['ordensDeServicosId'], 1, $this->attributes['clientesId']); // Nesse caso só tem um tipo de Declaracao de Rendimentos
            $dao->insereUsuarioOsEmissao($retorno['ordensDeServicosId'], $this->attributes['usuariosId'], $this->attributes['empresasId']);
            $retornoGestor = $dao->getGestorEmpresa($this->attributes['empresasId']);
            $dao->insereUsuarioOsRecebe($retorno['ordensDeServicosId'], $this->attributes['empresasId'], $retornoGestor['gestorId']);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage(), 1);
        }
    }

    public function saveOsDeclaracaoRendimentosMedcontabil()
    {
        try {
            $dao = new \App\DAO\OrdemDeServicoDAO();
            $retorno = $dao->insereOrdemDeServico('Declaração de Rendimentos', $this->attributes['tipoOs']);
            $dao->insertItensOsDeclaracaoRendimentos($retorno['ordensDeServicosId'], 1, $this->attributes['usuariosId']); // Nesse caso só tem um tipo de Declaracao de Rendimentos
            $dao->insereUsuarioOsEmissaoMedcontabil($retorno['ordensDeServicosId'], $this->attributes['usuariosId'], $this->attributes['empresasId']);
            $retornoGestor = $dao->getGestorEmpresa($this->attributes['empresasId']);
            $dao->insereUsuarioOsRecebe($retorno['ordensDeServicosId'], $this->attributes['empresasId'], $retornoGestor['gestorId']);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage(), 1);
        }
    }

    public function atendeDeclaracaoRendimentos()
    {
        if (! array_key_exists('declaracao', $this->attributes)) {
            throw new \Exception("Erro! Você precisa fazer o upload da declaração.", 1);            
        }

        $empresasId = $this->attributes['empresasId'];
        $pastaDeclaracoes = '../../../grupobfiles/empresas/' . $empresasId . '/declaracoes';

        if (! is_dir($pastaDeclaracoes)) {
            $criaPasta = new \App\Arquivo\CriaPasta();
            $criaPasta->criaPasta($pastaDeclaracoes);
        }

        if (is_file($pastaDeclaracoes . '/' . $this->attributes['declaracao']['name'])) {
            throw new \Exception("Erro! Já existe um arquivo com esse nome.", 1);
        }
        
        $uploadArquivo = new \App\Arquivo\UploadArquivo();
        $retornoUpload = $uploadArquivo->uploadArchive(
            $this->attributes['declaracao']['tmp_name'],
            $this->attributes['declaracao']['name'],
            $pastaDeclaracoes
        );

        $dao = new \App\DAO\EmpresaDAO();
        $dao->insereDeclaracaoEmpresa($this->attributes['empresasId'], 1, $this->attributes['declaracao']['name']);
        
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
                $anexo['declaracao'] = $pastaDeclaracoes . '/' . $this->attributes['declaracao']['name'];
                $this->attributes['usuariosId'] = $empresaEmail[0]['gestorId']; // para passar o Id do gestor para o email, e não o do contador.
                $declaracaoEmail = new \App\Model\Email\Os\DeclaracaoRendimentosEmail($this->attributes);
                $declaracaoEmail->enviaEmail($empresaEmail[0]['email'], $empresaNome, $emailsCopia, $anexo);
            } catch (\Exception $e) {
                throw new \Exception('OS atendida, porém não foi enviado e-mail ao cliente! ' . $e->getMessage(), 1);
                // $caminhoView .= '/ordem-servico-lista.php?view=all&tipoOs=all&status=all&periodo=30&method=getAllRecebidas';
                // $this->redirectErro('insercaoOs', 'mensagemInsercaoOs', 'OS atendida, porém não foi enviado e-mail ao cliente! ' . $e->getMessage(), $caminhoView);
            }
        }
    }
}