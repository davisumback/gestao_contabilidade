<?php

namespace App\Email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Config\EmailConfig;

class EmailGuias
{
    public static function enviaEmail($para, $nome, $titulo, $corpo, $copia = '', $anexos = '', $emails = null)
    {
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = EmailConfig::HOST;                       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = EmailConfig::USER_NAME;                 // SMTP username
            $mail->Password = EmailConfig::SENHA;                         // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';                                    // TCP port to connect to

            //Recipients
            $mail->setFrom(EmailConfig::USER_NAME, EmailConfig::TITULO_EMAIL);

            foreach ($emails as $email) {
                $mail->addAddress($email, $nome);
            }

            $mail->addAddress($para, $nome);                        // Name is optional
            $mail->addReplyTo(EmailConfig::USER_NAME, EmailConfig::NOME_EMAIL_DE_RESPOSTA);

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
