<?php
namespace Blog\Form;

use NV\MiniFram\Form\FormBuilder;
use NV\MiniFram\Form\PasswordField;
use NV\MiniFram\Form\EmailField;
use NV\MiniFram\Form\SubmitField;
use NV\MiniFram\Validator\MaxLengthValidator;
use NV\MiniFram\Validator\NotNullValidator;
use NV\MiniFram\Validator\EmailValidator;

class LoginFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new EmailField([
      'label' => 'Adresse email',
      'name' => 'email',
      'validators' => [
        new EmailValidator('Veuillez entrer une adresse email valide'),
        new NotNullValidator('Veuillez entrer votre adresse email'),
      ],
    ]))
    ->add(new PasswordField([
      'label' => 'Mot de Passe',
      'name' => 'clearPassword',
      'validators' => [
        new NotNullValidator('Veuillez entrer votre mot de passe'),
      ],
    ]))
    ->add(new SubmitField([
      'value' => 'Se Connecter',
      'class' => 'btn btn-success btn-lg',
    ]));
    }
}
