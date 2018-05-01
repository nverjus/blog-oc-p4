<?php
namespace Blog\Controller;

use NV\MiniFram\Controller;
use NV\MiniFram\Request;
use Blog\Form\CommentFormBuilder;
use Blog\Entity\Comment;

class FrontController extends Controller
{
    public function executeIndex(Request $request)
    {
        return $this->render('Front/index.html.twig');
    }

    public function executeBlog(Request $request)
    {
        $posts = $this->manager->getRepository('Post')->findAll();

        return $this->render('Front/blog.html.twig', array('posts' => $posts));
    }

    public function executePostView(Request $request)
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
