<?php
namespace NV\MiniFram;

abstract class Controller extends ApplicationComponent
{
    protected $module;
    protected $action;
    protected $manager;

    public function __construct($app, $action, $module)
    {
        parent::__construct($app);
        $this->action = $action;
        $this->module = $module;
        $this->manager = new Manager($app);
    }

    public function render($view, array $vars = array())
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__.'/../../../src/'.$this->app->getName().'/Views');
        $twig = new \Twig_Environment($loader, array('debug' => true));
        $twig->addExtension(new \Twig_Extension_Debug());
        return $twig->render($view, $vars);
    }

    public function execute()
    {
        $method = 'execute'.ucfirst($this->action);
        if (!is_callable([$this, $method])) {
            throw new \RuntimeException('the method \''. $method.'\' does not exists in  '.ucfirst($this->module).'Controller.');
        }
        return $this->$method($this->app->getRequest());
    }
}
