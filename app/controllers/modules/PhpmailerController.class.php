<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PhpmailerController {

    public function indexAction( $aParams ) {
        echo 'oui';
        //Load Composer's autoloader
        require 'core/PHPMailer/vendor/autoload.php';
        
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'contact.blossoom@gmail.com';                 // SMTP username
            $mail->Password = 'grp6-BlossomESGI';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
        
            //Recipients
            $mail->setFrom('contact.blossoom@gmail.com', 'Blossom | Service contact');
            $mail->addAddress('lavan.prep@gmail.com', 'Joe User');     // Add a recipient
            $mail->addAddress('enzo_huynh@hotmail.com ', 'Joe User');     // Add a recipient
            // $mail->addReplyTo('lavan.prep@gmail.com', 'Information');
        
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            if (!$mail->send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                echo "Message sent!";
            }

        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }   
    }

}
