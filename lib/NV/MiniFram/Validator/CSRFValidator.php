<?php
namespace NV\MiniFram\Validator;

use NV\MiniFram\Session;

class CSRFValidator extends Validator
{
    protected $session;

    public function __construct($errorMessage)
    {
        parent::__construct($errorMessage);
        $this->session = new Session;
    }

    public function isValid($value)
    {
        $csrf = $this->session->getAttribute('csrf');
        $this->session->deleteAttribute('csrf');
        return $value == $csrf;
    }
}
