<?php require 'User.class.php'?>
<?php include '../partials/navbar.php' ?>
<?php
if(isset($_GET['message']) && $_GET['message'] === "notloggedin")
{
		echo "<article class='message is-danger'>
		<div class='message-header'>
			<p>Page réservée</p>
		</div>
		<div class='message-body'>
			L'accès à cette page est réservée aux utilisateurs inscrits. Merci de vous connecter pour y accéder.
		</div>
	</article>";
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
    </head>
    <body>
		<div class="container">
			<h1 class="title is-1 has-text-centered">Log In</h1>
			<form action="" name="login" method="POST">
			<div class="field">
			<label class="label">Username</label>
			<div class="control has-icons-left has-icons-right">
				<input class="input" type="text" name ="username"  required placeholder="Username">
				<span class="icon is-small is-left">
				<i class="fas fa-user"></i>
				</span>
				<span class="icon is-small is-right">
				<i class="fas fa-check"></i>
				</span>

			<div class="field">
			<label class="label">Password</label>
			<div class="control has-icons-left has-icons-right">
				<input class="input" type="password" placeholder="Password" required name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
				<span class="icon is-small is-left">
				<i class="fas fa-lock"></i>
			</div>
			</div>

			<div class="field is-grouped">
			<div class="control">
			<input type="submit" class="button is-success" name="submit" value="OK">
			</div>
			</form>

			<div class="control">
					<a class="button is-warning" href = "/user/reset_password.php">Mot de passe oublié</a>
				</div>
			</div>
		</div>
		<?php
		if (isset($_POST['submit']) && $_POST['submit'] === "OK" && isset($_POST['username']) && isset($_POST['password']))
		{
			$usertologin = array($_POST['username'], $_POST['password']);
			if ($user->login($usertologin))
				echo "<script type='text/javascript'> document.location = '/index.php'; </script>";
			else
				echo "<h3 class='title is-3 has-text-centered'>Compte inexistant ou non vérifié</h3>";
		}
		?>
    </body>
</html>
