<?php
    Class Comments
    {
        private $base;

        function __construct()
        {
            session_start();
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
        function send_mail($email, $subject, $message)
        {
            $message = wordwrap($message, 70, "\n");
            $headers = 'From: camagru@42.fr' . "\r\n" .
                    'Reply-To: camagru@42.fr' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
            mail($email, $subject, $message, $headers);
        }

        function commentNotification($image_id, $username_who_comment, $content)
        {
            $sql = "SELECT user.email as `email`, user.username as `username`, user.notification as `notification` 
            FROM user
            INNER JOIN images
            WHERE images.user_id = user.id
            AND images.id = ?";
            $retour = $this->base->prepare($sql);
            $retour->execute(array($image_id));
            $user = $retour->fetch();
            echo "Ok";
            $message = "Bonjour $user[username]!\nTu est populaire, $username_who_comment vient de commenter le montage numero $image_id.\n Son commentaire est :\n$content\n";
            if ($user[notification])
                $this->send_mail($user[email], "Nouveau commentaire de $username_who_comment sur Camagru!", $message);
        }

        function addComment($content, $image_id, $user_id, $username_who_comment)
        {
            $sql = "INSERT INTO `comments` (`comment`, `user_id`, `image_id`) VALUES (?, ?, ?);";
            $this->base->prepare($sql)->execute(array($content, $user_id, $image_id));
            $this->commentNotification($image_id, $username_who_comment, $content);
        }

        function showComments($image_id)
        {
            $sql = "SELECT user.username as 'username', comment, creation_date FROM comments, user WHERE image_id = ? AND user_id = user.id;";
            $retour = ($this->base->prepare($sql));
            $retour->execute(array($image_id));
            $comments = [];
            while($data = $retour->fetch())
                array_push($comments, $data);
            return ($comments);
        }

    }
?>