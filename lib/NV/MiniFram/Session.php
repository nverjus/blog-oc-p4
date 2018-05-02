<?php
namespace NV\MiniFram;

class Session
{
    public function getAttribute($attr)
    {
        return $_SESSION[$attr] ?? null;
    }

    public function attributeExists($attr)
    {
        return isset($_SESSION[$attr]);
    }

    public function setAttribute($attr, $var)
    {
        $_SESSION[$attr] = $var;
    }

    public function deleteAttribute($attr)
    {
        if ($this->attributeExists($attr)) {
            unset($_SESSION[$attr]);
        }
    }

    public function setFlash($var)
    {
        $this->setAttribute('flash', $var);
    }

    public function getFlash()
    {
        if (!isset($_SESSION['flash'])) {
            return null;
        }
        $flash = $this->getAttribute('flash');
        $this->deleteAttribute('flash');
        return $flash;
    }

    public function getUser()
    {
        return $this->getAttribute('user');
    }

    public function setUser($user)
    {
        $data = [
          'name' => $user->getName(),
          'role' => $user->getRole(),
          'id' => $user->getId(),
        ];
        $this->setAttribute('user', $data);
    }


    public function userHasRole($role)
    {
        if ($this->attributeExists('user')) {
            if (($this->getUser()['role'] == $role) || ($this->getUser()['role'] == 'admin')) {
                return true;
            }
        }
        return false;
    }
}
