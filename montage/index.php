<?php 
require '../user/User.class.php';
require '../partials/helper.php';
include '../partials/navbar.php';
require_once 'Images.class.php';
    $image = new Images;
    if ($_POST['submit'])
        $image->upload($userdata[id]);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Camagru</title>
        <link rel="stylesheet" href="main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
        <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    </head>
    <body>
    <div class="container is-fluid">
        <h1 class="title is-1 has-text-centered">Montage</h1>
        <div class="columns">
            <div class="column is-two-thirds has-background-primary"> Main </div>
            <div class="column has-background-link is-offset-1">side</div>
        </div>
    </div>
        <form action="" method="post" enctype="multipart/form-data">
        <p>Images:
        <input type="file" name="picture" />
        <input type="submit" value="submit" name="submit" />
        </p>
        </form>
    </body>
</html>

