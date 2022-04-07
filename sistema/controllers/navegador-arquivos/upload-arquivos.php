<?php
session_start();
$pastaView = '../../' . $_SESSION['pasta'];

$resultados = array();

if(isset($_FILES['fileUpload'])){
    date_default_timezone_set("Brazil/East");

    $name     = $_FILES['fileUpload']['name']; //Atribui uma array com os nomes dos arquivos à variável
    $tmp_name = $_FILES['fileUpload']['tmp_name']; //Atribui uma array com os nomes temporários dos arquivos à variável

    $allowedExts = array(".txt", ".jpeg", ".jpg", ".png", ".pdf"); //Extensões permitidas

    $dir = '../' . $_SESSION['diretorio_base']; // Foi necessário subir mais um nível, pois a pasta Controller de Arquivos
    // está um nível a mais do arquivo da view navegador-arquivos.php

    for($i = 0; $i < count($tmp_name); $i++){ //passa por todos os arquivos
        $ext = strtolower(substr($name[$i],-4));
        $name[$i] = str_replace(" ", "_", $name[$i]);

        if(in_array($ext, $allowedExts)){ //Pergunta se a extensão do arquivo, está presente no array das extensões permitidas
            $new_name = date("Y.m.d-H.i.s") ."-". $i . $ext;

            $resultados[] = move_uploaded_file($_FILES['fileUpload']['tmp_name'][$i], $dir.$name[$i]); //Fazer upload do arquivo
        }
    }
}

// foreach ($resultados as $valor) {
//     if($valor == false){
//         header('Location: https:www.google.com.br');
//         die();
//     }
// }

header('Location: ' . $pastaView. '/empresa-arquivos.php?dir='.$_SESSION['diretorio_base']);
die();
?>
