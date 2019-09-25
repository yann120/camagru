<?php
require_once 'like_comments/Comments.class.php';
require_once './user/User.class.php';
$user = new User();
$comments_class = new Comments();
session_start();
$userdata = $user->userSignedIn($_SESSION['session_id']);
if (isset($_POST['submit']) && $_POST['submit'] === "Poster" && isset($userdata))
{
    $comments_class->addComment($_POST['content'], $_POST['image_id'], $userdata['id'], $userdata['username']);
}
if (!isset($_GET['id']))
    header("Location: ./galerie.php");
else
{
$image_id = intval($_GET['id']);
$comments_class = new Comments;

$comments = $comments_class->showComments($image_id);
?>
        <div class="container is-fluid">
        <table>
        <?php
        foreach($comments as $comment) {
            $username = strip_tags($comment['username']);
            $content = strip_tags($comment['comment']);
            echo "<tr>";
            echo "<td><b>{$username}:</b> {$content}<br></td>";
            echo "</tr>";
        }
        ?>
        </table>
<?php } ?>