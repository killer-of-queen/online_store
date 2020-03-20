<?php


class Router
{
    private $routes;
    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }

    /*
     * Returns request string
     * */
    private function getURI()
    {
        if(!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }



    public function run()
    {
        //получить строку запроса
        $uri = $this->getURI();
        //проверить наличие такого запроса в routes.php
        foreach ($this->routes as $uriPattern => $path) {
            if(preg_match("~$uriPattern~", $uri)) {

                //Получить внутренний путь из внешнего согласно правилу
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                //Получить контроллер, action, параемтры

                $segments = explode('/', $internalRoute);
                $controllerName = ucfirst(array_shift($segments).'Controller');
                $actionName = 'action'.ucfirst(array_shift($segments));
                $parameters = $segments;
                //подключить контроллер
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                if(file_exists($controllerFile)) {
                    include_once($controllerFile);
                }
                //создать объект, вызвать метод
                $controllerObject = new $controllerName;

                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                if ($result != null) {
                    break;
                }
            }
        }
    }
}