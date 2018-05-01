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
        if (isset($_SESSION[$attr])) {
            unset($_SESSION[$attr]);
        }
    }

    public function setFlash($var)
    {
        $_SESSION['flash'] = $var;
    }

    public function getFlash()
    {
        if (!isset($_SESSION['flash'])) {
            return null;
        }
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }


    public function isAuthentified()
    {
        if (isset($_SESSION['auth'])) {
            return $_SESSION['auth'];
        }
        return false;
    }
}
