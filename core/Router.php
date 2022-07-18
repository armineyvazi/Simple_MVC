<?php

namespace app\core;

class Router
{

    protected array $routes = [];
    public Response $response;
    public Request $request;
    /**
     * Router constructor
     * @param Response $response
     * @param Request $request
     */

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
    /**
     *
     * @param void
     *
     */
    public function get($path, $callback):void
    {
        $this->routes['get'][$path] = $callback;
    }
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }
    /**
     * @param string $path info
     *
     * @return mixed
     */
    public function resolve():mixed
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false)
        {

            $this->response->setStatusCode(404);
            return views('error.404');

        }
        if (is_string(($callback))) {

            return views($callback);

        }
        elseif (is_array($callback))
        {
           $callback[0] = new $callback[0];
        }

        return  call_user_func($callback,$this->request);
    }

}
