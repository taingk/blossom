<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PHPMailerController {

    public function indexAction( $aParams ) {
        require 'core/PHPMailer/vendor/autoload.php';

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Host = 'ssl://smtp.gmail.com';
        $mail->IsHTML(true);
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Username = "contact.blossoom@gmail.com";
        $mail->Password = "grp6-BlossomESGI";
        $mail->setFrom('contact.blossoom@gmail.com', 'Blossom');
        $mail->addAddress('lavan.prep@gmail.com', 'Lavan Prepanantha');

        $mail->Subject = "Blossom | Confirmation d'inscription";
        $messageContent = file_get_contents("views/emailing/sendEmail.view.html");
        if($_SERVER["SERVER_NAME"] == "blossoom.ovh" || $_SERVER["SERVER_NAME"] == "dev.blossoom.ovh") {
            $messageContent = str_ireplace("/public/img/logo_blanc.png", "https://".$_SERVER["SERVER_NAME"]."/public/img/logo_blanc.png", $messageContent);
            $messageContent = str_ireplace("/public/font/AvenirNextRegular.otf", "https://".$_SERVER["SERVER_NAME"]."/public/font/AvenirNextRegular.otf", $messageContent);    
        }
        $messageContent = $mail->msgHTML($messageContent);
        echo $_SERVER["SERVER_NAME"];

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
    }

}
