<?php

namespace App\Email;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Config\EmailOsConfig;

class EmailProposta
{
    public static function send($configuracoes, $para, $nome, $titulo, $corpo, $emailsCopia = array(), $anexos = array())
    {
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = $configuracoes['host'];                       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = $configuracoes['user_name'];                 // SMTP username
            $mail->Password = $configuracoes['senha'];                         // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';                                    // TCP port to connect to

            //Recipients
            $mail->setFrom($configuracoes['user_name'], $configuracoes['titulo_email']);
            $mail->addAddress($para, $nome);                        // Name is optional
            $mail->addReplyTo($configuracoes['user_name'], $configuracoes['nome_email_de_resposta']);

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
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $titulo;
            $mail->Body    = $corpo;
            //$mail->AltBody = 'Outro teste';

            $mail->send();

            $mail->ClearAllRecipients();
            $mail->ClearAttachments();

            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);

            // return 'Mensagem não enviada. Mailer Error: ' . $mail->ErrorInfo;
        }
    }
}
