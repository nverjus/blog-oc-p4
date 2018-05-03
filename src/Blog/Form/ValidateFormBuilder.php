<?php
namespace Blog\Form;

use NV\MiniFram\Form\FormBuilder;
use NV\MiniFram\Form\SubmitField;

class ValidateFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form
       ->add(new SubmitField([
         'value' => '<i class="fa fa-check-square fa-lg"></i>',
         'classes' => 'btn btn-success',
       ]));
    }
}
