<?php
namespace Blog\Form;

use NV\MiniFram\Form\FormBuilder;
use NV\MiniFram\Form\StringField;
use NV\MiniFram\Form\EmailField;
use NV\MiniFram\Form\SubmitField;
use NV\MiniFram\Validator\MaxLengthValidator;
use NV\MiniFram\Validator\MinLengthValidator;
use NV\MiniFram\Validator\NotNullValidator;
use NV\MiniFram\Validator\EmailValidator;

class EditUserFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new StringField([
      'label' => 'Nom',
      'name' => 'name',
      'maxLength' => 50,
      'validators' => [
        new MaxLengthValidator('Votre nom ne doit pas dépasser 50 caractères', 50),
        new NotNullValidator('Veuillez entrer votre nom'),
      ],
    ]))
    ->add(new EmailField([
      'label' => 'Adresse email',
      'name' => 'email',
      'validators' => [
        new EmailValidator('Veuillez entrer une adresse email valide'),
        new NotNullValidator('Veuillez entrer votre  adresse email'),
      ],
    ]))
    ->add(new SubmitField([
      'value' => 'Envoyer',
      'class' => 'btn btn-success btn-lg',
    ]));
    }
}
