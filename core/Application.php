<?php

namespace app\core;

class Application{

    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;
    public Database $db;
    public  Controller $controller;
    public Session $session;
    public function __construct($rootPath,array $config)
    {
        self::$ROOT_DIR=$rootPath;
        $this->loadHelper();
        self::$app=$this;
        $this->request=new Request();
        $this->response=new Response();
        $this->session=new Session;
        $this->router=new Router($this->request,$this->response);
        $this->db= new Database($config['db']);
        
    }
    public function getController()
    {
        return $this->controller;
    }
    public function setController($controller):void
    {
         $this->controller=$controller;
    }

    public function loadHelper():void
    {
        foreach(glob(__DIR__.'/Helper/*.php') as $file)

        require $file;
    }
    public function run()
    {
       echo  $this->router->resolve();
    }




}
