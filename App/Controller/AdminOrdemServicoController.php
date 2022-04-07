<?php
namespace App\Controller;

use App\Model\Os\OrdemDeServico;
use App\Model\Os\TipoOrdemDeServico;
use App\View\Os\OrdemDeServicoView;
use App\DAO\EmpresaDAO;
use App\Helper\Helpers;
use App\Controller\Controller;

class AdminOrdemServicoController extends Controller
{
    private $session;

    public function __construct()
    {
        session_start();
        $this->session = $_SESSION;
    }

    public function storeOsOutros($request)
    {
        $caminho = '../../' . $this->session['pasta'];
        $tipoOs = $request['tipoOs'];

        try {
            $outros = new \App\Model\Os\Outros();
            $outros->setAttributes($request);
            $outros->saveOsOutros();
        } catch (\Throwable $th) {
            $caminho .= '/ordem-servico-lista.php?method=getAllEmitidas&tipoOs=' . $tipoOs;
            $this->redirectErro('insercaoOs', 'mensagemInsercaoOs', $th->getMessage(), $caminho);
        }

        $caminho .= '/ordem-servico-lista.php?method=getAllEmitidas&view=all&tipoOs=all&status=all&periodo=30';
        $this->redirectSucesso('insercaoOs', 'mensagemInsercaoOs', 'Sucesso ao criar sua Ordem de Serviço.', $caminho);
    }

    public function atendeOsOutros($request)
    {
        $caminho = '../../' . $this->session['pasta'];
        $ordemDeServicoId = $request['ordemDeServicoId'];

        try {
            $outros = new \App\Model\Os\Outros();
            $outros->setAttributes($request);
            $outros->atende();
        } catch (\Throwable $th) {
            $caminho .= '/ordem-servico.php?method=getOsCredenciamento&situation=getAllRecebidas&os=' . $ordemDeServicoId;
            $this->redirectErro('insercaoOs', 'mensagemInsercaoOs', $th->getMessage(), $caminho);
        }

        $caminho .= '/ordem-servico-lista.php?view=all&tipoOs=all&status=all&periodo=30&method=getAllRecebidas';
        $this->redirectSucesso('insercaoOs', 'mensagemInsercaoOs', 'Sucesso ao atender a OS.', $caminho);  
    }

    public function atendeOsCredenciamento($request)
    {
        $caminho = '../../' . $this->session['pasta'];
        $ordemDeServicoId = $request['ordemDeServicoId'];

        try {
            $request['arquivos'] = $_FILES['arquivos'];
            $credenciamento = new \App\Model\Os\Credenciamento();
            $credenciamento->setAttributes($request);
            $credenciamento->atendeCredenciamento();
        } catch (\Throwable $th) {
            $caminho .= '/ordem-servico.php?method=getOsCredenciamento&situation=getAllRecebidas&os=' . $ordemDeServicoId;
            $this->redirectErro('insercaoOs', 'mensagemInsercaoOs', $th->getMessage(), $caminho);
        }

        $caminho .= '/ordem-servico-lista.php?view=all&tipoOs=all&status=all&periodo=30&method=getAllRecebidas';
        $this->redirectSucesso('insercaoOs', 'mensagemInsercaoOs', 'Sucesso ao atender a OS.', $caminho);  
    }

    public function storeOsCredenciamento($request)
    {
        $caminho = '../../' . $this->session['pasta'];
        $tipoOs = $request['tipoOs'];

        try {
            $_POST['edital'] = $_FILES['edital'];
            $credenciamento = new \App\Model\Os\Credenciamento();
            $credenciamento->setAttributes($_POST);
            $credenciamento->saveOsCredenciamento();
        } catch (\Throwable $th) {
            $caminho .= '/ordem-servico-lista.php?method=getAllEmitidas&tipoOs=' . $tipoOs;
            $this->redirectErro('insercaoOs', 'mensagemInsercaoOs', $th->getMessage(), $caminho);
        }

        $caminho .= '/ordem-servico-lista.php?method=getAllEmitidas&view=all&tipoOs=all&status=all&periodo=30';
        $this->redirectSucesso('insercaoOs', 'mensagemInsercaoOs', 'Sucesso ao criar sua Ordem de Serviço.', $caminho);
    }

    public function storeOsCredenciamentoMedcontabil($request)
    {
        $caminho = '../../' . $this->session['pasta'];
        $tipoOs = $request['tipoOs'];

        try {
            $_POST['edital'] = $_FILES['edital'];
            $credenciamento = new \App\Model\Os\Credenciamento();
            $credenciamento->setAttributes($_POST);
            $credenciamento->saveOsCredenciamentoMedcontabil();
        } catch (\Throwable $th) {
            $caminho .= '/ordem-servico-lista.php?method=getAllEmitidasMedcontabil&tipoOs=' . $tipoOs;
            $this->redirectErro('insercaoOs', 'mensagemInsercaoOs', $th->getMessage(), $caminho);
        }

        $caminho .= '/ordem-servico-lista.php?method=getAllEmitidasMedcontabil&view=all&tipoOs=all&status=all&periodo=30';
        $this->redirectSucesso('insercaoOs', 'mensagemInsercaoOs', 'Sucesso ao criar sua Ordem de Serviço.', $caminho);
    }

    public function storeOsAlterarEndereco($request)
    {
        $caminho = '../../' . $this->session['pasta'];
        $tipoOs = $request['tipoOs'];

        try {
            $_POST['novoEndereco'] = $_FILES['novoEndereco'];
            $alteracaoEndereco = new \App\Model\Os\AlteracaoEndereco();
            $alteracaoEndereco->setAttributes($_POST);
            $alteracaoEndereco->saveOsAlteracaoEndereco();
        } catch (\Throwable $th) {
            $caminho .= '/ordem-servico-lista.php?method=getAllEmitidas&tipoOs=' . $tipoOs;
            $this->redirectErro('insercaoOs', 'mensagemInsercaoOs', $th->getMessage(), $caminho);
        }

        $caminho .= '/ordem-servico-lista.php?method=getAllEmitidas&view=all&tipoOs=all&status=all&periodo=30';
        $this->redirectSucesso('insercaoOs', 'mensagemInsercaoOs', 'Sucesso ao criar sua Ordem de Serviço.', $caminho);
    }

    public function storeOsDeclaracaoRendimentos($request)
    {
        $caminho = '../../' . $this->session['pasta'];
        $tipoOs = $request['tipoOs'];

        try {
            $declaracaoRendimentos = new \App\Model\Os\DeclaracaoRendimentos();
            $declaracaoRendimentos->setAttributes($_POST);
            $declaracaoRendimentos->saveOsDeclaracaoRendimentos();
        } catch (\Throwable $th) {
            $caminho .= '/ordem-servico-lista.php?method=getAllEmitidas&tipoOs=' . $tipoOs;
            $this->redirectErro('insercaoOs', 'mensagemInsercaoOs', $th->getMessage(), $caminho);
        }

        $caminho .= '/ordem-servico-lista.php?method=getAllEmitidas&view=all&tipoOs=all&status=all&periodo=30';
        $this->redirectSucesso('insercaoOs', 'mensagemInsercaoOs', 'Sucesso ao criar sua Ordem de Serviço.', $caminho);
    }

    public function storeOsDeclaracaoRendimentosMedcontabil($request)
    {
        $caminho = '../../' . $this->session['pasta'];
        $tipoOs = $request['tipoOs'];

        try {
            $declaracaoRendimentos = new \App\Model\Os\DeclaracaoRendimentos();
            $declaracaoRendimentos->setAttributes($_POST);
            $declaracaoRendimentos->saveOsDeclaracaoRendimentosMedcontabil();
        } catch (\Throwable $th) {
            $caminho .= '/ordem-servico-lista.php?method=getAllEmitidasMedcontabil&tipoOs=' . $tipoOs;
            $this->redirectErro('insercaoOs', 'mensagemInsercaoOs', $th->getMessage(), $caminho);
        }

        $caminho .= '/ordem-servico-lista.php?method=getAllEmitidasMedcontabil&view=all&tipoOs=all&status=all&periodo=30';
        $this->redirectSucesso('insercaoOs', 'mensagemInsercaoOs', 'Sucesso ao criar sua Ordem de Serviço.', $caminho);
    }

    public function storeRecalculoGuia($request)
    {
        $caminho = '../../' . $this->session['pasta'];
        $tipoOs = $request['tipoOs'];

        try {
            $recalculoGuia = new \App\Model\Os\RecalculoGuia();
            $recalculoGuia->setAttributes($request);
            $recalculoGuia->saveOsRecalculoGuia();
        } catch (\Exception $e) {
            $caminho .= '/ordem-servico-lista.php?method=getAllEmitidas&tipoOs=' . $tipoOs;
            $this->redirectErro('insercaoOs', 'mensagemInsercaoOs', $e->getMessage(), $caminho);
        }

        $caminho .= '/ordem-servico-lista.php?method=getAllEmitidas&view=all&tipoOs=all&status=all&periodo=30';
        $this->redirectSucesso('insercaoOs', 'mensagemInsercaoOs', 'Sucesso ao criar sua Ordem de Serviço.', $caminho);
    }

    public function storeRecalculoGuiaMedcontabil($request)
    {
        $caminho = '../../' . $this->session['pasta'];
        $tipoOs = $request['tipoOs'];

        try {
            $recalculoGuia = new \App\Model\Os\RecalculoGuia();
            $recalculoGuia->setAttributes($request);
            $recalculoGuia->saveOsRecalculoGuiaMedcontabil();
        } catch (\Exception $e) {
            $caminho .= '/ordem-servico-lista.php?method=getAllEmitidasMedcontabil&tipoOs=' . $tipoOs;
            $this->redirectErro('insercaoOs', 'mensagemInsercaoOs', $e->getMessage(), $caminho);
        }

        $caminho .= '/ordem-servico-lista.php?method=getAllEmitidasMedcontabil&view=all&tipoOs=all&status=all&periodo=30';
        $this->redirectSucesso('insercaoOs', 'mensagemInsercaoOs', 'Sucesso ao criar sua Ordem de Serviço.', $caminho);
    }

    public function storeOsCertidao($request)
    {
        $caminho = '../../' . $this->session['pasta'];
        $tipoOs = $request['tipoOs'];

        if (! array_key_exists('certidoes', $request)) {
            $caminho .= '/ordem-servico-lista.php?method=getAllEmitidas&tipoOs=' . $tipoOs;
            $this->redirect('false', 'Erro! Você precisa selecionar pelo menos um tipo de Certidão.', $caminho);
        }

        $dao = new EmpresaDAO();
        $retorno = $dao->isEmpresa($request['empresasId']);

        if ($retorno == null) {
            $caminho .= '/ordem-servico-lista.php?method=getAllEmitidas&tipoOs=' . $tipoOs;                        
            $this->redirect('false', 'Erro! Empresa não existente', $caminho);
        }

        $os = new OrdemDeServico();
        $retorno = $os->saveOsCertidaoMedcontabil($request);

        if ($retorno == false) {
            $this->redirect('false', 'Erro! Não foi possível criar sua Ordem de Serviço.', $caminho);
        }

        $caminho .= '/ordem-servico-lista.php?method=getAllEmitidasMedcontabil&view=all&tipoOs=all&status=all&periodo=30';
        $this->redirect('true', 'Sucesso ao criar sua Ordem de Serviço.', $caminho);
    }

    public function storeOsCertidaoMedcontabil($request)
    {
        $caminho = '../../' . $this->session['pasta'];
        $tipoOs = $request['tipoOs'];

        if (! array_key_exists('certidoes', $request)) {
            $caminho .= '/ordem-servico-lista.php?method=getAllEmitidasMedcontabil&tipoOs=' . $tipoOs;
            $this->redirect('false', 'Erro! Você precisa selecionar pelo menos um tipo de Certidão.', $caminho);
        }

        $dao = new EmpresaDAO();
        $retorno = $dao->isEmpresa($request['empresasId']);

        if ($retorno == null) {
            $caminho .= '/ordem-servico-lista.php?method=getAllEmitidasMedcontabil&tipoOs=' . $tipoOs;                        
            $this->redirect('false', 'Erro! Empresa não existente', $caminho);
        }

        $os = new OrdemDeServico();
        $retorno = $os->saveOsCertidaoMedcontabil($request);

        if ($retorno == false) {
            $this->redirect('false', 'Erro! Não foi possível criar sua Ordem de Serviço.', $caminho);
        }

        $caminho .= '/ordem-servico-lista.php?method=getAllEmitidasMedcontabil&view=all&tipoOs=all&status=all&periodo=30';
        $this->redirect('true', 'Sucesso ao criar sua Ordem de Serviço.', $caminho);
    }

    public function atendeOsDeclaracaoRendimentos($attributes)
    {
        $caminho = '../../' . $this->session['pasta'];
        $ordemDeServicoId = $attributes['ordemDeServicoId'];

        try {
            $declaracaoRendimentos = new \App\Model\Os\DeclaracaoRendimentos();
            $attributes['declaracao'] = $_FILES['declaracao'];
            $declaracaoRendimentos->setAttributes($attributes);
            $declaracaoRendimentos->atendeDeclaracaoRendimentos();
        } catch (\Throwable $th) {
            $caminho .= '/ordem-servico.php?method=getOsDeclaracaoRendimento&situation=getAllRecebidas&os=' . $ordemDeServicoId;
            $this->redirectErro('insercaoOs', 'mensagemInsercaoOs', $th->getMessage(), $caminho);
        }

        $caminho .= '/ordem-servico-lista.php?view=all&tipoOs=all&status=all&periodo=30&method=getAllRecebidas';
        $this->redirectSucesso('insercaoOs', 'mensagemInsercaoOs', 'Sucesso ao atender a OS.', $caminho);        
    }

    public function atendeOsRecalculoGuia($attributes)
    {
        $caminho = '../../' . $this->session['pasta'];
        $ordemDeServicoId = $attributes['ordemDeServicoId'];

        try {
            $recalculoGuia = new \App\Model\Os\RecalculoGuia();
            $attributes['pasta'] = $this->session['pasta'];
            $recalculoGuia->atendeRecalculoGuia($attributes, $_FILES);
        } catch (\Throwable $th) {
            $caminho .= '/ordem-servico.php?method=getOsRecalculoGuia&situation=getAllRecebidas&os=' . $ordemDeServicoId;
            $this->redirectErro('insercaoOs', 'mensagemInsercaoOs', $th->getMessage(), $caminho);
        }

        $caminho .= '/ordem-servico-lista.php?view=all&tipoOs=all&status=all&periodo=30&method=getAllRecebidas';
        $this->redirectSucesso('insercaoOs', 'mensagemInsercaoOs', 'Sucesso ao atender a OS.', $caminho);        
    }

    public function atendeOsCertidao($attributes)
    {
        // Salva as certidões na pasta da empresa
        // E se já tiver uma certidão lá?
        // Salva os dados da certidão no banco (nome, data de validade...)
        // Envia as certidões por email para o cliente se marcado no checkbox
        // Marca como resolvida a OS

        $caminhoView = '../../' . $this->session['pasta'];
        $ordemDeServicoId = $attributes['ordemDeServicoId'];

        foreach ($_FILES['certidoes']['type'] as $tipo) {
            if ($tipo != 'application/pdf') {
                $caminhoView .= '/ordem-servico.php?method=getOsCertidao&situation=getAllRecebidas&os=' . $ordemDeServicoId;
                $this->redirectErro('insercaoOs', 'mensagemInsercaoOs', 'Erro! Só é permitido arquivo PDF.', $caminhoView);
            }
        }

        foreach ($attributes['certidaoDataValidade'] as $datas) {
            $retorno = \DateTime::createFromFormat('d/m/Y', $datas);
            if ($retorno == false) {
                $caminhoView .= '/ordem-servico.php?method=getOsCertidao&situation=getAllRecebidas&os=' . $ordemDeServicoId;
                $this->redirectErro('insercaoOs', 'mensagemInsercaoOs', 'Erro! Data inválida!', $caminhoView);
            }
        }
       

        $empresasId = $attributes['empresasId'];
        $certidoes = $_FILES['certidoes']['name'];
        $certidoesTemp = $_FILES['certidoes']['tmp_name'];
        $certidaoDataValidade = $attributes['certidaoDataValidade'];

        $pasta = '../../../grupobfiles/empresas/' . $empresasId . '/certidoes';

        if (count($_FILES['certidoes']['name']) !== count(array_unique($_FILES['certidoes']['name']))) {
            $caminhoView .= '/ordem-servico.php?method=getOsCertidao&situation=getAllRecebidas&os=' . $ordemDeServicoId;
            $this->redirectErro('insercaoOs', 'mensagemInsercaoOs', 'Erro! Existem arquivos com o mesmo nome.', $caminhoView);
        }

        if (! \is_dir($pasta)) {
            $criaPasta = new \App\Arquivo\CriaPasta();
            $criaPasta->criaPasta($pasta);
        }

        $uploadArquivo = new \App\Arquivo\UploadArquivo();
        $empresaCertidao = new \App\Model\Empresa\EmpresaCertidao();

        foreach ($certidoes as $certidaoId => $certidaoNome) {
            $retornoUpload = $uploadArquivo->uploadArchive($certidoesTemp[$certidaoId], $certidaoNome, $pasta);
            $retornoInsercao = $empresaCertidao->insereCertidaoEmpresa(
                $empresasId, 
                $certidaoId, 
                \App\Helper\Helpers::formataDataBd($certidaoDataValidade[$certidaoId]), 
                $certidaoNome
            );

            if ($retornoUpload == false || $retornoInsercao == false) {
                $caminhoView .= '/ordem-servico.php?method=getOsCertidao&situation=getAllRecebidas&os=' . $ordemDeServicoId; // aqui teria que voltar para a view de todas
                $this->redirectErro('insercaoOs', 'mensagemInsercaoOs', 'Erro ao atender essa OS!', $caminhoView);
            }
        }

        // MUDAR A OS COMO ANTENDIDA
        $ordemDeServico = new OrdemDeServico();
        $ordemDeServico->updateOs('FINALIZADA', $ordemDeServicoId);

        if ($attributes['enviaEmail'] == 'on') {
            // Obter endereço de email do cliente através do número da empresas
            $dao = new \App\DAO\EmpresaEmailDAO();
            $empresaEmail = $dao->getEmpresaEmail($attributes['empresasId']);

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

            foreach ($certidoes as $arquivo) {
                $anexos [] = $pasta . '/' . $arquivo;
            }

            try {
                $certidaoEmail = new \App\Model\Email\Os\CertidaoEmail($attributes);
                $certidaoEmail->enviaEmail($empresaEmail[0]['email'], $empresaNome, $emailsCopia, $anexos);
            } catch (\Exception $e) {
                $caminhoView .= '/ordem-servico-lista.php?view=all&tipoOs=all&status=all&periodo=30&method=getAllRecebidas';
                $this->redirectErro('insercaoOs', 'mensagemInsercaoOs', 'OS atendida, porém não foi enviado e-mail ao cliente! ' . $e->getMessage(), $caminhoView);
            }
        }

        $caminhoView .= '/ordem-servico-lista.php?view=all&tipoOs=all&status=all&periodo=30&method=getAllRecebidas';
        $this->redirectSucesso('insercaoOs', 'mensagemInsercaoOs', 'Sucesso ao atender a OS.', $caminhoView);
    }  
}