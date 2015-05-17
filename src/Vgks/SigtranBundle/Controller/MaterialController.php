<?php

namespace Vgks\SigtranBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vgks\SigtranBundle\Entity\Materials;
use Symfony\Component\HttpFoundation\Request;

class MaterialController extends Controller
{
    public function showAction($id)
    {
        $material = $this->getDoctrine()
            ->getRepository('VgksSigtranBundle:Materials')
            ->find($id);

        if (!$material) {
            throw $this->createNotFoundException(
                'Извините, материал с номером ' . $id . 'не найден'
            );
        }

        return $this->render('VgksSigtranBundle:Material:show.html.twig', array(
            'material' => $material,
        ));
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

            return $this->redirectToRoute('vgks_sigtran_success', array(
                'message' => 'Материал был успешно добавлен',
            ));
        }

        return $this->render('VgksSigtranBundle:Material:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $material = $em->getRepository('VgksSigtranBundle:Materials')->find($id);

        $form = $this->createForm('material', $material);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($material);
            $em->flush();

            return $this->redirectToRoute('vgks_sigtran_success', array(
                'message' => 'Материал бы успешно изменен',
            ));
        }

        return $this->render('VgksSigtranBundle:Material:edit.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $material = $em->getRepository('VgksSigtranBundle:Materials')->find($id);

        $em->remove($material);
        $em->flush();

        return $this->redirectToRoute('vgks_sigtran_success', array(
            'message' => 'Материал был успешно удален',
        ));
    }
}