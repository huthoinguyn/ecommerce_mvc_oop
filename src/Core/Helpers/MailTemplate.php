<?php

namespace App\Core\Helpers;

use App\Core\Helpers\MailerHelper;

class MailTemplate extends MailerHelper
{
    public function ForgotPassword($from, $to)
    {
        $this->recipients($from, $to);
        $subject = 'Your Password';
        ob_start();
        include __DIR__ .'/../../Views/mailForgot.php';
        $content = ob_get_contents();
        ob_get_clean();
        $body = $content;

        $this->content($subject, $body);
        $this->send();
    }
}
