<?php
namespace Blog\Entity;

use NV\MiniFram\Mail;

class ContactMail extends Mail
{
    protected $name;
    protected $email;

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

    public function createBody()
    {
        return 'Nouveau message de '.$this->name.'
                Email : '.$this->email.'
                Message : '.$this->content;
    }
}
