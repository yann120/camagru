<?php
    Class Comments
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

        function showComments($image_id)
        {
            $sql = "SELECT * FROM comments, user WHERE image_id = '$image_id' AND user_id = user.id;";
            $retour = ($this->base->query($sql));
            $comments = [];
            while($data = $retour->fetch())
                array_push($comments, $data);
            return ($comments);
        }
    }
?>