<?php
namespace Blog\Form;

use NV\MiniFram\Form\FormBuilder;
use NV\MiniFram\Form\SubmitField;

class DeleteFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form
       ->add(new SubmitField([
         'value' => '<i class="fa fa-close fa-lg"></i>',
         'classes' => 'btn btn-danger',
       ]));
    }
}
