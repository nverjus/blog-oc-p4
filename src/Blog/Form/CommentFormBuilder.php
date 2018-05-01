<?php
namespace Blog\Form;

use NV\MiniFram\Form\FormBuilder;
use NV\MiniFram\Form\StringField;
use NV\MiniFram\Form\TextField;
use NV\MiniFram\Form\SubmitField;
use NV\MiniFram\Validator\MaxLengthValidator;
use NV\MiniFram\Validator\NotNullValidator;

class CommentFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new StringField([
      'label' => 'Nom (obligatoire)',
      'name' => 'author',
      'maxLength' => 50,
      'validators' => [
        new MaxLengthValidator('Votre nom ne doit pas dépasser 50 caractères', 50),
        new NotNullValidator('Veuillez entrer votre nom'),
      ],
    ]))
    ->add(new TextField([
      'label' => 'Entrez votre commentaire',
      'name' => 'content',
      'validators' => [
        new NotNullValidator('Votre commentaire ne peut pas être vide'),
      ],
    ]))
    ->add(new SubmitField([
      'value' => 'Envoyer',
      'class' => 'btn btn-success btn-lg',
    ]));
    }
}
