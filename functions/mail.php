<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../PHPMailer-master/src/Exception.php';
require __DIR__ . '/../PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/../PHPMailer-master/src/SMTP.php';

function send_mail($recipient, $subject, $message)
{

    $mail = new PHPMailer();
    $mail->IsSMTP();

    $mail->SMTPDebug  = 0;
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    //$mail->Host       = "smtp.mail.yahoo.com";
    $mail->Username   = "noel.salazar17.es@gmail.com";
    $mail->Password   = "bploaelrxbvnugyw";

    $mail->IsHTML(true);
    $mail->AddAddress($recipient, "esteemed customer");
    $mail->SetFrom("noel.salazar17.es@gmail.com", "TRAVIS");
    //$mail->AddReplyTo("reply-to-email", "reply-to-name");
    //$mail->AddCC("cc-recipient-email", "cc-recipient-name");
    $mail->Subject = $subject;
    $content = $message;

    $mail->MsgHTML($content);
    if (!$mail->Send()) {
        //echo "Error while sending Email.";
        //echo "<pre>";
        //var_dump($mail);
        return false;
    } else {
        //echo "Email sent successfully";
        return true;
    }
}
