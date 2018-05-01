<?php
namespace NV\MiniFram;

abstract class Controller extends ApplicationComponent
{
    protected $manager;
    protected $module;
    protected $action;

    public function __construct($app, $action, $module)
    {
        parent::__construct($app);
        $this->manager = new Manager($this->app);
        $this->action = $action;
        $this->module = $module;
    }

    public function render($view, array $vars = array())
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__.'/../../../src/'.$this->app->getName().'/Views');
        $twig = new \Twig_Environment($loader);
        if ($this->app->getSession()->attributeExists('flash')) {
            $flash = $this->app->getSession()->getAttribute('flash');
            $this->app->getSession()->deleteAttribute('flash');
        } else {
            $flash = null;
        }
        $vars = array_merge($vars, array('flash' => $flash, 'app' => $this->app));

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
