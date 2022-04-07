<?php

namespace App\Email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Config\EmailOsConfig;

class EmailOsMedb
{
    public static function send($configuracoes, $para, $nome, $titulo, $corpo, $emailsCopia = array(), $anexos = array())
    {
        $mail = new PHPMailer(true);

        try {            
            //Server settings
            $mail->SMTPDebug = 0;                                 
            $mail->isSMTP();                                     
            $mail->Host = $configuracoes['HOST'];                       
            $mail->SMTPAuth = true;                               
            $mail->Username = $configuracoes['USER_NAME'];
            $mail->Password = $configuracoes['SENHA'];
            $mail->SMTPSecure = 'tls';                            
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';                                  

            //Recipients
            $mail->setFrom($configuracoes['USER_NAME'], $configuracoes['TITULO_EMAIL']);
            $mail->addAddress($para, $nome);                       
            $mail->addReplyTo($configuracoes['USER_NAME'], $configuracoes['NOME_EMAIL_DE_RESPOSTA']);

            if (! empty($emailsCopia)) {
                foreach ($emailsCopia as $email) {
                    $mail->addCC($email);
                }
            }

            if (! empty($anexos)) {
                foreach ($anexos as $caminho) {
                    $mail->addAttachment($caminho);
                }
            }

            //Content
            $mail->isHTML(true);                                  
            $mail->Subject = $titulo;
            $mail->Body    = $corpo;

            $mail->send();

            $mail->ClearAllRecipients();
            $mail->ClearAttachments();

        } catch (\Exception $e) {
            throw new \Exception('Mensagem não enviada. Error: ' . $mail->ErrorInfo, 1);            
        }
    }
}
