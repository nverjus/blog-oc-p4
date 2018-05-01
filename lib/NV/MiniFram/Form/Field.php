<?php
namespace NV\MiniFram\Form;

use NV\MiniFram\Hydrator;
use NV\MiniFram\Validator\Validator;

abstract class Field
{
    use Hydrator;

    protected $errorMessage;
    protected $label;
    protected $name;
    protected $value;
    protected $validators = [];

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    abstract public function buildWidget();

    public function isValid()
    {
        foreach ($this->validators as $validator) {
            if (!$validator->isValid($this->value)) {
                $this->errorMessage = $validator->getErrorMessage();
                return false;
            }
        }
        return true;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    public function setErrorMessage($errorMessage)
    {
        if (is_string($errorMessage)) {
            $this->errorMessage = $errorMessage;
        }
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        if (is_string($label)) {
            $this->label = $label;
        }
    }

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

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        if (is_string($value)) {
            $this->value = $value;
        }
    }

    public function getValidators()
    {
        return $this->validators;
    }

    public function setValidators(array $validators)
    {
        foreach ($validators as $validator) {
            if ($validator instanceof Validator && !in_array($validator, $this->validators)) {
                $this->validators[] = $validator;
            }
        }
    }
}
