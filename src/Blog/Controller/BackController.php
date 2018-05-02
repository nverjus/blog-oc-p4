<?php
namespace Blog\Controller;

use NV\MiniFram\Controller;
use NV\MiniFram\Request;
use Blog\Entity\Post;
use Blog\Form\PostFormBuilder;

class BackController extends Controller
{
    public function executeAdminPosts(Request $request)
    {
        if (!$this->isGranted('member')) {
            $this->app->getSession()->setFlash('Vous n\'avez pas les droits nécessaire pour aller sur cette page');
            $this->app->getResponse()->redirect('/blog');
        }

        $posts = $this->manager->getRepository('Post')->findAll();


        return $this->render('Back/adminPosts.html.twig', array('posts' => $posts));
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
}
