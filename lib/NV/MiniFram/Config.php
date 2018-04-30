<?php
namespace NV\MiniFram;

use Symfony\Component\Yaml\Yaml;

class Config extends ApplicationComponent
{
    public function getRoutes()
    {
        return Yaml::parseFile(__DIR__.'/../../../config/routes.yml');
    }
}
