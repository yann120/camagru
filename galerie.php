<?php require './user/User.class.php';
include './partials/navbar.php';
require_once 'montage/Images.class.php';
if ($_GET[action] === "logout")
    {
        if ($user->logout($_SESSION['session_id']))
            echo "<script type='text/javascript'> document.location = '/index.php'; </script>";
    }
    $image = new Images;
    $allimages = $image->showAll();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Camagru</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
        <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
        <link rel="stylesheet" type = "text/css" href="main.css">
    </head>
    <body>
        <h1 class="title is-1 has-text-centered">Galerie</h1>
        <div class="container is-fluid">
        <?php
            foreach ($allimages as $image) {
                echo "<div class='card'>
                <div class='card-image'>
                    <figure class='image is-4by3'>
                    <img src='$image[path]' alt='Placeholder image'>
                    </figure>
                </div>
                <div class='card-content'>
                    <div class='media'>
                        <div class='media-left'></div>
                        <div class='media-content'>
                            <p class='title is-4'>John Smith</p>
                            <p class='subtitle is-6'>@johnsmith</p>
                        </div>
                    </div>
                    <time datetime='2016-1-1'>11:09 PM - 1 Jan 2016</time>
                </div>
                <footer class='card-footer'>
                    <a href='#' class='card-footer-item'>
                        <span class='icon'>
                            <i class='fas fa-thumbs-up'></i>
                        </span>
                    </a>
                    <a href='#' class='card-footer-item'>Comment</a>
                </footer>
            </div>";
            }
        ?>
        </div>
    </body>
</html>