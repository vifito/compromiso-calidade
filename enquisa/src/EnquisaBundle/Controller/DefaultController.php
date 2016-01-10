<?php

namespace EnquisaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->redirectToRoute('enquisa_upload');
        //return $this->render('EnquisaBundle:Default:index.html.twig');
    }
}
