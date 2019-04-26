<?php require './user/User.class.php';
include './partials/navbar.php';
require_once 'like_comments/Comments.class.php';
if (!$_GET[id])
    header("Location: ./galerie.php");
$image_id = intval($_GET[id]);
$comments_class = new Comments;
$comments = $comments_class->showComments($image_id);
print_r($comments); // la liste de tout les commentaires est gérée en back, il faut l'afficher joliement en front maintenant
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
        <script src="script.js"></script>
    </head>
    <body>
        <h1 class="title is-1 has-text-centered">Comments</h1>
        <div class="container is-fluid">
    </body>
</html>