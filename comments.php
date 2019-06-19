<?php
require_once 'like_comments/Comments.class.php';
require_once './user/User.class.php';
$user = new User();
$userdata = $user->userSignedIn($_SESSION['session_id']);
if (!$_GET[id])
    header("Location: ./galerie.php");
$image_id = intval($_GET[id]);
$comments_class = new Comments;
if ($_POST[submit] === "Poster" && $userdata)
{
    $comments_class->addComment($_POST[content], $_POST[image_id], $userdata[id], $userdata[username]);
}
$comments = $comments_class->showComments($image_id);
// print_r($comments); // la liste de tout les commentaires est gérée en back, il faut l'afficher joliement en front maintenant
?>
        <div class="container is-fluid">
        <table>
        <?php
        foreach($comments as $comment) {
            $comment[username] = strip_tags($comment[username]);
            $comment[comment] = strip_tags($comment[comment]);
            echo "<tr>";
            echo "<td><b>{$comment[username]}:</b> {$comment[comment]}<br></td>";
            echo "</tr>";
        } 
        ?>
        </table>