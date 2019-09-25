<?php
    require './user/User.class.php';
    include './partials/navbar.php';
    if (isset($_GET['action']) && $_GET['action'] === "logout")
    {
        if ($user->logout($_SESSION['session_id']))
            echo "<script type='text/javascript'> document.location = '/index.php'; </script>";
    }
    if (isset($_GET['user_verification']) && $_GET['user_verification'])
    {
        if ($user->user_validation($_GET['user_verification']))
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css">
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body id="bg">
        <div id="homepagetext">
            <h1 class="title is-1 has-text-centered">Home</h1>
            <?php
                if (isset($userdata) && isset($userdata['username']))
                {
                    $userdata['username'] = strip_tags($userdata['username']);
                    echo "<h3 class='title is-3 has-text-centered homepagetext'>Bonjour $userdata[username]</h3><h3 class='homepagetext title is-3 has-text-centered'>Camagru va te faire vivre le carnaval de Venise comme si tu y étais!</h3>";
                }
                else
                {
                    echo "<h3 class='homepagetext title is-3 has-text-centered'>Connecte toi pour vivre le carnaval de Venise!</h3>";
                }
                if (isset($message))
                    echo "<h3 class='title is-3 has-text-centered homepagetext'>$message</h3>";
            ?>
        </div>
    </body>
    <footer id="footer">
            <p>Camagru born @42 Made with <span class="fas fa-heart"></span> by Yann PETITJEAN</p>
    </footer>
</html>