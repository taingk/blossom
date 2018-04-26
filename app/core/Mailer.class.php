<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {

    public function sendMail( $aParams ) {
        require 'core/PHPMailer/vendor/autoload.php';

        $mail = new PHPMailer;
        $mail->isSMTP();
        // $mail->SMTPDebug = 2;
        $mail->Host = 'ssl://smtp.gmail.com';
        $mail->IsHTML(true);
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Username = "contact.blossoom@gmail.com";
        //Password to use for SMTP authentication
        $mail->Password = "grp6-BlossomESGI";
        //Set who the message is to be sent from
        $mail->setFrom('contact.blossoom@gmail.com', 'Blossom');
        $mail->addAddress($aParams['POST']['email'], ucfirst(strtolower($aParams['POST']['firstname'])) . ' ' . strtoupper($aParams['POST']['lastname']));

        $mail->Subject = "Blossom | Confirmation d'inscription";
        $messageContent = file_get_contents("views/emailing/sendEmail.view.html");

        foreach ( $aParams['POST'] as $sKey => $sValue ) {
            $sGetParams .= $sKey . "=" . $sValue . "&";
        }

        $sGetParams = substr($sGetParams, 0, -1);

        $messageContent = str_ireplace("/public/img/logo_blanc.png", "https://".$_SERVER["SERVER_NAME"]."/public/img/logo_blanc.png", $messageContent);
        $messageContent = str_ireplace("/public/font/AvenirNextRegular.otf", "https://".$_SERVER["SERVER_NAME"]."/public/font/AvenirNextRegular.otf", $messageContent);
        $messageContent = str_ireplace("{link}", "https://".$_SERVER["SERVER_NAME"].'/back/users/confirm?' . $sGetParams, $messageContent);
        $messageContent = str_ireplace("{name}", ucfirst(strtolower($aParams['POST']['firstname'])) . ' ' . strtoupper($aParams['POST']['lastname']), $messageContent);
        $messageContent = $mail->msgHTML($messageContent);

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        // else {
        //     echo "Message sent!";
        // }
    }

}
