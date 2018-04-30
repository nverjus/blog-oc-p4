<?php
namespace NV\MiniFram;

class Route
{
    protected $url;
    protected $module;
    protected $action;
    protected $varsNames;
    protected $vars = [];

    use Hydrator;

    public function __construct($data)
    {
        $this->hydrate($data);
    }

    public function hasVars()
    {
        return !empty($this->varsNames);
    }

    public function match($url)
    {
        if (preg_match('#^'.$this->url.'$#', $url, $matches)) {
            return $matches;
        }

        return false;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        if (is_string($url)) {
            $this->url = $url;
        }
    }

    public function getModule()
    {
        return $this->module;
    }

    public function setmodule($module)
    {
        if (is_string($module)) {
            $this->module = $module;
        }
    }

    public function getAction()
    {
        return $this->action;
    }

    public function setAction($action)
    {
        if (is_string($action)) {
            $this->action = $action;
        }
    }

    public function getVarsNames()
    {
        return $this->varsNames;
    }

    public function setVarsNames(array $varsNames)
    {
        $this->varsNames = $varsNames;
    }

    public function getVars()
    {
        return $this->vars;
    }

    public function setVars(array $vars)
    {
        $this->vars = $vars;
    }
}
