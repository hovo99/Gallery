<?php
namespace Core;
use App\Controller;
class App
{
    protected $controller = "HomeController";
    protected $method = "index";
    protected $params = [];
    
    public function __construct()
    {
        $url = $this->splitURL();
        
        if($url[0] != '') {
            if (file_exists("../app/controller/" . strtolower($url[0]) . ".php")) {
                $this->controller = strtolower($url[0]);
                unset($url[0]);
                $className = "\App\Controller\\" . $this->controller ;
                $object = new $className;
                if (isset($url[1])) {
                    if (method_exists($object, $this->method)) {
                        $this->method = $url[1];
                        call_user_func_array([$object, $url[1]], $this->params);
                        unset($url[1]);
                    }
                }
                $this->params = array_values($url);
            }
        }
        else {
            $className = "\App\Controller\\" . $this->controller ;
            $object = new $className;
            if (method_exists($object, $this->method)) {
                call_user_func_array([$object, $this->method], $this->params);
            }
        }
    }
    
    private function splitURL()
        {
            return explode("/",filter_var(trim(strtok($_SERVER['REQUEST_URI'], '?'), "/"), FILTER_SANITIZE_URL));
        }
}