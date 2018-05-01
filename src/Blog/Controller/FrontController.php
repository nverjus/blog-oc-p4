<?php
namespace Blog\Controller;

use NV\MiniFram\Controller;
use NV\MiniFram\Request;

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
        if (!$request->getExists('id') || ((int) $request->getData('id') <= 0)) {
            $this->app->getResponse()->redirect404();
        }

        $post = $this->manager->getRepository('Post')->findById((int) $request->getData('id'));
        if ($post == null) {
            $this->app->getResponse()->redirect404();
        }

        if ($post->getUserId() !== null) {
            $post->setUser($this->manager->getRepository('User')->findById($post->getUserId()));
        }

        return $this->render('Front/postView.html.twig', array('post' => $post));
    }
}
