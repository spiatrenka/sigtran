<?php

namespace Vgks\SigtranBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('VgksSigtranBundle:Default:index.html.twig');
    }

    public function successAction()
    {
        return $this->render('VgksSigtranBundle:Default:success.html.twig', array(
            'message' => $_REQUEST['message'],
        ));
    }
}
