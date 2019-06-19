<?php
    Class User {
        private $base;

        function __construct()
        {
            if (!include 'config/database.php')
                include '../config/database.php';
            session_start();
            try {
                $this->base = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            }
            catch(exception $e) {
                die('Erreur '.$e->getMessage());
              }
        }

        function __get($attribut)
        {
            if (isset($attribut))
                return ($this->$attribut);
            return (NULL);
        }

        function __set($attribut, $value)
        {
            if (isset($attribut) && isset($value))
                $this->$attribut = $value;
            return;
        }

        function __destruct()
        {
            $this->base = null;
        }

        function create($newuser)
        {
            $newuser[2] = hash("whirlpool", $newuser[2]);
            $newuser[3] = uniqid();
            $retour = $this->base->prepare("SELECT * FROM user WHERE username = ? OR email = ?");
            $retour->execute(array($newuser[0], $newuser[1]));
            if ($retour->fetch())
                return (false);
            $sql = "INSERT INTO user (username, email, password, user_verification) VALUES (?,?,?,?)";
            $this->base->prepare($sql)->execute($newuser);
            send_mail($newuser[1], "Inscription sur Camagru", "Bonjour $newuser[0]!\n Merci pour ton inscription sur Camagru.\n Pour valider ton compte, merci de cliquer sur ce lien : \n http://localhost:8080/index.php?user_verification=$newuser[3] \n A bientôt!\n");
            return (true);
        }

        function user_validation($verification_id)
        {
            if ($verification_id)
            {
                $retour = $this->base->prepare("SELECT * FROM user WHERE user_verification = ?");
                $retour->execute(array($verification_id));
                if (!$retour->fetch())
                    return (false);
                $sql = "UPDATE user SET user_verification = NULL WHERE user_verification = ?";
                $this->base->prepare($sql)->execute(array($verification_id));
                return (true);
            }
        }

        function modif($newuser)
        {
            if ($newuser[notification] == "on")
                $notification = 1;
            else
                $notification = 0;
            if ($newuser['oldpassword'] && $newuser['newpassword'])
            {
                $newuser['oldpassword'] = hash("whirlpool", $newuser['oldpassword']);
                $newuser['newpassword'] = hash("whirlpool", $newuser['newpassword']);
                $retour = $this->base->prepare("SELECT password FROM user WHERE username = ?");
                $retour->execute(array($newuser[username]));
                $data = $retour->fetch();
                if ($data)
                {
                    if ($data[password] === $newuser[oldpassword])
                    {
                        $sql = "UPDATE user SET username = ?, email = ?, password = ?, notification = ? WHERE session_id = ?";
                        $query = $this->base->prepare($sql);
                        $query->execute(array($newuser[username], $newuser[email], $newuser[newpassword], $notification, $newuser[session_id]));
                        return(true);
                    }
                    else
                        return (false);
                }
            }
            else
            {
                $sql = "UPDATE user SET username = ?, email = ?, notification = ? WHERE session_id = ?";
                $query = $this->base->prepare($sql);
                $query->execute(array($newuser[username], $newuser[email], $notification, $newuser[session_id]));
                return (true);
            }
                // verifie si le user ou l'email existe deja mais on est peut etre pas obligé de l'implémenter
            // $retour = $this->base->query("SELECT * FROM user WHERE username = '$newuser['username']' OR email = '$newuser['email']'");
            // if ($retour->fetch())
            //     return (false);
        }

        function delete($user)
        {
            $sql = "DELETE FROM user WHERE session_id = ?";
            if ($this->base->prepare($sql)->execute(array($user[session_id])))
                return (true);
        }

        function login($usertologin)
        {
            $usertologin[1] = hash("whirlpool", $usertologin[1]);
            $retour = $this->base->prepare("SELECT password, user_verification FROM user WHERE username = ?");
            $retour->execute(array($usertologin[0]));
            $data = $retour->fetch();
            if ($data)
            {
                if ($data[password] === $usertologin[1] && !$data[user_verification])
                {
                    $session_id = uniqid();
                    $_SESSION[session_id] = $session_id;
                    $sql = "UPDATE user SET session_id = ? WHERE username = ?";
                    $this->base->prepare($sql)->execute(array($session_id, $usertologin[0]));
                    return (true);
                }
            }
            return (false);
        }

        function logout($session_id)
        {
            if ($session_id && $this->userSignedIn($session_id))
            {
                setcookie("session_id", "", time()-3600);
                $sql = "UPDATE user SET session_id = NULL WHERE session_id = ?";
                $this->base->prepare($sql)->execute(array($session_id));
                return (true);
            }
            return (false);
        }

        function resetPasswordRequestP1($email)
        {
            if ($email)
            {
                $password_reset = uniqid();
                $query = $this->base->prepare("SELECT * FROM user WHERE email = ?");
                $query->execute(array($email));
                if (!$query->fetch())
                    return (false);
                $sql = "UPDATE user SET password_reset = ? WHERE email = ?";
                $this->base->prepare($sql)->execute(array($password_reset, $email));
                send_mail($email, "Reinitialisation du mot de passe Camagru", "Bonjour!\n Nous avons recu une demande de reinitialisation de mot de passe sur Camagru.\n Pour le reinitialiser, merci de cliquer sur ce lien : \n http://localhost:8080/user/reset_password.php?password_reset=$password_reset \n A bientôt!\n");
                return (true);
            }
        }

        function resetPasswordRequestP2($password_reset)
        {
            if ($password_reset)
            {
                $query = $this->base->prepare("SELECT * FROM user WHERE password_reset = ?");
                $query->execute(array($password_reset));
                $result = $query->fetch();
                if (!$result)
                    return (false);
                $newpassword = password_hash(uniqid(), PASSWORD_BCRYPT);
                $encryptedpassword = hash("whirlpool", $newpassword);
                $sql = "UPDATE user SET password_reset = NULL, password = ? WHERE password_reset = ?";
                send_mail($result[email], "Nouveau mot de passe", "Bonjour!\n Nous avons validé votre demande de reinitialisation de mot de passe sur Camagru.\n Votre nouveau mot de passe est $newpassword \n A bientôt!\n");
                $this->base->prepare($sql)->execute(array($encryptedpassword, $password_reset));
                return (true);
            }
        }
        function userSignedIn($session_id)
        {
            if ($session_id)
            {
                $query = $this->base->prepare("SELECT * FROM user WHERE session_id = ?");
                $query->execute(array($session_id));
                $user = $query->fetch();
                if ($user)
                    return($user);
            }
            return (false);
        }
    }
?>