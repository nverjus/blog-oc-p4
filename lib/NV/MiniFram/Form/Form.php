<?php
namespace NV\MiniFram\Form;

use NV\MiniFram\Entity;

class Form
{
    protected $entity;
    protected $fields = [];

    public function add(Field $field)
    {
        if (!empty($field->getName()) && ($field->getName())) {
            $attr = 'get'.ucfirst($field->getName());
            $field->setValue($this->entity->$attr());
        }

        $this->fields[] = $field;
        return $this;
    }

    public function createView()
    {
        $csrfField  = new CSRFField(array(
          'validators' => [
            new \NV\MiniFram\Validator\CSRFValidator('Le Jeton CSRF ne correspond pas.'),
          ]
        ));
        $csrfField->saveToken();
        $view = '';

        foreach ($this->fields as $field) {
            $view .= $field->buildWidget().'<br>';
        }
        $view .= $csrfField->buildWidget();
        return $view;
    }

    public function isValid()
    {
        $valid = true;

        foreach ($this->fields as $field) {
            if (!$field->isValid()) {
                $valid = false;
            }
        }

        return $valid;
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function setEntity(Entity $entity)
    {
        $this->entity = $entity;
    }
}
