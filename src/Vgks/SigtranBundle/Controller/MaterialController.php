<?php

namespace Vgks\SigtranBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vgks\SigtranBundle\Entity\Materials;
use Symfony\Component\HttpFoundation\Request;

class MaterialController extends Controller
{
    public function showAction()
    {
        return $this->render('VgksSigtranBundle:Material:show.html.twig');
    }

    public function addAction(Request $request)
    {
        $material = new Materials();
        $form = $this->createForm('material', $material);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($material);
            $em->flush();

            return $this->redirectToRoute('vgks_sigtran_material_success');
        }

        return $this->render('VgksSigtranBundle:Material:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function successAction()
    {
        return $this->render('VgksSigtranBundle:Material:success.html.twig');
    }
}