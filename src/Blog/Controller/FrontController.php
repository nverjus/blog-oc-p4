<?php
namespace Blog\Controller;

use NV\MiniFram\Controller;
use NV\MiniFram\Request;
use Blog\Form\CommentFormBuilder;
use Blog\Form\ContactMailFormBuilder;
use Blog\Entity\Comment;
use Blog\Entity\ContactMail;
use NV\MiniFram\Mailer;

class FrontController extends Controller
{
    public function executeIndex(Request $request)
    {
        $contactMail = new ContactMail([]);
        if ($request->getMethod() == 'POST') {
            $contactMail->setName($request->postData('name'));
            $contactMail->setEmail($request->postData('email'));
            $contactMail->setContent($request->postData('content'));
        }
        $formBuilder = new ContactMailFormBuilder($contactMail);
        $formBuilder->build();
        $contactForm = $formBuilder->getForm();

        if ($request->getMethod() == 'POST' && $contactForm->isValid()) {
            $contactMail->setTitle('Nouveau message en provenance du blog');
            $mailer = new Mailer($this->app->getConfig()->get('swiftmailer'));

            if ($mailer->send($contactMail)) {
                $this->app->getSession()->setFlash('Le message à bien été envoyé');
            } else {
                $this->app->getSession()->setFlash('Erreur lors de l\'envoi du message');
            }
            $this->app->getResponse()->redirect('/#contact');
        }

        return $this->render('Front/index.html.twig', array('form' => $contactForm->createView()));
    }

    public function executeBlog(Request $request)
    {
        $posts = $this->manager->getRepository('Post')->findAll();

        return $this->render('Front/blog.html.twig', array('posts' => $posts));
    }

    public function executeViewPost(Request $request)
    {
        // if id is incorect, redirect to error 404
        if (!$request->getExists('id') || ((int) $request->getData('id') <= 0)) {
            $this->app->getResponse()->redirect404();
        }
        //Get Post
        $post = $this->manager->getRepository('Post')->findById((int) $request->getData('id'));
        if ($post == null) {
            $this->app->getResponse()->redirect404();
        }
        //Get author if exists
        if ($post->getUserId() !== null) {
            $post->setUser($this->manager->getRepository('User')->findById($post->getUserId()));
        }

        // Get comments if exists
        $post->setComments($this->manager->getRepository('Comment')->findByPostValidated($post->getId()));

        //Build Comment Form
        $comment = new Comment([]);
        if ($request->getMethod() == 'POST') {
            $comment->setAuthor($request->postData('author'));
            $comment->setContent($request->postData('content'));
            $comment->setPostId($post->getId());
        }
        $commentFormBuilder = new CommentFormBuilder($comment);
        $commentFormBuilder->build();
        $form = $commentFormBuilder->getForm();

        //Form Porocess
        if ($request->getMethod() == 'POST' && $form->isValid()) {
            $this->manager->getRepository('Comment')->save($comment);
            $this->app->getSession()->setFlash('Le commentaire à bien été ajouté et en attente de validation');
            $this->app->getResponse()->redirect('/post-'.$post->getId().'#comments');
        }

        return $this->render('Front/postView.html.twig', array(
          'post' => $post,
          'form' => $form->createView(),
        ));
    }
}
