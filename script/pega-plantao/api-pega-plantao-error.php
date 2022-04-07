<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Model\PegaPlantao\PegaPlantaoLog;
use App\DAO\PegaPlantaoLogDAO;

function gerarLog($parceiro,$mensagem){
    $pegaPlantaoLog = new PegaPlantaoLog;
    $pegaPlantaoLog->setDescricao($mensagem);
    $pegaPlantaoLog->setParceiro($parceiro);
    
    PegaPlantaoLogDAO::create($pegaPlantaoLog);
    enviarEmailLog($mensagem);
}

function enviarEmailLog($mensagem){
	$mail = new PHPMailer(true);
	
    try {            
        //Server settings
        $mail->SMTPDebug = 0;                                 
        $mail->isSMTP();                                     
        $mail->Host = HOST;                       
        $mail->SMTPAuth = true;                               
        $mail->Username = USER_NAME;
        $mail->Password = SENHA;
        $mail->SMTPSecure = 'tls';                            
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';                                  

        //Recipients
        $mail->setFrom(USER_NAME, 'Erro na integração Pega Plantão');
        $mail->addAddress(EMAIL_NOTIFICACAO, '');                       
        $mail->addReplyTo(USER_NAME, NOME_EMAIL_DE_RESPOSTA);


        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = 'Erro na integração Pega Plantão';
        $mail->Body    = "Aconteceu algum erro na integração <b>Pega Plantão</b><br><b>Erro:</b> ".$mensagem;

        $mail->send();

        $mail->ClearAllRecipients();
        $mail->ClearAttachments();

    } catch (\Exception $e) {
        echo 'Mensagem não enviada. Error: ' . $mail->ErrorInfo;            
    }
}