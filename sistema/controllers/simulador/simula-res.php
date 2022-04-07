<?php

use App\Helper\Simulador;
use App\Helper\Helpers;

require_once('../../../vendor/autoload.php');

session_start();
$pasta = '../../' . $_SESSION['pasta'];

$faturamento = Helpers::formataMoedaBd($_POST['faturamento']);

$iss = $_POST['iss'] / 100;

$rbt12 = array();
$anexo3 = array();
$anexo3_sem_atencipacao = array();
$inss_anexo3_sem_antecipacao = array();
$irrf_anexo3_sem_antecipacao = array();
$anexo5 = array();
$presumido = array();
$faturamento_array = array();

$inss_anexo3 = array();
$irrf_anexo3 = array();

$total_faturamento = 0;

$mes_atual = 1;

//$meses_antecipacao = $_POST['meses_antecipacao'];
$meses_antecipacao = 0;

for($i = 0; $i < 12 + $meses_antecipacao; $i++){
    if($i < $meses_antecipacao){
        $faturamento_array[$i] = 0;
        $presumido[$i] = 0;
        $inss_anexo3[$i]= 0;
        $irrf_anexo3[$i] = 0;
    }else {
        $faturamento_array[$i] = $faturamento;
        $presumido[$i] = $faturamento * ($iss + 0.1133);
        $prolabore_anexo3 = $faturamento * 0.28;
        $inss_anexo3[$i] = calculaInss($prolabore_anexo3);
        $irrf_anexo3[$i] = calculaIrrf($prolabore_anexo3 - $inss_anexo3[$i]);
        $inss_anexo3_sem_antecipacao[$i] = calculaInss($prolabore_anexo3);
        $irrf_anexo3_sem_antecipacao[$i] = calculaIrrf($prolabore_anexo3 - $inss_anexo3_sem_antecipacao[$i]);
    }
}

for($i = 0; $i < sizeof($faturamento_array); $i++){
    $total_faturamento += $faturamento_array[$i];
    if($i == 0){
        $rbt12[$i] = $faturamento_array[$i] * 12;
        //$rbt12[$i] = 0;

        $resultado = calculaSnAnexo3($faturamento_array[$i], $rbt12[$i]);
        $anexo3[$i] = $resultado[1];

        $resultado2 = calculaSnAnexo3($faturamento, $rbt12[$i]);
        $anexo3_sem_atencipacao[$i] = $resultado2[1];

        $resultado = calculaSnAnexo5($faturamento_array[$i], $rbt12[$i]);
        $anexo5[$i] = $resultado[1];
    }else{
        if($i < 12){
            $rbt12_2[$i] = calculaRbt12($faturamento * $i, $i);

            $resultado2 = calculaSnAnexo3($faturamento, $rbt12_2[$i]);
            $anexo3_sem_atencipacao[$i] = $resultado2[1];

            $rbt12[$i] = calculaRbt12($total_faturamento - $faturamento_array[$i], $i);

            $resultado = calculaSnAnexo3($faturamento_array[$i], $rbt12[$i]);
            $anexo3[$i] = $resultado[1];

            $resultado = calculaSnAnexo5($faturamento_array[$i], $rbt12[$i]);
            $anexo5[$i] = $resultado[1];
        }else {
            $proporcional = $i - 12;

            $rbt12[$i] = calculaRbt12($total_faturamento - $faturamento_array[$proporcional], 12);

            $resultado = calculaSnAnexo3($faturamento_array[$i], $rbt12[$i]);
            $anexo3[$i] = $resultado[1];

            $resultado = calculaSnAnexo5($faturamento_array[$i], $rbt12[$i]);
            $anexo5[$i] = $resultado[1];
        }

    }
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

function calculaRbt12($valor, $meses){
    return ($valor / $meses) * 12;
}

function calculaSnAnexo5($fat_mensal, $rbt12){ // TEM QUE SER O RBT12
    if($rbt12 <= 180000){
        $aliquota_cpp = 0.2885;
        $resultado[0] = 0.155;
        $resultado[1] = $fat_mensal * 0.155;
        //$resultado[2] = calculaCpp($resultado[1], $aliquota_cpp); // CPP
        $resultado[3] = 'anexo5';
        $resultado[4] = '1ª';
        return $resultado;

    }elseif($rbt12 > 180000 && $rbt12 <= 360000){
        $aliquota_cpp = 0.2785;
        $aliquota =  ($rbt12 * 0.18 - 4500) / $rbt12;
        $resultado[0] = $aliquota;
        $resultado[1] = $fat_mensal * $aliquota;
        //$resultado[2] = calculaCpp($resultado[1], $aliquota_cpp); // CPP
        $resultado[3] = 'anexo5';
        $resultado[4] = '2ª';
        return $resultado;

    }elseif($rbt12 > 360000 && $rbt12 <= 720000){
        $aliquota_cpp = 0.2385;
        $aliquota =  ($rbt12 * 0.195 - 9900) / $rbt12;
        $resultado[0] = $aliquota;
        $resultado[1] = $fat_mensal * $aliquota;
        //$resultado[2] = calculaCpp($resultado[1], $aliquota_cpp); // CPP
        $resultado[3] = 'anexo5';
        $resultado[4] = '3ª';
        return $resultado;

    }elseif($rbt12 > 720000 && $rbt12 <= 1800000){
        $aliquota_cpp = 0.2385;
        $aliquota =  ($rbt12 * 0.205 - 17100) / $rbt12;
        $resultado[0] = $aliquota;
        $resultado[1] = $fat_mensal * $aliquota;
        //$resultado[2] = calculaCpp($resultado[1], $aliquota_cpp); // CPP
        $resultado[3] = 'anexo5';
        $resultado[4] = '4ª';
        return $resultado;

    }
    elseif($rbt12 > 1800000 && $rbt12 <= 3600000){
        $aliquota_cpp = 0.2385;
        $aliquota =  ($rbt12 * 0.23 - 62100) / $rbt12;
        $resultado[0] = $aliquota;
        $resultado[1] = $fat_mensal * $aliquota;
        //$resultado[2] = calculaCpp($resultado[1], $aliquota_cpp); // CPP
        $resultado[3] = 'anexo5';
        $resultado[4] = '4ª';
        return $resultado;

    }
    elseif($rbt12 > 3600000 && $rbt12 <= 4800000){
        $aliquota_cpp = 0.2950;
        $aliquota =  ($rbt12 * 0.305 - 540000) / $rbt12;
        $resultado[0] = $aliquota;
        $resultado[1] = $fat_mensal * $aliquota;
        //$resultado[2] = calculaCpp($resultado[1], $aliquota_cpp); // CPP
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
        //$resultado[2] = calculaCpp($resultado[1], $aliquota_cpp);
        $resultado[3] = 'anexo3';
        $resultado[4] = '1ª';
        return $resultado;

    }elseif($rbt12 > 180000 && $rbt12 <= 360000){
        $aliquota_cpp = 0.434;
        $aliquota =  ($rbt12 * 0.1120 - 9360) / $rbt12;
        $resultado[0] = $aliquota;
        $resultado[1] = $fat_mensal * $aliquota;
        //$resultado[2] = calculaCpp($resultado[1], $aliquota_cpp);
        $resultado[3] = 'anexo3';
        $resultado[4] = '2ª';
        return $resultado;

    }elseif($rbt12 > 360000 && $rbt12 <= 720000){
        $aliquota_cpp = 0.434;
        $aliquota =  ($rbt12 * 0.1350 - 17640) / $rbt12;
        $resultado[0] = $aliquota;
        $resultado[1] = $fat_mensal * $aliquota;
        //$resultado[2] = calculaCpp($resultado[1], $aliquota_cpp);
        $resultado[3] = 'anexo3';
        $resultado[4] = '3ª';
        return $resultado;

    }elseif($rbt12 > 720000 && $rbt12 <= 1800000){
        $aliquota_cpp = 0.434;
        $aliquota =  ($rbt12 * 0.16 - 35640) / $rbt12;
        $resultado[0] = $aliquota;
        $resultado[1] = $fat_mensal * $aliquota;
        //$resultado[2] = calculaCpp($resultado[1], $aliquota_cpp);
        $resultado[3] = 'anexo3';
        $resultado[4] = '4ª';
        return $resultado;

    }
    elseif($rbt12 > 1800000 && $rbt12 <= 3600000){
        $aliquota_cpp = 0.434;
        $aliquota =  ($rbt12 * 0.21 - 125640) / $rbt12;
        $resultado[0] = $aliquota;
        $resultado[1] = $fat_mensal * $aliquota;
        //$resultado[2] = calculaCpp($resultado[1], $aliquota_cpp);
        $resultado[3] = 'anexo3';
        $resultado[4] = '5ª';
        return $resultado;
    }
    elseif($rbt12 > 3600000 && $rbt12 <= 4800000){
        $aliquota_cpp = 0.305;
        $aliquota =  ($rbt12 * 0.33 - 648000) / $rbt12;
        $resultado[0] = $aliquota;
        $resultado[1] = $fat_mensal * $aliquota;
        //$resultado[2] = calculaCpp($resultado[1], $aliquota_cpp);
        $resultado[3] = 'anexo3';
        $resultado[4] = '6ª';
        return $resultado;
    }
}

setcookie("anexo3_sem_antecipacao", json_encode($anexo3_sem_atencipacao), time()+100000, '/');
setcookie("inss_sem_antecipacao", json_encode($inss_anexo3_sem_antecipacao), time()+100000, '/');
setcookie("irrf_sem_antecipacao", json_encode($irrf_anexo3_sem_antecipacao), time()+100000, '/');

setcookie("faturamento_array", json_encode($faturamento_array), time()+100000, '/');
setcookie("anexo3", json_encode($anexo3), time()+100000, '/');
setcookie("anexo5", json_encode($anexo5), time()+100000, '/');
setcookie("presumido", json_encode($presumido), time()+100000, '/');

setcookie("inss_anexo3", json_encode($inss_anexo3), time()+100000, '/');
setcookie("irrf_anexo3", json_encode($irrf_anexo3), time()+100000, '/');

header("Location: " . $pasta . "/simulador-resultado-res.php");
die();
