<?php

/*********************************************************************
1 - Fazer primeiro mês sempre ser anexo5, tanto na view quanto nos cálculos
2 - Falta calcular os últimos 12 meses sempre. e não todos os meses como está atualmente
*********************************************************************/

use App\DAO\SimuladorDAO;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Simulador | Resultado =)");
require_once('menu-left.php');
require_once('../cabecalho.php');

$simulador_dao = new SimuladorDAO();

$id_simulacao = $_SESSION['id_simulacao'];

$resultado = $simulador_dao->getSimulacao($id_simulacao);

$rbt12 = array();
$rbt12[0] = 0; // VERIFICAR SE NÃO TEM QUE RETIRAR ISSO AQUI;

$mes_atual = 1;

$total_meses = 12;

$total_fat_real = 0;
$total_prolabore = 0;
$fat_primeiro_mes = 0;

$total_tributos = 0;
$total_inss = 0 ;
$total_irrf = 0;

for ($i = 0; $i < sizeof($resultado); $i++) {
    $total_prolabore += $resultado[$i]['prolabore'];

    if($i == 0){ // PRIMEIRO MÊS
        $fat_primeiro_mes = $resultado[$i]['faturamento'];
        $resultado_rtb = calculaRbt12($fat_primeiro_mes, $mes_atual);
        $rbt12[$mes_atual] =  $resultado_rtb;
        $total_fat_real += $fat_primeiro_mes;
    }else {
        if($i < $total_meses){
            $total_fat_real += $resultado[$i]['faturamento'];
            $resultado_rtb = calculaRbt12($total_fat_real, $mes_atual);
            $rbt12[$mes_atual] =  $resultado_rtb;
        }else {
            $proporcional = $i - $total_meses;
            $total_fat_real = ($total_fat_real + $resultado[$i]['faturamento']) - $resultado[$proporcional]['faturamento'];
            $resultado_rtb = calculaRbt12($total_fat_real, 12);
            $rbt12[$i] =  $resultado_rtb; // verificar se deve passar o $i ou o $mes_atual
        }
    }

    $mes_atual ++;
}
?>

<?php if(array_key_exists('erro', $_COOKIE)){ ?>
    <div class="text-center alert alert-success alert-dismissible fade show alert-login mt-2" role="alert">
        <strong><?=$_COOKIE['erro'];?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<div class="row">
    <div class="col-md-4">
        <aside class="profile-nav alt">
            <section class="card">
                <div class="card-header user-header alt simulador-card-header">
                    <div class="media">
                        <div class="media-body text-center">
                            <h3 class="display-6 pt-3 pb-3">Total</h3>
                        </div>
                    </div>
                </div>

                <ul class="list-group list-group-flush text-secondary">
                    <li class="list-group-item card-item">
                        <h6 class="text-left d-inline-block float-left">Meses Apurados</h6> <span class="badge badge-meses float-right badge-valor"><?=count($resultado)?> <?=(count($resultado) > 1) ? 'meses' : 'mês'?></span>
                    </li>
                    <li class="list-group-item card-item">
                        <h6 class="text-left d-inline-block float-left">Faturamento</h6> <span class="badge badge-faturamento float-right badge-valor">R$ <?=Helpers::formataMoedaView($total_fat_real)?></span>
                    </li>
                    <li class="list-group-item card-item">
                        <h6 class="text-left d-inline-block float-left">RBT12</h6> <span class="badge badge-rtb float-right badge-valor">R$ <?=Helpers::formataMoedaView($rbt12[count($rbt12)-1])?></span>
                    </li>
                    <li class="list-group-item card-item">
                        <h6 class="text-left d-inline-block float-left">Prolabore</h6> <span class="badge badge-secondary float-right badge-prolabore badge-valor">R$ <?=Helpers::formataMoedaView($total_prolabore)?></span>
                    </li>
                    <li class="list-group-item card-item">
                        <h6 class="text-left d-inline-block float-left">CPP</h6> <span class="badge badge-secondary float-right badge-cpp badge-valor" id='total-cpp'></span>
                    </li>
                </ul>

            </section>
        </aside>
    </div>

    <div class="col-md-4">
        <aside class="profile-nav alt">
            <section class="card">
                <div class="card-header user-header alt simulador-card-header">
                    <div class="media">
                        <div class="media-body text-center">
                            <h3 class="display-6 pt-3 pb-3">Total</h3>
                        </div>
                    </div>
                </div>

                <ul class="list-group list-group-flush text-secondary">
                    <li class="list-group-item card-item">
                        <h6 class="text-left d-inline-block float-left">Tributo</h6> <span class="badge badge-primary float-right badge-valor" id='total-tributos'></span>
                    </li>
                    <li class="list-group-item card-item">
                        <h6 class="text-left d-inline-block float-left">INSS</h6> <span class="badge badge-primary float-right badge-valor" id='total-inss'></span>
                    </li>
                    <li class="list-group-item card-item">
                        <h6 class="text-left d-inline-block float-left">IRRF</h6> <span class="badge badge-primary float-right badge-valor" id='total-irrf'></span>
                    </li>
                    <li class="list-group-item card-item">
                        <h6 class="text-left d-inline-block float-left">Total</h6> <span class="badge badge-primary float-right badge-valor" id='total-all'></span>
                    </li>
                </ul>

            </section>
        </aside>
    </div>

    <div class="col-md-4 text-center">
        <div class="col-6 text-right">
            <form class="needs-validation-loading" action="form-altera-simulador.php" method="post">
                <button type="submit" class="btn btn-info btn-padrao">Alterar</button>
            </form>
        </div>
        <div class="col-6 text-left">
            <button type="button" class="btn btn-success btn-padrao" data-toggle="modal" data-target="#salvar-empresa">Salvar</button>
        </div>
    </div>
</div>

<?php
    $mes_atual = 1;
    $total_prolabore_atual = 0;
    $total_faturamento_atual = 0;
    $cpp_array = array();

    for ($i = 0; $i < sizeof($resultado); $i++) {
        $total_faturamento_atual += $resultado[$i]['faturamento'];
        $total_prolabore_atual += $resultado[$i]['prolabore'];

        if($mes_atual == 1){
            $retorno_anexo = decideAnexo($total_prolabore_atual, $total_faturamento_atual, $total_faturamento_atual, $rbt12[$i]);
            $total_prolabore_atual += $retorno_anexo[2];
        }else{
            if($i < $total_meses){
                $retorno_anexo = decideAnexo($total_prolabore_atual - $resultado[$i]['prolabore'], $total_faturamento_atual - $resultado[$i]['faturamento'], $resultado[$i]['faturamento'], $rbt12[$i]);
                $total_prolabore_atual += $retorno_anexo[2];
            }else {
                $proporcional = $i - $total_meses;
                $prolabore_a_calcular = ($total_prolabore_atual - $resultado[$i]['prolabore']) - $resultado[$proporcional]['prolabore'];
                $faturamento_a_calcular = ($total_faturamento_atual - $resultado[$i]['faturamento'] - $resultado[$proporcional]['faturamento']);

                $retorno_anexo = decideAnexo($prolabore_a_calcular, $faturamento_a_calcular, $resultado[$i]['faturamento'], $rbt12[$i]);
                $total_prolabore_atual += $retorno_anexo[2];
            }

        }

        if($resultado[$i]['prolabore'] != 0){
            array_push($cpp_array, $retorno_anexo[2]);
        }
        ?>

        <div class="col-md-4">
            <div class="feed-box">
                <section class="card">
                    <div class="card-body">
                        <div class="corner-ribon <?=$retorno_anexo[3]?>">
                            <h6 class="text-right mr-2 mt-2"><strong><?=$retorno_anexo[4]?></strong></h6>
                        </div>
                        <h6 class="text-center text-secondary"><strong><?=$resultado[$i]['mes'].'-'.$resultado[$i]['ano']?></strong></h6>
                        <hr>

                        <div class="row">
                            <div class="col-6">
                                <h6 class="mt-1 text-secondary">
                                    Faturamento Mês
                                </h6>
                            </div>
                            <div class="col-6 text-right">
                                <h6 class="badge badge-success badge-valor-m badge-faturamento">R$ <?=Helpers::formataMoedaView($resultado[$i]['faturamento'])?></h6>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <h6 class="mt-1 text-secondary">
                                    Fat. Acumulado
                                </h6>
                            </div>
                            <div class="col-6 text-right">
                                <h6 class="badge badge-valor-m badge-faturamento-real">R$ <?=Helpers::formataMoedaView($total_faturamento_atual)?></h6>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <h6 class="mt-1 text-secondary">
                                    RBT12
                                </h6>
                            </div>

                            <div class="col-6 text-right">
                                <h6 class="badge badge-rtb badge-valor-m">
                                    R$ <?=Helpers::formataMoedaView($rbt12[$i])?>
                                </h6>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <h6 class="mt-1 text-secondary">
                                    Tributo
                                </h6>
                            </div>

                            <div class="col-6 text-right">
                                <h6 class="badge badge-secondary badge-cpp badge-valor-m">
                                    R$
                                    <?php
                                        $total_tributos += $retorno_anexo[1];
                                        echo Helpers::formataMoedaView($retorno_anexo[1]);
                                    ?>
                                </h6>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <h6 class="mt-1 text-secondary">
                                    Prolabore
                                </h6>
                            </div>

                            <div class="col-6 text-right">
                                <h6 class="badge badge-secondary badge-prolabore badge-valor-m">
                                    R$ <?=Helpers::formataMoedaView($resultado[$i]['prolabore'])?>
                                </h6>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <h6 class="mt-1 text-secondary">
                                    INSS
                                </h6>
                            </div>

                            <div class="col-6 text-right">
                                <h6 class="badge badge-secondary badge-cpp badge-valor-m">
                                    R$
                                    <?php
                                        $inss = calculaInss($resultado[$i]['prolabore']);
                                        $total_inss += $inss;
                                        echo Helpers::formataMoedaView($inss);
                                    ?>
                                </h6>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <h6 class="mt-1 text-secondary">
                                    IRRF
                                </h6>
                            </div>

                            <div class="col-6 text-right">
                                <h6 class="badge badge-secondary badge-cpp badge-valor-m">
                                    R$
                                    <?php
                                        $prolabore_liquido = $resultado[$i]['prolabore'] - $inss;
                                        $irrf = calculaIrrf($prolabore_liquido);
                                        $total_irrf += $irrf;
                                        echo Helpers::formataMoedaView($irrf);
                                    ?>
                                </h6>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <h6 class="mt-1 text-secondary">
                                    CPP
                                </h6>
                            </div>

                            <div class="col-6 text-right">
                                <h6 class="badge badge-secondary badge-cpp badge-valor-m">
                                    R$ <?=Helpers::formataMoedaView($retorno_anexo[2])?>
                                </h6>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <h6 class="mt-1 text-secondary">
                                    Prolabore + CPP
                                </h6>
                            </div>

                            <div class="col-6 text-right">
                                <h6 class="badge badge-secondary badge-prolabore badge-valor-m">
                                    R$ <?=($resultado[$i]['prolabore']==0)? '0' : Helpers::formataMoedaView($resultado[$i]['prolabore'] + $retorno_anexo[2])?>
                                </h6>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <h6 class="mt-1 text-secondary">
                                    Aliquota
                                </h6>
                            </div>

                            <div class="col-6 text-right">
                                <h6 class="badge badge-secondary badge-cpp badge-valor-m">
                                    <?=floatval($retorno_anexo[0]*100)?> %
                                </h6>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <h6 class="mt-1 text-secondary">
                                    Total Tributos
                                </h6>
                            </div>

                            <div class="col-6 text-right">
                                <h6 class="badge badge-secondary badge-cpp badge-valor-m">
                                    R$
                                    <?php
                                        $total_tributos_mensal = $inss + $irrf + $retorno_anexo[1];
                                        echo Helpers::formataMoedaView($total_tributos_mensal);
                                    ?>
                                </h6>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <?php

        $mes_atual++;
    }
?>

<?php if(count($resultado) < 12) : ?>
    <div class="col-md-4">
        <div class="feed-box">
            <section class="card card-projetado">
                <div class="card-body">
                    <div class="corner-ribon">
                        <h6 class="text-right mr-3 mt-1 text-light"></h6>
                    </div>
                    <h6 class="text-center text-secondary"><strong>Próximo Mês</strong></h6>
                    <hr>

                    <div class="row mt-2">
                        <div class="col-6">
                            <h6 class="mt-1 text-secondary">
                                RBT12
                            </h6>
                        </div>

                        <div class="col-6 text-right">
                            <h6 class="badge badge-rtb badge-valor-m">
                                <?=Helpers::formataMoedaView($rbt12[count($rbt12)-1])?>
                            </h6>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
<?php endif ?>

<!-- Modal -->
<div class="modal fade" id="salvar-empresa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title label-cadastro" id="exampleModalLabel">Salvar simulação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="needs-validation-loading" action="../controllers/simulador/salva-simulacao.php" method="post" autocomplete="off">
                <div class="modal-body text-center">
                    <input name="id_simulacao" value="<?=$id_simulacao?>" hidden>

                    <label for="empresa_numero" class="text-center label-cadastro">Número da Empresa</label>
                    <input id="empresa_numero" class="form-control col-2 mx-auto" type="text" name="empresa_numero" maxlength="3" required>
                    <div class="invalid-feedback">
                        Obrigatório*
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-padrao">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    function calculaRbt12($valor, $meses){
        return ($valor / $meses) * 12;
    }

    function calculaCpp($tributo_mes, $aliquota_cpp){
        return $tributo_mes * $aliquota_cpp;
    }

    function calculaInss($prolabore){
        if($prolabore < 5645.80){
            return $prolabore * 0.11;
        }else {
            return 621.04;
        }
    }

    function calculaIrrf($prolabore){
        if($prolabore <= 1903.98){
            return 0;
        }else if($prolabore > 1903.98 && $prolabore <=  2826.65){
            return $prolabore * 0.075 - 142.80;
        }else if($prolabore > 2826.65 && $prolabore <=  3751.05){
            return $prolabore * 0.15 - 354.80;
        }else if($prolabore > 3751.05 && $prolabore <= 4664.68){
            return $prolabore * 0.225 - 636.13;
        }else if($prolabore > 4664.68){
            return $prolabore * 0.275 - 869.36;
        }
    }

    function decideAnexo($folha_meses_anteriores, $fat_acumulado_meses_anteriores, $fat_mensal, $rbt12){
        if($fat_acumulado_meses_anteriores == 0 ){
            $percentual = $folha_meses_anteriores / 1;
        }else{
            $percentual = $folha_meses_anteriores / $fat_acumulado_meses_anteriores;
        }

        if($percentual > 0.28){ // Anexo 3
            $resultado = calculaSnAnexo3($fat_mensal, $rbt12);
        }else{ // Anexo 5
            $resultado = calculaSnAnexo5($fat_mensal, $rbt12);
        }

        return $resultado;
    }

    function calculaSnAnexo5($fat_mensal, $rbt12){ // TEM QUE SER O RBT12
        if($rbt12 <= 180000){
            $aliquota_cpp = 0.2885;
            $resultado[0] = 0.155;
            $resultado[1] = $fat_mensal * 0.155;
            $resultado[2] = calculaCpp($resultado[1], $aliquota_cpp); // CPP
            $resultado[3] = 'anexo5';
            $resultado[4] = '1ª';
            return $resultado;

        }elseif($rbt12 > 180000 && $rbt12 <= 360000){
            $aliquota_cpp = 0.2785;
            $aliquota =  ($rbt12 * 0.18 - 4500) / $rbt12;
            $resultado[0] = $aliquota;
            $resultado[1] = $fat_mensal * $aliquota;
            $resultado[2] = calculaCpp($resultado[1], $aliquota_cpp); // CPP
            $resultado[3] = 'anexo5';
            $resultado[4] = '2ª';
            return $resultado;

        }elseif($rbt12 > 360000 && $rbt12 <= 720000){
            $aliquota_cpp = 0.2385;
            $aliquota =  ($rbt12 * 0.195 - 9900) / $rbt12;
            $resultado[0] = $aliquota;
            $resultado[1] = $fat_mensal * $aliquota;
            $resultado[2] = calculaCpp($resultado[1], $aliquota_cpp); // CPP
            $resultado[3] = 'anexo5';
            $resultado[4] = '3ª';
            return $resultado;

        }elseif($rbt12 > 720000 && $rbt12 <= 1800000){
            $aliquota_cpp = 0.2385;
            $aliquota =  ($rbt12 * 0.205 - 17100) / $rbt12;
            $resultado[0] = $aliquota;
            $resultado[1] = $fat_mensal * $aliquota;
            $resultado[2] = calculaCpp($resultado[1], $aliquota_cpp); // CPP
            $resultado[3] = 'anexo5';
            $resultado[4] = '4ª';
            return $resultado;

        }
        elseif($rbt12 > 1800000 && $rbt12 <= 3600000){
            $aliquota_cpp = 0.2385;
            $aliquota =  ($rbt12 * 0.23 - 62100) / $rbt12;
            $resultado[0] = $aliquota;
            $resultado[1] = $fat_mensal * $aliquota;
            $resultado[2] = calculaCpp($resultado[1], $aliquota_cpp); // CPP
            $resultado[3] = 'anexo5';
            $resultado[4] = '4ª';
            return $resultado;

        }
        elseif($rbt12 > 3600000 && $rbt12 <= 4800000){
            $aliquota_cpp = 0.2950;
            $aliquota =  ($rbt12 * 0.305 - 540000) / $rbt12;
            $resultado[0] = $aliquota;
            $resultado[1] = $fat_mensal * $aliquota;
            $resultado[2] = calculaCpp($resultado[1], $aliquota_cpp); // CPP
            $resultado[3] = 'anexo5';
            $resultado[4] = '6ª';
            return $resultado;
        }
    }

    function calculaSnAnexo3($fat_mensal, $rbt12){ // TEM QUE SER O RBT12
        if($rbt12 <= 180000){
            $aliquota_cpp = 0.434;
            $resultado[0] = 0.06;
            $resultado[1] = $fat_mensal * 0.06;
            $resultado[2] = calculaCpp($resultado[1], $aliquota_cpp);
            $resultado[3] = 'anexo3';
            $resultado[4] = '1ª';
            return $resultado;

        }elseif($rbt12 > 180000 && $rbt12 <= 360000){
            $aliquota_cpp = 0.434;
            $aliquota =  ($rbt12 * 0.1120 - 9360) / $rbt12;
            $resultado[0] = $aliquota;
            $resultado[1] = $fat_mensal * $aliquota;
            $resultado[2] = calculaCpp($resultado[1], $aliquota_cpp);
            $resultado[3] = 'anexo3';
            $resultado[4] = '2ª';
            return $resultado;

        }elseif($rbt12 > 360000 && $rbt12 <= 720000){
            $aliquota_cpp = 0.434;
            $aliquota =  ($rbt12 * 0.1350 - 17640) / $rbt12;
            $resultado[0] = $aliquota;
            $resultado[1] = $fat_mensal * $aliquota;
            $resultado[2] = calculaCpp($resultado[1], $aliquota_cpp);
            $resultado[3] = 'anexo3';
            $resultado[4] = '3ª';
            return $resultado;

        }elseif($rbt12 > 720000 && $rbt12 <= 1800000){
            $aliquota_cpp = 0.434;
            $aliquota =  ($rbt12 * 0.16 - 35640) / $rbt12;
            $resultado[0] = $aliquota;
            $resultado[1] = $fat_mensal * $aliquota;
            $resultado[2] = calculaCpp($resultado[1], $aliquota_cpp);
            $resultado[3] = 'anexo3';
            $resultado[4] = '4ª';
            return $resultado;

        }
        elseif($rbt12 > 1800000 && $rbt12 <= 3600000){
            $aliquota_cpp = 0.434;
            $aliquota =  ($rbt12 * 0.21 - 125640) / $rbt12;
            $resultado[0] = $aliquota;
            $resultado[1] = $fat_mensal * $aliquota;
            $resultado[2] = calculaCpp($resultado[1], $aliquota_cpp);
            $resultado[3] = 'anexo3';
            $resultado[4] = '5ª';
            return $resultado;
        }
        elseif($rbt12 > 3600000 && $rbt12 <= 4800000){
            $aliquota_cpp = 0.305;
            $aliquota =  ($rbt12 * 0.33 - 648000) / $rbt12;
            $resultado[0] = $aliquota;
            $resultado[1] = $fat_mensal * $aliquota;
            $resultado[2] = calculaCpp($resultado[1], $aliquota_cpp);
            $resultado[3] = 'anexo3';
            $resultado[4] = '6ª';
            return $resultado;
        }
    }
?>

<script type="text/javascript">
    var spanTotalCpp = document.getElementById('total-cpp');
    var totalCpp = 0;
    var spanTotalTributos = document.getElementById('total-tributos');

    totalCpp = <?=array_sum($cpp_array)?>

    spanTotalCpp.innerHTML = 'R$ ' + numeroParaMoeda(totalCpp, 2, ',', '.');

    spanTotalTributos.innerHTML = 'R$ ' + numeroParaMoeda(<?=$total_tributos?>, 2, ',', '.');

    var spanTotalInss = document.getElementById("total-inss");
    spanTotalInss.innerHTML = 'R$ ' + numeroParaMoeda(<?=$total_inss?>, 2, ',', '.');

    var spanTotalIrrf = document.getElementById("total-irrf");
    spanTotalIrrf.innerHTML = 'R$ ' + numeroParaMoeda(<?=$total_irrf?>, 2, ',', '.');

    var spanTotalAll = document.getElementById("total-all");
    spanTotalAll.innerHTML = 'R$ ' + numeroParaMoeda(<?=$total_inss+$total_irrf+$total_tributos?>, 2, ',', '.');

    function numeroParaMoeda(n, c, d, t){
        c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    }
</script>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>
