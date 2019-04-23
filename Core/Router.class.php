<?php
class Router
{
	//array contenant les routes
    protected $routes = [];

	//liste des parametres recu
    protected $params = [];

	//ajout d'une route
    public function add($route, $params = [])
    {
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        // Convert variables e.g. {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        // Convert variables with custom regular expressions e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        // Add start and end delimiters, and case insensitive flag
        $route = '/^' . $route . '$/i';

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
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }

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