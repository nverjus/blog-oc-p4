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
}
