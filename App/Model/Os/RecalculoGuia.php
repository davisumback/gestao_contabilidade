<?php
namespace App\Model\Os;

use App\Helper\Helpers;
use App\DAO\EmpresaDAO;

class RecalculoGuia
{
    private $attributes;

    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        if (! \array_key_exists('guias', $this->attributes)) {
            throw new \Exception('Você precisa selecionar pelo menos um tipo de guia!', 1);
        }

        //verificar se a empresa existe
        $dao = new EmpresaDAO();
        $retorno = $dao->isEmpresa($this->attributes['empresasId']);

        if ($retorno == null) {
            throw new \Exception("Empresa não existente!", 1);
        }
        
        // $date = new \DateTime(Helpers::formataDataBd($this->attributes['guias_vencimento']));
        $dateVencimento = \DateTime::createFromFormat('Y-m-d', $this->attributes['guias_vencimento']);

        if ($dateVencimento == false) {
            throw new \Exception("Data de vencimento inválida!", 1);
        }
        
        // $date = new \DateTime(Helpers::formataDataBd($this->attributes['guias_competencia']));
        $dateCompetencia = \DateTime::createFromFormat('Y-m-d', $this->attributes['guias_competencia'] . '-01');

        if ($dateCompetencia == false) {
            throw new \Exception("Data de competência inválida!", 1);
        }

        $this->attributes['guias_vencimento'] = $dateVencimento->format('Y-m-d');
        $this->attributes['guias_competencia'] = $dateCompetencia->format('Y-m-d');
    }

    public function saveOsRecalculoGuia()
    {
        // echo '<pre>';
        // print_r($this->attributes);
        // echo '</pre>';
        // die();
        try {
            $guiasRh = [8, 9, 10];
            $guiasContador = [2, 3, 4, 5, 6, 7];
            $guiasFinanceiro = [1];

            $rh = array();
            $contador = array();
            $financeiro = array();
            
            foreach ($this->attributes['guias'] as $chave => $valor) {
                if (\in_array($chave, $guiasRh)) {
                    $rh[] = $chave;
                } elseif (\in_array($chave, $guiasContador)) {
                    $contador[] = $chave;
                } elseif(\in_array($chave, $guiasFinanceiro)) {
                    $financeiro[] = $chave;
                }
            }

            if (! empty($rh)) {
                $dao = new \App\DAO\TipoUsuarioDAO();
                $retorno = $dao->getUsuariosPorTipo(7);
                $usuarioRhId = $retorno[0]['id'];                
                $os = new OrdemDeServico();
                $os->saveOsRecalculoGuia(
                    $this->attributes['empresasId'], 
                    $this->attributes['usuariosId'], 
                    $usuarioRhId, $rh, 
                    $this->attributes['guias_vencimento'],
                    $this->attributes['guias_competencia']
                );
            }
            
            if (! empty($contador)) {
                $dao = new \App\DAO\ContadorEmpresaDAO();
                $retorno = $dao->getContadorEmpresa($this->attributes['empresasId']);
                $contadorId = $retorno['contadorId'];
                $os = new OrdemDeServico();
                $os->saveOsRecalculoGuia(
                    $this->attributes['empresasId'], 
                    $this->attributes['usuariosId'], 
                    $contadorId, 
                    $contador,
                    $this->attributes['guias_vencimento'],
                    $this->attributes['guias_competencia']
                );                
            }

            if (! empty($financeiro)) {
                $dao = new \App\DAO\TipoUsuarioDAO();
                $retorno = $dao->getUsuariosPorTipo(5);
                $usuarioFinanceiroId = $retorno[0]['id'];
                $os = new OrdemDeServico();
                $os->saveOsRecalculoGuia(
                    $this->attributes['empresasId'], 
                    $this->attributes['usuariosId'],
                    $usuarioFinanceiroId, 
                    $financeiro,
                    $this->attributes['guias_vencimento'],
                    $this->attributes['guias_competencia']
                );
            }
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage(), 1);            
        }
    }

    public function saveOsRecalculoGuiaMedcontabil()
    {
        // echo '<pre>';
        // print_r($this->attributes);
        // echo '</pre>';
        // die();
        try {
            $guiasRh = [8, 9, 10];
            $guiasContador = [2, 3, 4, 5, 6, 7];
            $guiasFinanceiro = [1];

            $rh = array();
            $contador = array();
            $financeiro = array();
            
            foreach ($this->attributes['guias'] as $chave => $valor) {
                if (\in_array($chave, $guiasRh)) {
                    $rh[] = $chave;
                } elseif (\in_array($chave, $guiasContador)) {
                    $contador[] = $chave;
                } elseif(\in_array($chave, $guiasFinanceiro)) {
                    $financeiro[] = $chave;
                }
            }

            if (! empty($rh)) {
                $dao = new \App\DAO\TipoUsuarioDAO();
                $retorno = $dao->getUsuariosPorTipo(7);
                $usuarioRhId = $retorno[0]['id'];                
                $os = new OrdemDeServico();
                $os->saveOsRecalculoGuia(
                    $this->attributes['empresasId'], 
                    $this->attributes['usuariosId'], 
                    $usuarioRhId, $rh, 
                    $this->attributes['guias_vencimento'],
                    $this->attributes['guias_competencia']
                );
            }
            
            if (! empty($contador)) {
                $dao = new \App\DAO\ContadorEmpresaDAO();
                $retorno = $dao->getContadorEmpresa($this->attributes['empresasId']);
                $contadorId = $retorno['contadorId'];
                $os = new OrdemDeServico();
                $os->saveOsRecalculoGuia(
                    $this->attributes['empresasId'], 
                    $this->attributes['usuariosId'], 
                    $contadorId, 
                    $contador,
                    $this->attributes['guias_vencimento'],
                    $this->attributes['guias_competencia']
                );                
            }

            if (! empty($financeiro)) {
                $dao = new \App\DAO\TipoUsuarioDAO();
                $retorno = $dao->getUsuariosPorTipo(5);
                $usuarioFinanceiroId = $retorno[0]['id'];
                $os = new OrdemDeServico();
                $os->saveOsRecalculoGuiaMedcontabil(
                    $this->attributes['empresasId'], 
                    $this->attributes['usuariosId'],
                    $usuarioFinanceiroId, 
                    $financeiro,
                    $this->attributes['guias_vencimento'],
                    $this->attributes['guias_competencia']
                );
            }
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage(), 1);            
        }
    }

    public function atendeRecalculoGuia($attributes, $files)
    {
        if (count($files['guias']['name']) !== count(array_unique($files['guias']['name']))) {
            throw new \Exception("Erro! Existem dois arquivos iguais.", 1);            
        }

        foreach ($attributes['guiasDatas'] as $guias) {
            if (\DateTime::createFromFormat('d/m/Y', $guias['vencimento']) == false ) {
                throw new \Exception("Data de vencimento inválida.", 1);
            }

            if (\DateTime::createFromFormat('m/Y', $guias['competencia']) == false ) {
                throw new \Exception("Data de competência inválida.", 1);
            }
        }

        $empresasId = $attributes['empresasId'];
        $pastaImpostos = '../../../grupobfiles/empresas/' . $empresasId . '/impostos';

        // Foreach de verificações de pastas e arquivos
        foreach ($attributes['guiasDatas'] as $guiaId => $guia) {
            $guia['competencia'] = str_replace('/', '-', $guia['competencia']);
            $pasta = $pastaImpostos . '/' . $guia['competencia'];

            if (! is_dir($pasta)) {
                $criaPasta = new \App\Arquivo\CriaPasta();
                $criaPasta->criaPasta($pasta);
            }

            if (file_exists($pasta .'/'. $files['guias']['name'][$guiaId])) {
                throw new \Exception("Erro! Já existe um arquivo com o nome: ". $files['guias']['name'][$guiaId], 1);
            }
        }

        $uploadArquivo = new \App\Arquivo\UploadArquivo();
        $guiaRecalculoDao = new \App\DAO\GuiaRecalculoDAO();

        $guiasArquivos = array();

        foreach ($attributes['guiasDatas'] as $guiaId => $guia) {
            $guia['competencia'] = str_replace('/', '-', $guia['competencia']);
            $pasta = $pastaImpostos . '/' . $guia['competencia'];
            $retornoUpload = $uploadArquivo->uploadArchive($files['guias']['tmp_name'][$guiaId], $files['guias']['name'][$guiaId], $pasta);

            $guiasArquivos[] = $pasta . '/' . $files['guias']['name'][$guiaId];

            $guiaTipo = ($guia['guiaTipo'] == 'HONORÁRIOS') ? 'HONORARIOS' : $guia['guiaTipo'];

            $retornoInsercao = $guiaRecalculoDao->insereRecalculoGuia(
                $empresasId,
                $guiaTipo, 
                Helpers::formataDataBd($guia['vencimento']),
                Helpers::formataDataBd('01/' . $guia['competencia']),
                $attributes['usuariosId'],
                $files['guias']['name'][$guiaId],
                $attributes['ordemDeServicoId']
            );
        }

        $ordemDeServico = new OrdemDeServico();
        $ordemDeServico->updateOs('FINALIZADA', $attributes['ordemDeServicoId']);

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

            try {
                $attributes['usuariosId'] = $empresaEmail[0]['gestorId']; // para passar o Id do gestor para o email, e não o do contador.
                $certidaoEmail = new \App\Model\Email\Os\RecalculoGuiaEmail($attributes);
                $certidaoEmail->enviaEmail($empresaEmail[0]['email'], $empresaNome, $emailsCopia, $guiasArquivos);
            } catch (\Exception $e) {
                throw new \Exception('OS atendida, porém não foi enviado e-mail ao cliente! ' . $e->getMessage(), 1);
            }
        }
    }
}