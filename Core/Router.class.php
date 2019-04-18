<?php
class Router
{
	//array contenant les routes
    protected $routes = [];

	//liste des parametres recu
    protected $params = [];

	//ajout d'une route
    public function add($route, $params)
    {
        $this->routes[$route] = $params;
    }

    //retourne l'array de routes
    public function getRoutes()
    {
        return $this->routes;
    }

	// check si une route existe, si oui  on utilise le parametre et retourne true
	//, sinon false si on a pas de route correspondante
    public function match($url)
    {
        foreach ($this->routes as $route => $params) {
            if ($url == $route) {
                $this->params = $params;
                return true;
            }
        }

        return false;
    }

	// on retourne les parametres de la page
    public function getParams()
    {
        return $this->params;
    }
}
?>