<?php
// Page des routes
require '../Core/Router.class.php';

$router = new Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('posts/new', ['controller' => 'Posts', 'action' => 'new']);
    
// Display the routing table
echo '<pre>';
var_dump($router->getRoutes());
echo '</pre>';


// match les routes et utilise les parametres
$url = $_SERVER['QUERY_STRING'];

if ($router->match($url)) {
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
} else {
    echo "404 ERROR : No route found for URL '$url'";
}
?>