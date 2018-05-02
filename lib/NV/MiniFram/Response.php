<?php
namespace NV\MiniFram;

class Response extends ApplicationComponent
{
    public function redirect404()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__.'/../../../src/'.$this->app->getName().'/Views');
        $twig = new \Twig_Environment($loader);
        header('HTTP/1.0 404 Not Found');
        exit($twig->render('404.html.twig'));
    }

    public function redirect(string $uri)
    {
        header('Location: '.$uri);
        exit;
    }

    public function send($response)
    {
        exit($response);
    }
}
