<?php

namespace App\Core\Helpers;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class MailerHelper
{

    private $_mail;

    public function __construct()
    {
        $this->_mail = new PHPMailer(true);

        $this->_mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $this->_mail->isSMTP();                                            //Send using SMTP
        $this->_mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $this->_mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $this->_mail->Username   = 'tn411452@gmail.com';                     //SMTP username
        $this->_mail->Password   = 'sbtphygpafbkhhbi';                               //SMTP password
        $this->_mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $this->_mail->Port       = 465;
    }

    // tu viet them param $from, $to, $cc, $bcc
    public function recipients($from = ['tn411452@gmail.com' => 'T-Store'], $to)
    {
        foreach ($from as $mail => $name) {
            $this->_mail->setFrom($mail, $name);
        }
        foreach ($to as $mail => $name) {
            $this->_mail->addAddress($mail, $name);     //Add a recipient
        }
        // $this->_mail->addReplyTo('info@example.com', 'Information');
        // $this->_mail->addCC('cc@example.com');
        // $this->_mail->addBCC('bcc@example.com');
    }



    // tu viet them content
    public function content($subject,$body)
    {
        $this->_mail->isHTML(true);
        $this->_mail->CharSet    = 'UTF-8';                                  //Set email format to HTML
        $this->_mail->Subject = $subject;


        $this->_mail->Body= $body;




        $this->_mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    }

    public function send()
    {
        $this->_mail->send();
    }
}
