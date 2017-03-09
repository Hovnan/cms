<?php

class App
{
    protected $controller = 'EmployeeController';

    protected $method = 'actionIndex';

    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();
        $controller = ucfirst($url[0]) . 'Controller';
        if(file_exists(ROOT . '/controllers/'.$controller.'.php')){
            $this->controller = $controller;
            unset($url[0]);
        }
        $this->controller = new $this->controller;

        if(isset($url[1]))
        {
            $method = 'action' . ucfirst($url[1]);
            if(method_exists($this->controller, $method))
            {
                $this->method = $method;
                unset($url[1]);
            }
        }
        $this->params = $url? array_values($url): [];
        
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl ()
    {
        if(isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}