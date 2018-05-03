<?php
namespace NV\MiniFram;

class User extends Entity
{
    protected $name;
    protected $password;
    protected $passwordConfirmation;
    protected $clearPassword;
    protected $role;
    private $session;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->session = new Session;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        if (is_string($name)) {
            $this->name = $name;
            return $this;
        }
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        if (is_string($password)) {
            $this->password = $password;
        }
    }

    public function getPasswordConfirmation()
    {
        return $this->passwordConfirmation;
    }

    public function setPasswordConfirmation($passwordConfirmation)
    {
        if (is_string($passwordConfirmation)) {
            $this->passwordConfirmation = $passwordConfirmation;
        }
    }

    public function getClearPassword()
    {
        return $this->clearPassword;
    }

    public function setClearPassword($clearPassword)
    {
        if (is_string($clearPassword)) {
            $this->clearPassword = $clearPassword;
        }
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        if ($role == 'admin' || $role = 'member') {
            $this->role = $role;
        }
    }

    public function hashPassword()
    {
        if (empty($this->password)) {
            throw new \InvalidArgumentException('Password has to be set before hash');
        }
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function verifyPassword()
    {
        if (empty($this->password)) {
            throw new \InvalidArgumentException('Password has to be set before verification');
        }

        if (empty($this->clearPassword)) {
            throw new \InvalidArgumentException('Clear password has to be set before verification');
        }

        $result = password_verify($this->clearPassword, $this->password);
        $this->clearPassword = null;
        return $result;
    }

    public function passwordMatch()
    {
        return $this->password == $this->passwordConfirmation;
    }

    public function connect()
    {
        $this->session->setUser($this);
    }
}
