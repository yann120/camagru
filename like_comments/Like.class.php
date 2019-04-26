<?php
    Class Like
    {   
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

        function isLiked($user_id, $image_id)
        {
            $sql = "SELECT id FROM images_like WHERE user_id = '$user_id' AND image_id = '$image_id';";
            $retour = ($this->base->query($sql));
            if ($retour->fetch())
            {
                return("has-background-link has-text-white");
            }
            else
                return (false);
        }
        function likeUnlike($user_id, $image_id)
        {
            if ($this->isLiked($user_id, $image_id))
            {
                $sql = "DELETE FROM `images_like` WHERE user_id = '$user_id' AND image_id = '$image_id'";
                $this->base->prepare($sql)->execute();
            }
            else
            {
                $sql = "INSERT INTO `images_like` (`id`, `user_id`, `image_id`) VALUES (NULL, '$user_id', '$image_id');";
                $this->base->prepare($sql)->execute();
            }
        }
    }
?>