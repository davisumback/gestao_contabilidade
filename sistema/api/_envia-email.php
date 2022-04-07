<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function enviaEmail($para, $nome, $titulo, $corpo){
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'tthiagogaia@gmail.com';                 // SMTP username
        $mail->Password = '2242Carro';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('tthiagogaia@gmail.com', 'Medb - Contabilidade e Finanças');
        //$mail->addAddress('tthiagogaia@gmail.com', 'Joe User');     // Add a recipient
        $mail->addAddress($para, $nome);               // Name is optional
        $mail->addReplyTo('nao@responda.com', 'No-reply');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

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
        //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        return false;
    }
}
