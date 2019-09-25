<?php
function send_mail($email, $subject, $message)
{
    $message = wordwrap($message, 70, "\n");
    $headers = 'From: camagru@42.fr' . "\r\n" .
            'Reply-To: camagru@42.fr' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
    mail($email, $subject, $message, $headers);
}

function debug($tab)
{
    ob_start();
    var_export($tab);
    $tab_debug=ob_get_contents();
    ob_end_clean();
    $fichier=fopen('test.log','w');
    fwrite($fichier,$tab_debug);
    fclose($fichier);
}
?>
