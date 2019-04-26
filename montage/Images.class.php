<?php
    Class Images
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

        function __destruct()
        {
            $this->base = null;
        }
        function upload($user_id)
        {
            echo "user id = ".$user_id;
            if ($_FILES['picture']['error'] > 0)
                echo "Erreur de transfert";
            $valid_extensions = array('jpg', 'jpeg', 'png');
            $extension_upload = strtolower(  substr(  strrchr($_FILES['picture']['name'], '.')  ,1)  );
            if (!in_array($extension_upload,$valid_extensions))
                echo "Extension incorrecte. Seul les images jpg, jpeg et PNG sont autorises";
            $filename = uniqid();
            $directory = "../public/";
            mkdir($directory.$user_id, 0777, true);
            $file = "/public/".$user_id."/".$filename.".".$extension_upload;
            echo $file."\n";
            $resultat = move_uploaded_file($_FILES['picture']['tmp_name'], "..".$file);
            echo $_FILES['picture']['tmp_name']."\n";
            if ($resultat)
            {
                echo "Transfert réussi";
                $this->storeImageToDB($file, $user_id);
            }
            else
            {
                echo "Echec du transfert";
                return (false);
            }
        }
        
        function storeImageToDB($path, $user_id)
        {
            $sql = "INSERT INTO images (user_id, path) VALUES ('$user_id','$path')";
            $this->base->prepare($sql)->execute();
        }

        function showAll()
        {
            $sql = "SELECT images.user_id, images.path, images.creation_date, user.username, user.email, images.id AS image_id FROM images, user WHERE images.user_id = user.id ORDER BY images.creation_date DESC";
            $retour = $this->base->query($sql);
            $allpictures = [];
            while ($data = $retour->fetch())
                array_push($allpictures, $data);
            // print_r($allpictures);
            return ($allpictures);
        }
    }
?>