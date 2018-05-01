<?php
namespace NV\MiniFram\Form;

use NV\MiniFram\Entity;

abstract class FormBuilder
{
    protected $form;

    public function __construct($entity = null)
    {
        $this->form = new Form;
        if ($entity !== null) {
            $this->form->setEntity($entity);
        }
    }

    abstract public function build();

    public function getForm()
    {
        return $this->form;
    }
}
