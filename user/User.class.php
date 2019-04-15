<?php
    Class User {
        public $base;
        function __construct()
        {
            echo "test mysql dans classe<br>" ;
            try {
                $base = new PDO('mysql:host=localhost; dbname=camagru', 'root', '424242');
            }
            catch(exception $e) {
                die('Erreur '.$e->getMessage());
              }
              $base->exec("SET CHARACTER SET utf8");
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
            // $base = null;
        }

        function create()
        {
            echo "je suis iciii";
            echo "LA";

            $base = new PDO('mysql:host=localhost; dbname=camagru', 'root', '424242');
            echo $base;
            $retour = $base->query('SELECT * FROM user');
            print_r($retour);
            while ($data = $retour->fetch()){
                echo $data['username'].' '.$data['email'].' '.$data['password']."\n";
              }
        }
    }
?>