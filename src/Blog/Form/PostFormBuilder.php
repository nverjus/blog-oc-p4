<?php
namespace Blog\Form;

use NV\MiniFram\Form\FormBuilder;
use NV\MiniFram\Form\StringField;
use NV\MiniFram\Form\TextField;
use NV\MiniFram\Form\HiddenField;
use NV\MiniFram\Form\SubmitField;
use NV\MiniFram\Validator\MaxLengthValidator;
use NV\MiniFram\Validator\NotNullValidator;

class PostFormBuilder extends FormBuilder
{
    public function build()
    {
        $this->form->add(new StringField([
      'label' => 'Titre',
      'name' => 'title',
      'maxLength' => 100,
      'validators' => [
        new MaxLengthValidator('Le titre ne doit pas dépasser 100 caractères', 100),
        new NotNullValidator('Veuillez donner un titre à l\'article'),
      ],
    ]))
    ->add(new StringField([
      'label' => 'Chapô',
      'name' => 'intro',
      'maxLength' => 255,
      'validators' => [
        new MaxLengthValidator('Le chapô ne doit pas dépasser 255 caractères', 255),
        new NotNullValidator('Veuillez donner un chapô à l\'article'),
      ],
    ]))
    ->add(new TextField([
      'label' => 'Contenu de l\'article',
      'name' => 'content',
      'validators' => [
        new NotNullValidator('Votre article ne peut pas être vide'),
      ],
    ]))
    ->add(new HiddenField([
      'name' => 'userId',
    ]))
    ->add(new SubmitField([
      'value' => 'Envoyer',
      'class' => 'btn btn-success btn-lg',
    ]));
    }
}
