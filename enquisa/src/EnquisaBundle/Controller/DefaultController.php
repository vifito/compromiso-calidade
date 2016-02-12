<?php

namespace EnquisaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->redirectToRoute('enquisa_dashboard');
        //return $this->render('EnquisaBundle:Default:index.html.twig');
    }
}
