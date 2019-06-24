<?php require 'User.class.php'?>
<?php require '../partials/helper.php'?>
<?php include '../partials/navbar.php'?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Camagru</title>
        <!-- <link rel="stylesheet" href="main.css"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
        <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    </head>
    <body>
		<h1 class="title is-1 has-text-centered">Sign up</h1>
		<div class="container">
		<form action="" name="sign_up" method="POST">
			<div class="field">
			<label class="label">Username</label>
			<div class="control has-icons-left has-icons-right">
				<input class="input" type="text" name="username" required placeholder="Username">
				<span class="icon is-small is-left">
				<i class="fas fa-user"></i>
				</span>
			</div>
			</div>

			<div class="field">
			<label class="label">Email</label>
			<div class="control has-icons-left has-icons-right">
				<input class="input" type="email" name="email" required placeholder="Email">
				<span class="icon is-small is-left">
				<i class="fas fa-envelope"></i>
				</span>
			</div>
			</div>

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
			<div class="control">
				<button class="button is-danger" onclick="location.href='/index.php'"> Cancel</button>
			</div>
			</div>
			</form>
		</div>
		<?php
		if ($_POST['submit'] === "OK" && $_POST['username'] && $_POST['password'] && $_POST['email'])
		{
			$newuser = array($_POST['username'], $_POST['email'], $_POST['password']);
			if ($user->create($newuser))
				echo "<h3 class='title is-3 has-text-centered'>Validez votre email puis <a href='/user/login.php'>Cliquez ici pour vous connecter</a></h3>";
			else
				echo "<h3 class='title is-3 has-text-centered'>Ce compte existe déjà</h3>";
		}
		?>
    </body>
</html>