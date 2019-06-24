<?php
    Class Like
    {
        private $base;

        function __construct()
        {
            if (!include 'config/database.php')
                include '../config/database.php';
            try {
                $this->base = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
                $this->base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

        function isLiked($user_id, $image_id)
        {
            $sql = "SELECT id FROM images_like WHERE user_id = ? AND image_id = ?;";
            $retour = ($this->base->prepare($sql));
            $retour->execute(array($user_id, $image_id));
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
                $sql = "DELETE FROM `images_like` WHERE user_id = ? AND image_id = ?";
                $this->base->prepare($sql)->execute(array($user_id, $image_id));
            }
            else
            {
                $sql = "INSERT INTO `images_like` (`id`, `user_id`, `image_id`) VALUES (NULL, ?, ?);";
                $this->base->prepare($sql)->execute(array($user_id, $image_id));
            }
        }

        function likeCounter($image_id)
        {
            $sql = "SELECT COUNT(image_id) FROM `images_like` WHERE image_id = ?";
            $query = $this->base->prepare($sql);
            $query->execute(array(strval($image_id)));
            $result = $query->fetch();
            return ($result[0]);
        }
    }
?>