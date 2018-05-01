<?php
namespace Blog\Entity;

use NV\MiniFram\Entity;

class User extends Entity
{
    protected $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        if (is_string($name)) {
            $this->name = $name;
        }
    }
}
