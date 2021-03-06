<?php
require '../user/User.class.php';
require '../partials/helper.php';
include '../partials/navbar.php';
require_once 'Images.class.php';
if (!$userdata)
	header("Location: ../user/login.php?message=notloggedin");
    $image = new Images;
    if (isset($_POST['Post']) && $_POST['Post'] === 'Post_Picture')
        $image->upload($userdata['id'], $_POST['mask'], $_POST['picture']);
    $allImagesFromCurrentUser = $image->showByUserId($userdata['id']);
    if (isset($_GET['action']) && $_GET['action'] === "delete" && isset($_GET['image_id']))
        $image->delete($userdata['id'], $_GET['image_id']);
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Camagru</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
        <link rel="stylesheet" href="montage.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css">
    </head>
    <body class="bg">
    <div class="container is-fluid">
        <?php
        if (isset($_GET['message']) && $_GET['message'] === "deleted")
            echo "Image supprimée!";
        ?>
        <h1 class="title is-1 has-text-centered">Montage</h1>
        <div class="columns">
            <div class="column is-two-thirds" id="mainblock">
                <div id="upload_field">
                    <p>Importer une image:
                        <input type="file" name="picture" id="image_to_upload" accept="image/png, image/jpeg" />
                        <input type="submit" value="Upload" name="Upload" id="uploadButton" />
                    </p>
                </div>
                <div id="video" hidden>
                    <video id="webcam" autoplay width="600" height="400"></video>
                    <img src="../img/montage/1.png" class="live-mask" id="1" hidden>
                    <div class="buttons">
					    <button id="snap-btn" disabled><span class="fas fa-3x fa-camera"></span></button>
				    </div>
                </div>
                <div class="control flex-row" id="mask-bar">
                    <label class="radio">
                        <input type="radio" name="mask-choice" class="mask-choice" id="1" checked hidden>
                        <img src="../img/montage/1.png" class="mask-icon">
                    </label>
                    <label class="radio">
                        <input type="radio" name="mask-choice" class="mask-choice" id="2" hidden>
                        <img src="../img/montage/2.png" class="mask-icon">
                    </label>
                    <label class="radio">
                        <input type="radio" name="mask-choice" class="mask-choice" id="3" hidden>
                        <img src="../img/montage/3.png" class="mask-icon">
                    </label>
                    <label class="radio">
                        <input type="radio" name="mask-choice" class="mask-choice" id="4" hidden>
                        <img src="../img/montage/4.png" class="mask-icon">
                    </label>
                    <label class="radio">
                        <input type="radio" name="mask-choice" class="mask-choice" id="5" hidden>
                        <img src="../img/montage/5.png" class="mask-icon">
                    </label>
                </div>
                <div class="output">
                    <canvas hidden id="canvas"></canvas>
                    <img hidden id="photo" alt="photo">
                    <img hidden class="live-mask" id="1">
                </div>
                <form action="" name="upload_image" method="post" enctype="multipart/form-data">
                <input hidden type="hidden" name="picture" id="image_to_post" />
                <input hidden type="text" name="mask" id="maskChoice" value="1" />
                <div class="buttons">
                    <button type="submit" id="postButton" hidden name="Post" value="Post_Picture">Post</button>
				</div>
                </form>
                <br><br>
            </div>
            <div class="column is-offset-1" id="side-bar">
                <?php
                    foreach ($allImagesFromCurrentUser as $image)
                    {
                        echo "<div class='singleImage'>";
                            echo "<img src='$image[path]' class='shotImages' >";
                            echo "<a href='/montage?action=delete&image_id=$image[image_id]' class='button is-danger deleteButton'>Delete</a>";
                        echo "</div>";
                    }
                ?>
            </div>
        </div>
    </div>

    </body>
    <footer id="footer">
            <p>Camagru born @42 Made with <span class="fas fa-heart"></span> by Yann PETITJEAN</p>
    </footer>
        <script src="montage.js"></script>
</html>
