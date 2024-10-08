<?php

class Router {
  protected $routes = [];
  protected $requires = [];
  protected $controllers = [];
  protected $functions = [];

  public function addRoute($route, $filename, $function) {
    $this->routes[$route] = [
      'file' => './app/controllers/' . $filename . '.controller.php',
      'controller' => $filename . 'Controller',
      'function' => $function
    ];
  }

  public function route($action = null) {
    $params = $this->parseParams($action);

    $foundResult = false;
    foreach ($this->routes as $route => $config) {
      $paramValues = $this->matchParams($route, $params);

      if ($paramValues !== false) {
        require $config['file'];
        $controller = new $config['controller'];
        $function = $config['function'];

        $controller->$function($paramValues);
        $foundResult = true;
      }
    }
  }

  public function parseParams($action) {
    return explode('/', trim($action, '/'));
  }

  public function matchParams($route, $params) {
    $routeParts = $this->parseParams($route);

    if (count($routeParts) !== count($params)) {
      return false;
    }

    $paramValues = [];
    foreach ($routeParts as $index => $part) {
      if ($part[0] == ':') $paramValues[substr($part, 1)] = $params[$index];
      elseif ($part !== $params[$index]) return false;
    }

    return $paramValues;
  }
}