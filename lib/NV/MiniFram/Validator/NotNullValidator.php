<?php
namespace NV\MiniFram\Validator;

class NotNullValidator extends Validator
{
    public function isValid($value)
    {
        return $value != '';
    }
}
