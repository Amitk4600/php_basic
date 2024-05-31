<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

function sendMail($email, $name)
{

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'amitk4600@gmail.com';
        $mail->Password   = 'ndodbudmsertulqy';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;


        $mail->setFrom('amitk4600@gmail.com', 'Mailer');
        $mail->addAddress("$email", 'xyz');

        $mail->isHTML(true);
        $mail->Subject = 'Welcome to xyzTech.com!';
        $mail->Body    = "Dear <b>$name</b> <br>
        Welcome aboard! 🎉 Thank you for registering with us. 
            Your journey with xyzTech.com starts now!
            Explore our offerings and feel free to reach out if you need any assistance.
            
            Best regards,";


        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: $e{$mail->ErrorInfo}";
    }
}
