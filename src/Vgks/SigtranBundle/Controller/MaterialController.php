<?php

namespace Vgks\SigtranBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MaterialController extends Controller
{
    public function showAction()
    {
        return $this->render('VgksSigtranBundle:Material:show.html.twig');
    }

    public function addAction()
    {
        return $this->render('VgksSigtranBundle:Material:add.html.twig');
    }
}