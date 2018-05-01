<?php
namespace NV\MiniFram;

use Symfony\Component\Yaml\Yaml;

class Config
{
    public function getRoutes()
    {
        return Yaml::parseFile(__DIR__.'/../../../config/routes.yml');
    }


    public function get($key)
    {
        $data = Yaml::parseFile(__DIR__.'/../../../config/config.yml');
        if (isset($data[$key])) {
            return $data[$key];
        }
        throw new \InvalidArgumentException('Parameter '.$key.' does not exists.');
    }
}
