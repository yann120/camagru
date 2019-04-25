<?php
function send_mail($email, $subject, $message)
{
    $message = wordwrap($message, 70, "\n");
    $headers = 'From: camagru@42.fr' . "\r\n" .
            'Reply-To: camagru@42.fr' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
    mail($email, $subject, $message, $headers);
}
?>