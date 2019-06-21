<?php require 'User.class.php'?>
<?php include '../partials/navbar.php' ?>
<?php 
if ($userdata)
{
	if ($_GET[action] === "delete")
		{
			if ($user->delete($userdata))
				echo "<script type='text/javascript'> document.location = '/index.php'; </script>";
		}
	?>
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
			<h1 class="title is-1 has-text-centered">Modify Account</h1>
			<div class="container">
			<form action="" name="sign_up" method="POST">
				<div class="field">
				<label class="label">Username</label>
				<div class="control has-icons-left has-icons-right">
					<input class="input" type="text" required name="username" value=<?php echo "'$userdata[username]'" ?> placeholder="Username">
					<span class="icon is-small is-left">
					<i class="fas fa-user"></i>
					</span>
					<span class="icon is-small is-right">
					<i class="fas fa-check"></i>
					</span>
				</div>
				</div>

				<div class="field">
				<label class="label">Email</label>
				<div class="control has-icons-left has-icons-right">
					<input class="input" type="email" required name="email" value=<?php echo "'$userdata[email]'" ?> placeholder="Email">
					<span class="icon is-small is-left">
					<i class="fas fa-envelope"></i>
					</span>
				</div>
				</div>

				<div class="field">
				<label class="label">Old password</label>
				<div class="control has-icons-left has-icons-right">
					<input class="input" type="password" placeholder="Old password" name="oldpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
					<span class="icon is-small is-left">
					<i class="fas fa-lock"></i>
				</div>
				</div>

				<div class="field">
				<label class="label">New password</label>
				<div class="control has-icons-left has-icons-right">
					<input class="input" type="password" placeholder="New password" name="newpassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
					<span class="icon is-small is-left">
					<i class="fas fa-lock"></i>
				</div>
				</div>

				<label class="checkbox">
					<input type="checkbox" name="notification" <?php if ($userdata[notification]) echo "checked" ?>>
					Recevoir des notifications
				</label>
				<br>
				<br>
				<div class="field is-grouped">
				<div class="control">
				<input type="submit" class="button is-success" name="submit" value="OK">
				</div>
				<div class="control">
					<button class="button is-danger" onclick="location.href='/index.php'">Cancel</button>
				</div>
				<div class="control">
					<a class="button is-danger" href = "/user/modif.php?action=delete" onclick="return confirm('Êtes-vous sur de supprimer votre compte ?')">Supprimer mon compte</a>
				</div>
				</div>
				</form>
			</div>
			<?php 
			if ($_POST['submit'] === "OK" && $_POST['username'] && $_POST['email'])
			{
				if (($_POST['oldpassword'] && !$_POST['newpassword']) || (!$_POST['oldpassword'] && $_POST['newpassword']))
				{
					echo "<h3 class='title is-3 has-text-centered'>L'ancien et le nouveau mot de passe sont requis</a></h3>";
					return;
				}
				if ($_POST['oldpassword'] && $_POST['newpassword'])
					$usertomodif = array('session_id' => $userdata[session_id], 'username' => $_POST['username'], 'email' => $_POST['email'], 'oldpassword' => $_POST['oldpassword'], 'newpassword' => $_POST['newpassword'], 'notification' => $_POST['notification']);
				else if (($_POST['oldpassword'] && !$_POST['newpassword']) || (!$_POST['oldpassword'] && $_POST['newpassword']))
				{
					echo "<h3 class='title is-3 has-text-centered'>L'ancien et le nouveau mot de passe sont requis</a></h3>";
					return;
				}
				else
					$usertomodif = array('session_id' => $userdata[session_id], 'username' => $_POST['username'], 'email' => $_POST['email'], 'notification' => $_POST['notification']);
				if ($user->modif($usertomodif))
					echo "<h3 class='title is-3 has-text-centered'>Compte modifié. <a href='/index.php'>Cliquez ici pour revenir sur la page d'accueil</a></h3>";
				else
					echo "<h3 class='title is-3 has-text-centered'>Erreur</h3>";
			}
}
else
	header("Location: ./login.php?message=notloggedin");
?>
    </body>
		
</html>