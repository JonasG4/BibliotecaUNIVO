<?php

class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();
        if(isset($url[0]) && file_exists('../app/Controllers/' . ucwords($url[0]. 'Controller.php'))){
            $this->currentController = ucwords($url[0]) . "Controller";
            unset($url[0]);
        }
    
    require_once '../app/Controllers/' . $this->currentController . '.php';


    
    $this->currentController = new $this->currentController;
    
    if(isset($url[1])){
        if(method_exists($this->currentController, $url[1])){
            $this->currentMethod = $url[1];
            unset($url[1]);
        }
    }
    
    $this->params = $url ? array_values($url) : [];
    
    if(method_exists($this->currentController, $this->currentMethod)){
        call_user_func([$this->currentController, $this->currentMethod], $this->params);
    }else{
        require_once approot . '/Views/Errors/404.php';
    }
    
    }

    //Limpiar la URL
    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }   
}