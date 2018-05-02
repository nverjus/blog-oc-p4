<?php
namespace Blog\Controller;

use NV\MiniFram\Controller;
use NV\MiniFram\Request;
use Blog\Entity\User;
use Blog\Form\LoginFormBuilder;

class SecurityController extends Controller
{
    public function executeLogIn(Request $request)
    {
        $user = new User([]);

        if ($request->getMethod() == 'POST') {
            $user->setEmail($request->postData('email'));
            $user->setClearPassword($request->postData('clearPassword'));
        }

        $formBuilder = new LoginFormBuilder($user);
        $formBuilder->build();
        $form = $formBuilder->getForm();

        if ($request->getMethod() == 'POST' && $form->isValid()) {
            $user = $this->manager->getRepository('User')->findByEmail($request->postData('email'));
            if ($user !== null) {
                $user->setClearPassword($request->postData('clearPassword'));
                if ($user->verifyPassword()) {
                    $user->connect();
                    $this->app->getSession()->setFlash('Bienvenue '.$user->getName());
                    $this->app->getResponse()->redirect('/admin-posts');
                }
            }
            $this->app->getSession()->setFlash('Identifiants incorrects');
        }

        return $this->render('Security/login.html.twig', array('form' => $form->createView()));
    }

    public function executeLogout(Request $request)
    {
        $this->app->getSession()->deleteAttribute('user');
        $this->app->getResponse()->redirect('/');
    }
}
