<?php
require_once 'like_comments/Comments.class.php';
require_once './user/User.class.php';
$user = new User();
$userdata = $user->userSignedIn($_SESSION['session_id']);
if (!$_GET[id])
    header("Location: ./galerie.php");
$image_id = intval($_GET[id]);
$comments_class = new Comments;
if ($_POST[submit] === "Poster")
    $comments_class->addComment($_POST[content], $_POST[image_id], $userdata[id]);
$comments = $comments_class->showComments($image_id);
// print_r($comments); // la liste de tout les commentaires est gérée en back, il faut l'afficher joliement en front maintenant
?>
<!-- <!DOCTYPE html>
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
    <body> -->
        <div class="container is-fluid">
        <table>
        <?php
        foreach($comments as $comment) {
            echo "<tr>";
            echo "<td><b>{$comment[username]}:</b> {$comment[comment]}<br></td>";
            echo "</tr>";
        } 
        ?>
        </table>
    <!-- </body>
</html> -->