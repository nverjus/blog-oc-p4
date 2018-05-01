<?php
namespace NV\MiniFram;

use Symfony\Component\Yaml\Yaml;

class Config
{
    public function getRoutes()
    {
        return Yaml::parseFile(__DIR__.'/../../../config/routes.yml');
    }

    private function readConfigFile()
    {
        return Yaml::parseFile(__DIR__.'/../../../config/config.yml');
    }

    public function getDatabaseInfos()
    {
        $data = $this->readConfigFile();
        return $data['database'];
    }
}
