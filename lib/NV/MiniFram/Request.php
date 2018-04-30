<?php
namespace NV\MiniFram;

class Request extends ApplicationComponent
{
    public function requestURI()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getData($var)
    {
        return htmlspecialchars($_GET[$var]) ?? null;
    }

    public function getExists($var)
    {
        return isset($_GET[$var]);
    }

    public function postData($var)
    {
        return htmlspecialchars($_POST[$var] ?? null);
    }

    public function postExists($var)
    {
        return isset($_POST[$var]);
    }

    public function fileData($var)
    {
        return $_FILES[$var] ?? null;
    }

    public function fileExists($var)
    {
        return isset($_FILES[$var]);
    }
}
