<?php require './user/User.class.php';
include './partials/navbar.php';
require_once 'montage/Images.class.php';
require_once 'like_comments/Like.class.php';
$image_class = new Images;
$like = new Like;
$page_number = 0;
if (isset($_GET['page']))
    $page_number = $_GET['page'];
$allimages = $image_class->showAll($page_number);
if (isset($_GET['action']) && $_GET['action'] === "logout")
{
    if ($user->logout($_SESSION['session_id']))
        echo "<script type='text/javascript'> document.location = '/index.php'; </script>";
}
if (isset($_GET['like'])  && isset($userdata))
{
    $image_id = intval($_GET['like']);
    $like->likeUnlike($userdata['id'], $image_id);
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
        <link rel="stylesheet" type = "text/css" href="main.css">
        <script src="script.js"></script>
    </head>
    <body id="bg">
        <h1 class="title is-1 has-text-centered">Galerie</h1>
        <div class="container is-fluid">
        <?php
            foreach ($allimages as $image) {
                $liked = $like->isLiked($userdata['id'],$image['image_id']);
                $nb_of_like = $like->likeCounter($image['image_id']);
                $image['username'] = strip_tags($image['username']);
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
                            <p class='subtitle is-6'>$nb_of_like like</p>
                </div>";
                if ($userdata)
                echo "<footer class='card-footer'>
                    <a href='galerie.php?like=$image[image_id]' id='$image[image_id]' class='card-footer-item $liked'>
                        <span class='icon'>
                            <i class='fas fa-thumbs-up'></i>
                        </span>
                        Like
                    </a>
                    <a class='card-footer-item' onclick='activateModal($image[image_id])'>Comment</a>
                </footer>";
                echo   "</div>
                        <div class='modal' id ='modal$image[image_id]'>
                        <div class='modal-background'></div>
                        <div class='modal-card'>
                            <header class='modal-card-head'>
                            <p class='modal-card-title'>Comments</p>
                            <button class='delete' aria-label='close' onclick='desactivateModal($image[image_id])'></button>
                            </header>
                            <section id='ModalBody' class='modal-card-body'>
                            <iframe id='Comment'
                            title='Comments'
                            src='/comments.php?id={$image['image_id']}'>
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
                                            <input type='submit' class='button is-success'"; if (!$userdata) echo 'disabled'; echo " name='submit' value='Poster'>
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
                <a class="pagination-previous pagination-button" <?php $image_class->newPage(1, intval($page_number)) ?>>Previous</a>
                <a class="pagination-next pagination-button" <?php $image_class->newPage(0, intval($page_number)) ?>>Next page</a>
            </div>
        </nav>
        </div>
    </body>
    <footer id="footer">
            <p>Camagru born @42 Made with <span class="fas fa-heart"></span> by Yann PETITJEAN</p>
    </footer>
</html>