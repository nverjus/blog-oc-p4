<?php
namespace Blog\Entity;

use NV\MiniFram;

class User extends MiniFram\User
{
    protected $email;
    protected $isValidated;

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        if (is_string($email)) {
            $this->email = $email;
        }
    }

    public function getIsValidated()
    {
        return $this->isValidated;
    }

    public function setIsValidated($isValidated)
    {
        if (($isValidated == 0) || $isValidated == false) {
            $this->isValidated = false;
        } elseif (($isValidated == 1) || $isValidated == true) {
            $this->isValidated = true;
        }
        return $this;
    }
}
