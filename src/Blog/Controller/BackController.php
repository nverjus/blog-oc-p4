<?php
namespace Blog\Controller;

use NV\MiniFram\Controller;
use NV\MiniFram\Request;
use Blog\Entity\Post;
use Blog\Form\PostFormBuilder;
use Blog\Form\DeleteFormBuilder;

class BackController extends Controller
{
    public function executeAdminPosts(Request $request)
    {
        if (!$this->isGranted('member')) {
            $this->app->getSession()->setFlash('Vous n\'avez pas les droits nécessaire pour aller sur cette page');
            $this->app->getResponse()->redirect('/blog');
        }
        $builder = new DeleteFormBuilder;
        $builder->build();
        $form = $builder->getForm();

        $posts = $this->manager->getRepository('Post')->findAll();


        return $this->render('Back/adminPosts.html.twig', array('posts' => $posts, 'form' => $form->createView()));
    }

    public function executeAddPost(Request $request)
    {
        if (!$this->isGranted('member')) {
            $this->app->getSession()->setFlash('Vous n\'avez pas les droits nécessaire pour aller sur cette page');
            $this->app->getResponse()->redirect('/blog');
        }

        $post = new Post([]);
        if ($request->getMethod() == 'POST') {
            $post->setTitle($request->postData('title'));
            $post->setIntro($request->postData('intro'));
            $post->setCOntent($request->postData('content'));
        }

        $builder = new PostFormBuilder($post);
        $builder->build();
        $form = $builder->getForm();

        if ($request->getMethod() == 'POST' && $form->isValid()) {
            $post->setUserId((int) $this->app->getSession()->getUser()['id']);
            $this->manager->getRepository('Post')->save($post);
            $this->app->getSession()->setFlash('L\'article à bien été ajouté');
            $this->app->getResponse()->redirect('/admin-posts');
        }

        return $this->render('Back/addPost.html.twig', array('form' => $form->createView()));
    }

    public function executeEditPost(Request $request)
    {
        if (!$this->isGranted('member')) {
            $this->app->getSession()->setFlash('Vous n\'avez pas les droits nécessaire pour aller sur cette page');
            $this->app->getResponse()->redirect('/blog');
        }

        if (!$request->getExists('id') || ((int) $request->getData('id') <= 0)) {
            $this->app->getResponse()->redirect404();
        }
        $post = $this->manager->getRepository('Post')->findById((int) $request->getData('id'));
        if ($post == null) {
            $this->app->getResponse()->redirect404();
        }
        if ($request->getMethod() == 'POST') {
            $post->setTitle($request->postData('title'));
            $post->setIntro($request->postData('intro'));
            $post->setContent($request->postData('content'));
        }

        $builder = new PostFormBuilder($post);
        $builder->build();
        $form = $builder->getForm();

        if ($request->getMethod() == 'POST' && $form->isValid()) {
            $post->setUserId((int) $this->app->getSession()->getUser()['id']);
            $this->manager->getRepository('Post')->save($post);
            $this->app->getSession()->setFlash('L\'article à bien été ajouté');
            $this->app->getResponse()->redirect('/admin-posts');
        }

        return $this->render('Back/editPost.html.twig', array(
          'form' => $form->createView(),
          'post' => $post,
        ));
    }

    public function executeDeletePost(Request $request)
    {
        if (!$this->isGranted('member')) {
            $this->app->getSession()->setFlash('Vous n\'avez pas les droits nécessaire pour aller sur cette page');
            $this->app->getResponse()->redirect('/blog');
        }
        if ($request->postData('csrf') != $this->app->getSession()->getAttribute('csrf')) {
            $this->app->getSession()->setAttribute('flash', 'Vous ne pouvez supprimer un article sans passer par cette page');
            $this->app->getResponse()->redirect('/admin-posts');
        }

        $post = $this->manager->getRepository('Post')->findById((int) $request->getData('id'));
        if ($post !== null) {
            $comments = $this->manager->getRepository('Comment')->findByPost($post->getId());
            if (!empty($comments)) {
                foreach ($comments as $comment) {
                    $this->manager->getRepository('Comment')->delete($comment);
                }
            }
            $this->manager->getRepository('Post')->delete($post);

            $this->app->getSession()->setAttribute('flash', 'L\'article à bien été supprimé');
        } else {
            $this->app->getSession()->setAttribute('flash', 'L\'article n\'existe pas');
        }
        
        $this->app->getResponse()->redirect('/admin-posts');
    }
}