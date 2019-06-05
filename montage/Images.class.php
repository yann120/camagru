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

        private function montage($file, $mask_id)
        {
            $picture = imagecreatefrompng($file);
            $mask_file = "../img/montage/".$mask_id.".png";
            $mask = imagecreatefrompng($mask_file);

            $width_picture = imagesx($picture);
            $height_picture = imagesy($picture);
            $width_mask = imagesx($mask);
            $height_mask = imagesy($mask);

            echo "width_picture".$width_picture." ";
            echo "height_picture".$height_picture." ";
            echo "width_mask".$width_mask." ";
            echo "height_mask".$height_mask." ";

            $destination_x = $width_mask - $width_picture;
            echo "destination_x".$destination_x." ";
            $destination_y = $height_mask - $height_picture;
            echo "destination_y".$destination_y;
            $pictureresized = imagecreatetruecolor($width_mask, $height_mask);
            imagecopyresized($pictureresized, $picture, 0, 0, 0, 0, $width_mask, $height_mask, $width_picture, $height_picture);
            imagecopy($pictureresized, $mask, 0, 0, 0, 0, $width_picture, $height_picture);
            // imagecopy($mask, $picture, 0, 0, 0, 0, 600, 337.5);
            // voir imagecopyresize
            // imagecopyresized($picture, $mask, 0, 0, 0, 0, $width_mask, $height_mask, $width_picture, $height_picture);
            // imagecopy($picture, $mask, $destination_x, $destination_y, 0, 0, $width_picture, $height_picture);
            return($pictureresized);

        }

        function upload($user_id, $mask_id, $picture)
        {
            $folderPath = "../public/tmp/".$user_id."/";
            mkdir($folderPath, 0777, true);
            $filename = "tmppicture";
            $image_parts = explode(";base64,", $picture);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath.$filename.".png";
            file_put_contents($file, $image_base64);
            $picture = $this->montage($file, $mask_id);
            // TODO: delete temp picture
            $folderPath = "../public/".$user_id."/";
            mkdir($folderPath, 0777, true);
            $filename = uniqid();
            $file = $folderPath.$filename.".jpg";
            if (imagejpeg($picture, $file))
            {
                echo "Transfert réussi";
                $this->storeImageToDB($file, $user_id);
            }
            else
            {
                echo "Echec du transfert";
                return (false);
            }



            // if ($_FILES['picture']['error'] > 0)
            //     echo "Erreur de transfert";
            // $valid_extensions = array('jpg', 'jpeg', 'png');
            // $extension_upload = strtolower(  substr(  strrchr($_FILES['picture']['name'], '.')  ,1)  );
            // if (!in_array($extension_upload,$valid_extensions))
            //     echo "Extension incorrecte. Seul les images jpg, jpeg et PNG sont autorises";
            // $filename = uniqid();
            // $directory = "../public/";
            // mkdir($directory.$user_id, 0777, true);
            // $file = "/public/".$user_id."/".$filename.".".$extension_upload;
            // echo $file."\n";
            // $resultat = move_uploaded_file($_FILES['picture']['tmp_name'], "..".$file);
            // echo $_FILES['picture']['tmp_name']."\n";
            // if ($resultat)
            // {
            //     echo "Transfert réussi";
            //     $this->storeImageToDB($file, $user_id);
            // }
            // else
            // {
            //     echo "Echec du transfert";
            //     return (false);
            // }
        }
        
        private function numberOfImages()
        {
            $sql = "SELECT COUNT(*) as `nb_images` FROM `images`";
            $retour = $this->base->query($sql);
            $data = $retour->fetch();
            return (intval($data[nb_images]));
        }

        function storeImageToDB($path, $user_id)
        {
            $sql = "INSERT INTO images (user_id, path) VALUES ('$user_id','$path')";
            $this->base->prepare($sql)->execute();
        }
        private function maxPage()
        {
            $nb_images = $this->numberOfImages();
            $limit = 5;
            $max_page = $nb_images / $limit;
            return (ceil($max_page));
        }

        function newPage($direction, $page)
        {
            $max_page = intval($this->maxPage());
            if ($direction == 1)
                $page = $page - 1;
            else
                $page = $page + 1;
            if ($page < 0 || $page >= $max_page)
                echo "disabled";
            else
                echo "href='/galerie.php?page=$page'";
        }

        function showAll($page_number)
        {
            $limit = 5;
            $offset = $page_number * $limit;
            $sql = "SELECT images.user_id, images.path, images.creation_date, user.username, user.email, images.id AS image_id FROM images, user WHERE images.user_id = user.id ORDER BY images.creation_date DESC LIMIT $limit OFFSET $offset";
            $retour = $this->base->query($sql);
            $allpictures = [];
            while ($data = $retour->fetch())
                array_push($allpictures, $data);
            // print_r($allpictures);
            return ($allpictures);
        }
    }
?>