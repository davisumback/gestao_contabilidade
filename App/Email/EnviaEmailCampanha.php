<?php

namespace App\Email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Config\EmailMarketingConfig;

class EnviaEmailCampanha
{
    public static function send($para, $nome, $titulo, $corpo, $copia = '', $anexos = '')
    {
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = EmailMarketingConfig::HOST;                       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = EmailMarketingConfig::USER_NAME;                 // SMTP username
            $mail->Password = EmailMarketingConfig::SENHA;                         // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';                                    // TCP port to connect to

            //Recipients
            $mail->setFrom(EmailMarketingConfig::USER_NAME, EmailMarketingConfig::TITULO_EMAIL);
            $mail->addAddress($para, $nome);                        // Name is optional
            $mail->addReplyTo(EmailMarketingConfig::USER_NAME, EmailMarketingConfig::NOME_EMAIL_DE_RESPOSTA);

            if($copia != '') {
                $mail->addCC($copia);
            }

            if(!empty($anexos)){
                foreach ($anexos as $caminho) {
                    $mail->addAttachment($caminho);
                }
            }

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $titulo;
            $mail->Body    = $corpo;
            //$mail->AltBody = 'Outro teste';

            $mail->send();

            $mail->ClearAllRecipients();
            $mail->ClearAttachments();

            //echo 'Message has been sent';
            return true;
        } catch (Exception $e) {
            return 'Mensagem não enviada. Mailer Error: ' . $mail->ErrorInfo;
        }
    }
}
