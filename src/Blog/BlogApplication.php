<?php
namespace Blog;

use NV\MiniFram\Application;

class BlogApplication extends Application
{
    public function __construct()
    {
        $this->name = 'Blog';
        parent::__construct();
    }

    public function run()
    {
        $response = $this->getController()->execute();

        $this->getResponse()->send($response);
    }
}
