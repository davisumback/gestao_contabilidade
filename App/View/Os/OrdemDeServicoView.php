<?php
namespace App\View\Os;

use App\Model\Os\TipoOrdemDeServico;

class OrdemDeServicoView
{
    public function show($ordemDeServicos, $tiposOs, $request, TipoOrdemDeServico $tipoOs)
    {
        $view = file_get_contents('../views/os/index.php');
        
        $saida = '';
        $saidaTipoOs = '';

        foreach ($ordemDeServicos as $os) {
            $saida .=   
                '<div class="col-md-4 col-sm-12 text-center">
                    <div class="card texto-padrao bg-light mb-3 border-'.$this->decideCor($os['status']).' rounded">
                        <div class="row">
                            <div class="col-1 pr-0">
                                <div class="bg-'.$this->decideCor($os['status']).'">
                                    <div class="card-header px-0"><b>&nbsp</b></div>
                                </div>
                            </div>
                            <div class="col-11 pl-0">
                                <div class="card-header border-'.$this->decideCor($os['status']).' bg-'.$this->decideCor($os['status']).'-hover"><b>Solicitação ' .$os['status']. '</b></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Situação: Pendente</h5>
                            <h6 class="card-title mt-4">Data Criação: 09/01/2019 11:27</h6>
                            <h6 class="card-title">Previsão Conclusão: 10/01/2019 12:00</h6>
                        </div>
                    </div>
                </div>';
        }
        
        if (! array_key_exists('tipoOs', $request) || $request['tipoOs'] == 'all') {
            $view = str_replace('{{tituloOs}}', 'Todas Ordens de Serviços.', $view);
            $view = str_replace('{{filtros}}', '', $view);
            $view = str_replace('{{botaoNovaOs}}', '', $view);

            foreach ($tiposOs as $tipo) {
                $saidaTipoOs .= '<option value="'.$tipo['id'].'">'.$tipo['titulo'].'</option>';
            }

            $view = str_replace('{{tiposOs}}', $saidaTipoOs, $view);
        } else {
            $titulo = $tipoOs->getTipoTitulo($request['tipoOs']);
            $tipoOs = $request['tipoOs'];
            $botao = 
                '<button type="button" class="btn btn-padrao btn-success mb-3" data-toggle="modal" data-target="#osTipo'.$tipoOs.'">
                    Nova OS
                </button>';

            $view = str_replace('{{tituloOs}}',  $titulo, $view);
            $view = str_replace('{{botaoNovaOs}}', $botao, $view);
        }

        $view = str_replace('{{todasOs}}', $saida, $view);
        $view = str_replace('{{filtros}}', 'hidden=true', $view);

        echo $view;
    }

    public function decideCor($status)
    {
        $cor = '';

        switch ($status) {
            case 'PENDENTE': 
                $cor = 'warning';
            break;

            case 'FINALIZADA': 
                $cor = 'success';
            break;
        }

        return $cor;
    }
}

