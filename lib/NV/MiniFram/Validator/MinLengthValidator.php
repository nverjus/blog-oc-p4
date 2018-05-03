<?php
namespace NV\MiniFram\Validator;

class MinLengthValidator extends Validator
{
    protected $mexLength;

    public function __construct($errorMessage, $minLength)
    {
        parent::__construct($errorMessage);
        $this->setminLength($minLength);
    }

    public function isValid($value)
    {
        return strlen($value) >= $this->minLength;
    }

    public function getminlength()
    {
        return $this->minLength;
    }

    public function setminLength($minLength)
    {
        $minLength = (int) $minLength;
        if ($minLength <= 0) {
            throw new \InvalidArgumentException('minLength must be an integer greater than zero');
        }
        $this->minLength = $minLength;
    }
}
