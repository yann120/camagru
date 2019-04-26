<?php 
    require './user/User.class.php';
    include './partials/navbar.php';
    if ($_GET[action] === "logout")
    {
        if ($user->logout($_SESSION['session_id']))
            echo "<script type='text/javascript'> document.location = '/index.php'; </script>";
    }
    if ($_GET[user_verification])
    {
        if ($user->user_validation($_GET[user_verification]))
            $message = "Utilisateur validé!";
        else
            $message = "Lien de vérification erroné";
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Camagru</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
        <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
        <h1 class="title is-1 has-text-centered">Home</h1>
        <?php
            if ($userdata)
                echo "<h3 class='title is-3 has-text-centered'>Bonjour $userdata[username]</h3>";
            if ($message)
                echo "<h3 class='title is-3 has-text-centered'>$message</h3>";
        ?>
    </body>
</html>