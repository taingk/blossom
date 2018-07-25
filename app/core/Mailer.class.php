<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {
    private $oMail;

    public function __construct() {
        require 'core/PHPMailer/vendor/autoload.php';

        $this->oMail = new PHPMailer;
        $this->oMail->isSMTP();
        // $this->oMail->SMTPDebug = 2;
        $this->oMail->Host = 'ssl://smtp.gmail.com';
        $this->oMail->IsHTML(true);
        $this->oMail->Port = 465;
        $this->oMail->SMTPSecure = 'ssl';
        $this->oMail->SMTPAuth = true;
        $this->oMail->Username = MAILUSER;
        $this->oMail->Password = MAILPASSWORD;
        $this->oMail->setFrom(MAILUSER, $aSite ? $aSite['name'] : 'Blossom');
    }

    public function confirmMail( $aParams, $sToken ) {
        $oSite = new Sites();
        $oSite->setStatus(1);
        $aSite = $oSite->select()[0];

        $this->oMail->addAddress($aParams['POST']['email'], ucfirst(strtolower($aParams['POST']['firstname'])) . ' ' . strtoupper($aParams['POST']['lastname']));
        $this->oMail->Subject = !empty($aSite) ? $aSite['name'] . " | Confirmation d'inscription" : "Blossom | Confirmation d'inscription";
        $messageContent = file_get_contents("views/emailing/confirmMail.view.html");

        $messageContent = str_ireplace("/public/img/logo_blanc.png", "https://".$_SERVER["SERVER_NAME"]."/public/img/logo_blanc.png", $messageContent);
        $messageContent = str_ireplace("/public/font/AvenirNextRegular.otf", "https://".$_SERVER["SERVER_NAME"]."/public/font/AvenirNextRegular.otf", $messageContent);
        $messageContent = str_ireplace("{link}", "https://".$_SERVER["SERVER_NAME"].'/back/users/confirm?token=' . $sToken, $messageContent);
        $messageContent = str_ireplace("{name}", ucfirst(strtolower($aParams['POST']['firstname'])) . ' ' . strtoupper($aParams['POST']['lastname']), $messageContent);
        $messageContent = $this->oMail->msgHTML($messageContent);

        if (!$this->oMail->send()) {
            echo "Mailer Error: " . $this->oMail->ErrorInfo;
        }
    }

    public function paymentSuccessfulMail( $aParams ) {
        $this->oMail->addAddress($aParams['email'], ucfirst(strtolower($aParams['firstname'])) . ' ' . strtoupper($aParams['lastname']));
        $this->oMail->Subject = !empty($aSite) ? $aSite['name'] . " | Paiement confirmé" : "Blossom | Confirmation de paiement";
        $messageContent = file_get_contents("views/emailing/paymentSuccessful.view.html");

        $messageContent = str_ireplace("/public/img/logo_blanc.png", "https://".$_SERVER["SERVER_NAME"]."/public/img/logo_blanc.png", $messageContent);
        $messageContent = str_ireplace("/public/font/AvenirNextRegular.otf", "https://".$_SERVER["SERVER_NAME"]."/public/font/AvenirNextRegular.otf", $messageContent);
        $messageContent = str_ireplace("{link}", "https://".$_SERVER["SERVER_NAME"].'/front/user/profile', $messageContent);
        $messageContent = str_ireplace("{name}", $aParams['firstname'] . ' ' . $aParams['lastname'], $messageContent);
        $messageContent = $this->oMail->msgHTML($messageContent);

        if (!$this->oMail->send()) {
            echo "Mailer Error: " . $this->oMail->ErrorInfo;
        }
    }

}
