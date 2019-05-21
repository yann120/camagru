<?php require './user/User.class.php';
include './partials/navbar.php';
require_once 'montage/Images.class.php';
require_once 'like_comments/Like.class.php';
$image_class = new Images;
$like = new Like;
$page_number = 0;
if ($_GET[page])
    $page_number = $_GET[page];
$allimages = $image_class->showAll($page_number);
if ($_GET[action] === "logout")
{
    if ($user->logout($_SESSION['session_id']))
        echo "<script type='text/javascript'> document.location = '/index.php'; </script>";
}
if ($_GET[like]  && $userdata)
{
    $image_id = intval($_GET[like]);
    $like->likeUnlike($userdata[id], $image_id);
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
        <link rel="stylesheet" type = "text/css" href="main.css">
        <script src="script.js"></script>
    </head>
    <body>
        <h1 class="title is-1 has-text-centered">Galerie</h1>
        <div class="container is-fluid">
        <?php
            foreach ($allimages as $image) {
                $liked = $like->isLiked($userdata[id],$image[image_id]);
                echo "<div class='card'>
                <div class='card-image'>
                    <figure class='image is-4by3'>
                    <img src='$image[path]' alt='Placeholder image'>
                    </figure>
                </div>
                <div class='card-content has-text-centered'>
                            <p class='title is-4'>$image[username]</p>
                            <p class='subtitle is-6'><a href='mailto:$image[email]'>Envoyer un email</a></p>
                            <time datetime='$image[creation_date]'>$image[creation_date]</time>
                </div>
                <footer class='card-footer'>
                    <a href='galerie.php?like=$image[image_id]' id='$image[image_id]' class='card-footer-item $liked'>
                        <span class='icon'>
                            <i class='fas fa-thumbs-up'></i>
                        </span>
                        Like
                    </a>
                    <a class='card-footer-item' onclick='activateModal($image[image_id])'>Comment</a>
                </footer>
            </div>";
                echo   "<div class='modal' id ='modal$image[image_id]'>
                        <div class='modal-background'></div>
                        <div class='modal-card'>
                            <header class='modal-card-head'>
                            <p class='modal-card-title'>Comments</p>
                            <button class='delete' aria-label='close' onclick='desactivateModal($image[image_id])'></button>
                            </header>
                            <section id='ModalBody' class='modal-card-body'>
                            <iframe id='Comment'
                            title='Comments'
                            src='/comments.php?id={$image[image_id]}'>
                        </iframe>
                            </section>
                            <footer class='modal-card-foot'>
                            <form action='/comments.php' method='post'>
                            <input type='hidden' name='image_id' value='$image[image_id]'>
                                <div class='columns'>
                                    <div class='column'>
                                        <div class='control has-icons-left'>
                                            <input class='input' type='text' placeholder='Comment' required name='content' >
                                            <span class='icon is-small is-left'>
                                            <i class='fas fa-comments'></i>
                                        </div>
                                    </div>
                                    <div class='column is-one-fifth'>
                                        <div class='control'>
                                            <input type='submit' onclick='openComment($image[image_id])' class='button is-success'"; if (!$userdata) echo 'disabled'; echo " name='submit' value='Poster'>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </footer>
                        </div>
                        </div>
                        ";
            }
        ?>
        </div>
        <br>
        <div class="columns is-centered">
        <nav class="column is-four-fifths" role="navigation" aria-label="pagination">
            <div id="bottom_pagination">
                <a class="pagination-previous" <?php $image_class->newPage(1, intval($page_number)) ?>>Previous</a>
                <a class="pagination-next" <?php $image_class->newPage(0, intval($page_number)) ?>>Next page</a>
            </div>
        </nav>
        </div>
    </body>
</html>