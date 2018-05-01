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
}
