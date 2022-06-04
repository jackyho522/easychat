<?php

/**
 app file
 */
/**
 most important stuff
 */
class App
{
    protected $params = [];
    protected $controller = "home";
    protected $method = "index";
    /* the function name in controllers is index() */
    /* call index() function */
    public function __construct()
    {
        $URL = $this->getURL();
        if (file_exists("../private/controllers/" . ucfirst($URL[0]) . "Controller" . ".php")) {
            $this->controller = ucfirst($URL[0]);
            unset($URL[0]);
        } else {
            $this->controller = "WrongPage";
        }
        require_once "../private/controllers/" . $this->controller . "Controller" . ".php";
        $this->controller = new $this->controller();

        if (isset($URL[1])) {
            if (method_exists($this->controller, $URL[1])) {
                $this->method = ucfirst($URL[1]);
                unset($URL[1]);
            }
        }
        $this->params = $URL ? array_values($URL) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function getURL()
    {
        //just some basic filter url security
        $url = isset($_GET['url']) ? $_GET['url'] : "home";
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return explode('/', $url);
    }
}
