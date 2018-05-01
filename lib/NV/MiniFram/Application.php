<?php

namespace NV\MiniFram;

abstract class Application
{
    protected $request;
    protected $response;
    protected $name;
    protected $config;
    protected $twig;
    protected $session;

    public function __construct()
    {
        $this->request = new Request;
        $this->response = new Response;
        $this->config = new Config;
        $loader = new \Twig_Loader_Filesystem(__DIR__.'/../../../src/'.$this->name.'/Views');
        $this->twig = new \Twig_Environment($loader);
        $this->session = new Session;
    }

    public function getController()
    {
        $router = new Router;
        $routes = $this->config->getRoutes();

        foreach ($routes as $route) {
            $router->addRoute(new Route($route));
        }

        try {
            $route = $router->getRoute($this->request->requestURI());
        } catch (\RuntimeException $e) {
            if ($e->getCode() == Router::NO_ROUTE) {
                $this->response->redirect404();
            }
        }

        $route = $router->getRoute($this->request->requestURI());

        $controllerClass  = $this->name.'\\Controller\\'.ucfirst($route->getModule().'Controller');

        if (class_exists($controllerClass)) {
            $_GET = array_merge($_GET, $route->getVars());
            $controller = new $controllerClass($this, $route->getAction(), $route->getModule());
            return $controller;
        }
        throw new \RuntimeException('The requested controller \''.$controllerClass.'\' does not exists');
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSession()
    {
        return $this->session;
    }

    abstract public function run();
}
