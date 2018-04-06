<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PhpmailerController {

    public function indexAction( $aParams ) {
        //Import PHPMailer classes into the global namespace
        require 'core/PHPMailer/vendor/autoload.php';
        //Create a new PHPMailer instance
        $mail = new PHPMailer;
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 2;
        //Set the hostname of the mail server
        $mail->Host = 'ssl://smtp.gmail.com';
        $mail->IsHTML(true);
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6
        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 465;
        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'ssl';
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "contact.blossoom@gmail.com";
        //Password to use for SMTP authentication
        $mail->Password = "grp6-BlossomESGI";
        //Set who the message is to be sent from
        $mail->setFrom('contact.blossoom@gmail.com', 'Blossom');
        //Set an alternative reply-to address
        $mail->addReplyTo('lavan.prep@gmail.com', 'Blossom');
        //Set who the message is to be sent to
        // $mail->addAddress('taingkn@gmail.com', 'Kevin Taing');
        $mail->addAddress('lavan.prep@gmail.com', 'Lavan Prepanantha');
        //Set the subject line
        $mail->Subject = "Blossom | Confirmation d'inscription";
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        // $mail->msgHTML(file_get_contents('contents.html'), __DIR__);
        $messageContent = $mail->msgHTML(file_get_contents("views/emailing/sendEmail.view.html"), __DIR__);
        $messageContent = str_ireplace("public/img/logo_blanc.png", $_SERVER['SERVER_NAME']."public/img/logo_blanc.png", $messageContent);
        echo $_SERVER['SERVER_ADDR']."/public/img/logo_blanc.png";
        // $messageContent = str_ireplace("/public/css/grid.css", "azertyui", $messageContent);
        //Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';
        //Attach an image file
        // $mail->addAttachment('images/phpmailer_mini.png');
        //send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent!";
        }
    }

}
