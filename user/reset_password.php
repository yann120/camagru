<?php require 'User.class.php'?>
<?php require '../partials/helper.php'?>
<?php include '../partials/navbar.php'?>
<?php
 if (isset($_GET['password_reset']))
 {
     if ($user->resetPasswordRequestP2($_GET['password_reset']))
         $message = "Vous avez recu votre nouveau mot de passe par mail";
     else
         $message = "Lien de reinitialisation erroné";
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
    </head>
    <body>
		<h1 class="title is-1 has-text-centered">Reinitialiser mot de passe</h1>
		<div class="container">
		<form action="" name="sign_up" method="POST">
			<div class="field">
			<label class="label">Email</label>
			<div class="control has-icons-left has-icons-right">
				<input class="input" type="email" name="email" required placeholder="Email">
				<span class="icon is-small is-left">
				<i class="fas fa-envelope"></i>
				</span>
			</div>
			</div>
			<div class="control">
			<input type="submit" class="button is-success" name="submit" value="OK">
				<button class="button is-danger" onclick="location.href='/index.php'"> Cancel</button>
			</div>
			</div>
			</form>
		</div>
		<?php 
		if (isset($_POST['submit']) && $_POST['submit'] === "OK" && isset($_POST['email']))
		{
			$email = $_POST['email'];
			if ($user->resetPasswordRequestP1($email))
				echo "<h3 class='title is-3 has-text-centered'>Validez votre email puis <a href='/user/login.php'>Cliquez ici pour vous connecter</a></h3>";
			else
				echo "<h3 class='title is-3 has-text-centered'>Ce compte n'existe pas</h3>";
        }
        if (isset($message))
            echo "<h3 class='title is-3 has-text-centered'>$message</h3>";
		?>
    </body>
</html>