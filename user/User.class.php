<?php
    Class User {
        public $base;
        function __construct()
        {
            // echo "test mysql dans classe<br>" ;
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

        function create()
        {
            $retour = $this->base->query('SELECT * FROM user');
            while ($data = $retour->fetch()){
                echo $data['username'].' '.$data['email'].' '.$data['password']."\n";
              }
        }
    }
?>