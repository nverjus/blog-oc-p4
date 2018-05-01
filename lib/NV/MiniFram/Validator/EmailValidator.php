<?php
namespace NV\MiniFram\Validator;

class EmailValidator extends Validator
{
    public function isValid($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
