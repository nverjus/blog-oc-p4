<?php
namespace NV\MiniFram\Validator;

class CSRFValidator extends Validator
{
    public function isValid($value)
    {
        $csrf = $_SESSION['csrf'];
        unset($_SESSION['csrf']);
        return $value == $csrf;
    }
}
