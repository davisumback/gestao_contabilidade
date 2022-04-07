<?php

namespace App\Email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Config\EmailGuiasMedcontabilConfig;

class EmailGuiasMedcontabil
{
    public static function enviaEmail($para, $nome, $titulo, $corpo, $copia = '', $anexos = '', $emails = null)
    {
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = EmailGuiasMedcontabilConfig::HOST;                       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = EmailGuiasMedcontabilConfig::USER_NAME;                 // SMTP username
            $mail->Password = EmailGuiasMedcontabilConfig::SENHA;                         // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';                                    // TCP port to connect to

            //Recipients
            $mail->setFrom(EmailGuiasMedcontabilConfig::USER_NAME, EmailGuiasMedcontabilConfig::TITULO_EMAIL);

            foreach ($emails as $email) {
                $mail->addAddress($email, $nome);
            }

            $mail->addAddress($para, $nome);                        // Name is optional
            $mail->addReplyTo(EmailGuiasMedcontabilConfig::USER_NAME, EmailGuiasMedcontabilConfig::NOME_EMAIL_DE_RESPOSTA);

            if($copia != ''){
                $mail->addCC($copia);
            }

            if(!empty($anexos)){
                foreach ($anexos as $caminho) {
                    $mail->addAttachment($caminho);
                }
            }

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $titulo;
            $mail->Body    = $corpo;
            //$mail->AltBody = 'Outro teste';

            $mail->send();

            $mail->ClearAllRecipients();
            $mail->ClearAttachments();

            return true;
        } catch (Exception $e) {
            //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            return false;
        }
    }
}
