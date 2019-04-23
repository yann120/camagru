<?php
    Class User {
        private $base;

        function __construct()
        {
            session_start();
            try {
                $this->base = new PDO('mysql:host=localhost; dbname=camagru', 'root', '424242');
            }
            catch(exception $e) {
                die('Erreur '.$e->getMessage());
              }
              $this->base->exec("SET CHARACTER SET utf8");
              
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

        function displayUser($session_id)
        {
            $retour = $this->base->query("SELECT * FROM user WHERE session_id = '$session_id'");
            while ($data = $retour->fetch()){
                echo $data['username'].' '.$data['email'].' '.$data['password']."<br>";
              }
        }


        function create($newuser)
        {
            $newuser[2] = hash("whirlpool", $newuser[2]);
            $retour = $this->base->query("SELECT * FROM user WHERE username = '$newuser[0]' OR email = '$newuser[1]'");
            if ($retour->fetch())
                return (false);
            $sql = "INSERT INTO user (username, email, password) VALUES (?,?,?)";
            $this->base->prepare($sql)->execute($newuser);
            return (true);
        }

        function modif($newuser)
        {
            if ($newuser['oldpassword'] && $newuser['newpassword'])
            {
                $newuser['oldpassword'] = hash("whirlpool", $newuser['oldpassword']);
                $newuser['newpassword'] = hash("whirlpool", $newuser['newpassword']);
                $retour = $this->base->query("SELECT password FROM user WHERE username = '$newuser[username]'");
                $data = $retour->fetch();
                if ($data)
                {
                    if ($data[password] === $newuser[oldpassword])
                        $sql = "UPDATE user SET username = '$newuser[username]', email = '$newuser[email]', password = '$newuser[newpassword]' WHERE session_id = '$newuser[session_id]'";
                        else
                            return (false);
                }
            }
            else
                $sql = "UPDATE user SET username = '$newuser[username]', email = '$newuser[email]' WHERE session_id = '$newuser[session_id]'";
            // verifie si le user ou l'email existe deja mais on est peut etre pas obligé de l'implémenter
            // $retour = $this->base->query("SELECT * FROM user WHERE username = '$newuser['username']' OR email = '$newuser['email']'");
            // if ($retour->fetch())
            //     return (false);
            echo $sql;
            $this->base->prepare($sql)->execute($newuser);
            return (true);
        }

        function delete($user)
        {
            $sql = "DELETE FROM user WHERE session_id = '$user[session_id]'";
            if ($this->base->prepare($sql)->execute())
                return (true);
        }

        function login($usertologin)
        {
            $usertologin[1] = hash("whirlpool", $usertologin[1]);
            $retour = $this->base->query("SELECT password FROM user WHERE username = '$usertologin[0]'");
            $data = $retour->fetch();
            if ($data)
            {
                if ($data[password] === $usertologin[1])
                {
                    $session_id = uniqid();
                    $_SESSION[session_id] = $session_id;
                    $sql = "UPDATE user SET session_id = '$session_id' WHERE username = '$usertologin[0]'";
                    $this->base->prepare($sql)->execute();
                    return (true);
                }
            }
            return (false);
        }

        function logout($session_id)
        {
            if ($session_id && $this->userSignedIn($session_id))
            {
                echo "la";
                setcookie("session_id", "", time()-3600);
                $sql = "UPDATE user SET session_id = NULL WHERE session_id = '$session_id'";
                $this->base->prepare($sql)->execute();
                return (true);
            }
            return (false);
        }

        function userSignedIn($session_id)
        {
            if ($session_id)
            {
                $retour = $this->base->query("SELECT * FROM user WHERE session_id = '$session_id'");
                $user = $retour->fetch();
                if ($user)
                    return($user);
            }
            return (false);
        }
    }
?>