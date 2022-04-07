<?php
/******************************************************************************
1 - Falta fazer a validação de data máxima e data mínima;
2 - Falta fazer a visualização de período maior que 1 ano;
******************************************************************************/
//$data_minima_permitida = '01/01/2000';
//$data = new DateTime();
//$data_minima = $data->createFromFormat('d/m/Y', $data_minima_permitida);

//$data_maxima_permitida = '01/01/2040';
//$data2 = new DateTime();
//$data_maxima = $data2->createFromFormat('d/m/Y', $data_maxima_permitida);

$pasta = '../../' . $_POST['pasta'];

$dia_padrao = '02';

$data = new DateTime();
$data_cheating = $dia_padrao.'/'.$_POST['data_inicio'];
$data_inicio_original = $data->createFromFormat('d/m/Y', $data_cheating);

$data2 = new \DateTime();
$data_cheating = $dia_padrao.'/'.$_POST['data_fim'];
$data_fim_original = $data2->createFromFormat('d/m/Y', $data_cheating);


if($data_inicio_original == false || $data_fim_original == false){
    setcookie("erro_data", "Data inválida.", time()+2, '/');
    header("Location: ../form-simulador-com.php");
    die();
}

$inicio = $data_inicio_original->format('Y-m-d');
$fim = $data_fim_original->format('Y-m-d');

if(strtotime($inicio) > strtotime($fim)){
    setcookie("erro_data", "Data de início maior que data do fim.", time()+2, '/');
    header("Location: ../form-simulador-com.php");
    die();
}

$dataFim    = new \DateTime($fim);
$dataInicio = new \DateTime($inicio);
$periodo    = new \DatePeriod($dataInicio, new \DateInterval("P1D"), $dataFim);

$intervalo = array();

foreach ($periodo as $data) {
    $aux = array();

    $mes = $data->format('m');

    $data_formatada = converteMes($data->format('m')) . '-' . $data->format('Y');
    array_push($aux, $data_formatada);

    $id = strtolower(converteMes($data->format('m'))) . '-' . $data->format('Y');
    array_push($aux, $id);

    array_push($aux, $mes);

    array_push($intervalo, $aux);
}

$array_final = array_unique($intervalo, SORT_REGULAR);

function converteMes($numero_mes){
    $saida = '';

    switch ($numero_mes) {
        case '01':
            $saida = 'Jan';
            break;
        case '02':
            $saida = 'Fev';
            break;
        case '03':
            $saida = 'Mar';
            break;
        case '04':
            $saida = 'Abr';
            break;
        case '05':
            $saida = 'Mai';
            break;
        case '06':
            $saida = 'Jun';
            break;
        case '07':
            $saida = 'Jul';
            break;
        case '08':
            $saida = 'Ago';
            break;
        case '09':
            $saida = 'Set';
            break;
        case '10':
            $saida = 'Out';
            break;
        case '11':
            $saida = 'Nov';
            break;
        case '12':
            $saida = 'Dez';
            break;
        default:
            $saida = '';
            break;
    }

    return $saida;
}

$intervalo = json_encode($array_final);

setcookie("intervalo", $intervalo, time()+20000, '/');
header("Location: " . $pasta . "/simulador-com.php");
die();
