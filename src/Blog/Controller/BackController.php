<?php
namespace Blog\Controller;

use NV\MiniFram\Controller;
use NV\MiniFram\Request;
use Blog\Entity\Post;
use Blog\Entity\Form\PostFormBuilder;

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
}
