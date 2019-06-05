<?php 
require '../user/User.class.php';
require '../partials/helper.php';
include '../partials/navbar.php';
require_once 'Images.class.php';
if (!$userdata)
	header("Location: ../user/login.php?message=notloggedin");
    $image = new Images;
    // print_r($_POST);
    if ($_POST['Post'] === 'Post_Picture')
        $image->upload($userdata[id], $_POST[mask], $_POST[picture]);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Camagru</title>
        <!-- <link rel="stylesheet" href="../main.css"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
        <link rel="stylesheet" href="montage.css">
        <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    </head>
    <body>
    <div class="container is-fluid">
        <h1 class="title is-1 has-text-centered">Montage</h1>
        <div class="columns">
            <div class="column is-two-thirds has-background-primary">
                <!-- <form action="" name="upload_image" method="post" enctype="multipart/form-data"> -->
                    <p>Images:
                        <input type="file" name="picture" id="image_to_upload" accept="image/png, image/jpeg" />
                        <!-- <input hidden type="image" name="picture" id="image_to_upload" /> -->
                        <input type="submit" value="Upload" name="Upload" id="uploadButton" />
                    </p>
                <!-- </form> -->
                <div id="video">
                    <video id="webcam" autoplay width="600" height="400"></video>
                    <img src="../img/montage/1.png" class="live-mask" id="1">
                </div>
					<!-- <div id="overlay">
					</div> -->

                <div class="buttons">
					<button id="snap-btn"><span class="fas fa-3x fa-camera"></span></button>
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
                    <!-- <input type="submit" id="postButton" class="fas fa-3x fa-upload" name="upload" /> -->
                    <button type="submit" id="postButton" hidden name="Post" value="Post_Picture">
                        Post
                    </button>
				</div>
                </form>
            </div>
            <div class="column has-background-link is-offset-1">side</div>
        </div>
    </div>
        
    </body>
        <script src="montage.js"></script>
</html>
