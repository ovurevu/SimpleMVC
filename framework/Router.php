<?php
namespace App\Framework;

class Router {
    //initialize empty arrays for get and post routes
    protected array $routes = [
        'GET' => [],
        'POST' => []
    ];

    //use this method to populate the GET routes with key as uri and value as controller
    public function get($uri, $controller){
        $this->routes['GET'][$uri] = $controller;
    }

    //same thing for post
    public function post($uri, $controller){
        $this->routes['POST'][$uri] = $controller;
    }

    //if the request type is POST, search in routes['POST'] or vice versa for GET and return the controller
    public function direct($uri, $request_type){
        if(array_key_exists($uri, $this->routes[$request_type])){
            $controllerMethod = [];
            $controllerMethod = explode('@', $this->routes[$request_type][$uri]);
            $controller = 'App\\Controllers\\'.$controllerMethod[0];
            $controller = new $controller;
            $method = $controllerMethod[1];
            $controller->$method();
        } else {
            throw new Exception('No routes defined for this URL');
        }
    }
}