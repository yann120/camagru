<?php include '../partials/navbar.php' ?>
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
		<div class="container">
			<h1 class="title is-1 has-text-centered">Log In</h1>
			<div class="field">
			<label class="label">Username</label>
			<div class="control has-icons-left has-icons-right">
				<input class="input" type="text" placeholder="Username">
				<span class="icon is-small is-left">
				<i class="fas fa-user"></i>
				</span>
				<span class="icon is-small is-right">
				<i class="fas fa-check"></i>
				</span>

			<div class="field">
			<label class="label">Password</label>
			<div class="control has-icons-left has-icons-right">
				<input class="input" type="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
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
		</div>
    </body>
</html>