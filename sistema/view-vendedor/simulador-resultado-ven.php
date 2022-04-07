<?php

use App\DAO\SimuladorDAO;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao("Simulador | Resultado venda =)");
require_once('menu-left.php');
require_once('../cabecalho.php');
?>

<?php
$anexo3_sem_antecipacao = json_decode($_COOKIE['anexo3_sem_antecipacao'], true);
$inss_sem_antecipacao = json_decode($_COOKIE['inss_sem_antecipacao'], true);
$irrf_sem_antecipacao = json_decode($_COOKIE['irrf_sem_antecipacao'], true);

$faturamento_array = json_decode($_COOKIE['faturamento_array'], true);
$anexo3_array = json_decode($_COOKIE['anexo3'], true);
$anexo5_array = json_decode($_COOKIE['anexo5'], true);
$presumido_array = json_decode($_COOKIE['presumido'], true);
$inss_anexo3 = json_decode($_COOKIE['inss_anexo3'], true);
$irrf_anexo3 = json_decode($_COOKIE['irrf_anexo3'], true);

$total_tributacao_anexo3 = 0;
$total_geral_anexo3 = 0;
$total_irrf_anexo3 = 0;
$total_inss_anexo3 = 0;

$total_tributacao_anexo5 = 0;
$total_geral_anexo5 = 0;

$total_tributacao_presumido = 0;
$total_geral_presumido = 0;
?>

<div class="col-md-12">
    <div class="feed-box">
        <section class="card">
            <div class="card-body">
                <h6 class="text-center text-secondary"><strong>Comparativo</strong></h6>
                <hr>

                <div class="row">
                    <div class="col-2">
                        <h6 class="mt-1 text-secondary">

                        </h6>
                    </div>
                    <div class="col-2">
                        <h6 class="mt-1 text-secondary">
                            Anexo3 Antecipado
                        </h6>
                    </div>
                    <div class="col-2">
                        <h6 class="mt-1 text-secondary">
                            Anexo3
                        </h6>
                    </div>
                    <div class="col-3">
                        <h6 class="mt-1 text-secondary">
                            Anexo5
                        </h6>
                    </div>
                    <div class="col-3">
                        <h6 class="mt-1 text-secondary">
                            Presumido
                        </h6>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-2">
                        <h6 class="mt-1 text-secondary">
                            Total Tributacão
                        </h6>
                    </div>

                    <div class="col-2">
                        <h6 class="badge badge-comparativo badge-anexo3" id="t-tributacao-anexo3"></h6>
                    </div>

                    <div class="col-2">
                        <h6 class="badge badge-comparativo badge-anexo3"><?=Helpers::formataMoedaView(array_sum($anexo3_sem_antecipacao))?></h6>
                    </div>

                    <div class="col-3">
                        <h6 class="badge badge-comparativo badge-anexo5" id="t-tributacao-anexo5"></h6>
                    </div>

                    <div class="col-3">
                        <h6 class="badge badge-comparativo badge-presumido" id="t-tributacao-presumido"></h6>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-2">
                        <h6 class="mt-1 text-secondary">
                            Total IRRF
                        </h6>
                    </div>

                    <div class="col-2">
                        <h6 class="badge badge-comparativo badge-anexo3" id="t-irrf-anexo3"></h6>
                    </div>

                    <div class="col-2">
                        <h6 class="badge badge-comparativo badge-anexo3"><?=Helpers::formataMoedaView(array_sum($irrf_sem_antecipacao))?></h6>
                    </div>

                    <div class="col-3">
                        <h6 class="badge badge-comparativo badge-anexo5">R$ 0</h6>
                    </div>

                    <div class="col-3">
                        <h6 class="badge badge-comparativo badge-presumido">R$ 0</h6>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-2">
                        <h6 class="mt-1 text-secondary">
                            Total INSS
                        </h6>
                    </div>

                    <div class="col-2">
                        <h6 class="badge badge badge-comparativo badge-anexo3" id="t-inss-anexo3"></h6>
                    </div>

                    <div class="col-2">
                        <h6 class="badge badge badge-comparativo badge-anexo3"><?=Helpers::formataMoedaView(array_sum($inss_sem_antecipacao))?></h6>
                    </div>

                    <div class="col-3">
                        <h6 class="badge badge-comparativo badge-anexo5">
                            R$
                            <?php
                                $valor_fixo = 104.94;
                                echo Helpers::formataMoedaView($valor_fixo * 12);
                            ?>
                        </h6>
                    </div>

                    <div class="col-3">
                        <h6 class="badge badge-comparativo badge-presumido">
                            R$
                            <?php
                                $valor_fixo = 295.74;
                                echo Helpers::formataMoedaView($valor_fixo * 12);
                            ?>
                        </h6>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-2">
                        <h6 class="mt-1 text-secondary">
                            Total Geral
                        </h6>
                    </div>

                    <div class="col-2">
                        <h6 class="badge badge badge-comparativo badge-anexo3" id="t-geral-anexo3"></h6>
                    </div>

                    <div class="col-2">
                        <h6 class="badge badge badge-comparativo badge-anexo3">
                            <?php
                                $total_geral_sem_antecipacao = array_sum($inss_sem_antecipacao) + array_sum($irrf_sem_antecipacao) + array_sum($anexo3_sem_antecipacao);
                                echo Helpers::formataMoedaView($total_geral_sem_antecipacao);
                            ?>
                        </h6>
                    </div>

                    <div class="col-3">
                        <h6 class="badge badge badge-comparativo badge-anexo5" id="t-geral-anexo5"></h6>
                    </div>

                    <div class="col-3">
                        <h6 class="badge badge-comparativo badge-presumido" id="t-geral-presumido"></h6>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<?php for($i = 0; $i < sizeof($faturamento_array); $i++) : ?>

    <?php
        $total_tributos_anexo3 = 0;
        $total_tributos_anexo5 = 0;
        $total_tributos_presumido = 0;
    ?>

    <div class="col-md-6">
        <div class="feed-box">
            <section class="card">
                <div class="card-body">
                    <h6 class="text-center text-secondary"><strong>Mês <?=$i+1?></strong></h6>
                    <hr>

                    <div class="row">
                        <div class="col-3">
                            <h6 class="mt-1 text-secondary">

                            </h6>
                        </div>
                        <div class="col-3">
                            <h6 class="mt-1 text-secondary">
                                Anexo3
                            </h6>
                        </div>
                        <div class="col-3">
                            <h6 class="mt-1 text-secondary">
                                Anexo5
                            </h6>
                        </div>
                        <div class="col-3">
                            <h6 class="mt-1 text-secondary">
                                Presumido
                            </h6>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <h6 class="mt-1 text-secondary">
                                Tributo
                            </h6>
                        </div>

                        <div class="col-3">
                            <h6 class="badge badge-valor-m badge-anexo3">
                                R$
                                <?php
                                    $total_tributos_anexo3 += $anexo3_array[$i];
                                    $total_tributacao_anexo3 += $anexo3_array[$i];
                                    echo Helpers::formataMoedaView($anexo3_array[$i]);
                                ?>
                            </h6>
                        </div>

                        <div class="col-3">
                            <h6 class="badge badge-valor-m badge-anexo5">
                                R$
                                <?php
                                    $total_tributos_anexo5 += $anexo5_array[$i];
                                    $total_tributacao_anexo5 += $anexo5_array[$i];
                                    echo Helpers::formataMoedaView($anexo5_array[$i]);
                                ?>
                            </h6>
                        </div>

                        <div class="col-3">
                            <h6 class="badge badge-valor-m badge-presumido">
                                R$
                                <?php
                                    $total_tributos_presumido += $presumido_array[$i];
                                    $total_tributacao_presumido += $presumido_array[$i];
                                    echo Helpers::formataMoedaView($presumido_array[$i]);
                                ?>
                            </h6>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <h6 class="mt-1 text-secondary">
                                IRRF
                            </h6>
                        </div>

                        <div class="col-3">
                            <h6 class="badge badge-valor-m badge-anexo3">
                                R$
                                <?php
                                    $total_tributos_anexo3 += $irrf_anexo3[$i];
                                    $total_irrf_anexo3 += $irrf_anexo3[$i];
                                    echo Helpers::formataMoedaView($irrf_anexo3[$i]);
                                ?>
                            </h6>
                        </div>

                        <div class="col-3">
                            <h6 class="badge badge-valor-m badge-anexo5">R$ 0</h6>
                        </div>

                        <div class="col-3">
                            <h6 class="badge badge-valor-m badge-presumido">R$ 0</h6>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <h6 class="mt-1 text-secondary">
                                INSS
                            </h6>
                        </div>

                        <div class="col-3">
                            <h6 class="badge badge-valor-m badge-anexo3">
                                R$
                                <?php
                                    $total_tributos_anexo3 += $inss_anexo3[$i];
                                    $total_inss_anexo3 += $inss_anexo3[$i];
                                    echo Helpers::formataMoedaView($inss_anexo3[$i]);
                                ?>
                            </h6>
                        </div>

                        <div class="col-3">
                            <h6 class="badge badge-valor-m badge-anexo5">
                                R$
                                <?php
                                    if($faturamento_array[$i] == 0){
                                        echo '0';
                                    }else {
                                        $total_tributos_anexo5 += 104.94;
                                        echo '104,94';
                                    }

                                ?>
                            </h6>
                        </div>

                        <div class="col-3">
                            <h6 class="badge badge-valor-m badge-presumido">
                                R$
                                <?php
                                    if($faturamento_array[$i] == 0){
                                        echo '0';
                                    }else {
                                        $total_tributos_presumido += 295.74;
                                        echo '295,74';
                                    }
                                ?>
                            </h6>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <h6 class="mt-1 text-secondary">
                                Total
                            </h6>
                        </div>

                        <div class="col-3">
                            <h6 class="badge badge-valor-m badge-anexo3">R$ <?=Helpers::formataMoedaView($total_tributos_anexo3)?></h6>
                        </div>

                        <div class="col-3">
                            <h6 class="badge badge-valor-m badge-anexo5">R$ <?=Helpers::formataMoedaView($total_tributos_anexo5)?></h6>
                        </div>

                        <div class="col-3">
                            <h6 class="badge badge-valor-m badge-presumido">R$ <?=Helpers::formataMoedaView($total_tributos_presumido)?></h6>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <?php
        $total_geral_anexo3 += $total_tributos_anexo3;
        $total_geral_anexo5 += $total_tributos_anexo5;
        $total_geral_presumido += $total_tributos_presumido;
    ?>

<?php endfor ?>

<script type="text/javascript">
    var totalTributacaoAnexo3 = document.getElementById('t-tributacao-anexo3');
    var totalIrrfAnexo3 = document.getElementById('t-irrf-anexo3');
    var totalInssAnexo3 = document.getElementById('t-inss-anexo3');
    var totalGeralAnexo3 = document.getElementById('t-geral-anexo3');

    var totalTributacaoAnexo5 = document.getElementById('t-tributacao-anexo5');
    var totalGeralAnexo5 = document.getElementById('t-geral-anexo5');

    var totalTributacaoPresumido = document.getElementById('t-tributacao-presumido');
    var totalGeralPresumido = document.getElementById('t-geral-presumido');

    totalTributacaoAnexo3.innerHTML = 'R$ ' + numeroParaMoeda(<?=$total_tributacao_anexo3?>, 2, ',', '.');
    totalIrrfAnexo3.innerHTML = 'R$ ' + numeroParaMoeda(<?=$total_irrf_anexo3?>, 2, ',', '.');
    totalInssAnexo3.innerHTML = 'R$ ' + numeroParaMoeda(<?=$total_inss_anexo3?>, 2, ',', '.');
    totalGeralAnexo3.innerHTML = 'R$ ' + numeroParaMoeda(<?=$total_geral_anexo3?>, 2, ',', '.');

    totalTributacaoAnexo5.innerHTML = 'R$ ' + numeroParaMoeda(<?=$total_tributacao_anexo5?>, 2, ',', '.');
    totalGeralAnexo5.innerHTML = 'R$ ' + numeroParaMoeda(<?=$total_geral_anexo5?>, 2, ',', '.');

    totalTributacaoPresumido.innerHTML = 'R$ ' + numeroParaMoeda(<?=$total_tributacao_presumido?>, 2, ',', '.');
    totalGeralPresumido.innerHTML = 'R$ ' + numeroParaMoeda(<?=$total_geral_presumido?>, 2, ',', '.');

    function numeroParaMoeda(n, c, d, t){
        c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    }
</script>

<?php
require_once('rodape.php');
require_once('../rodape.php');
?>
