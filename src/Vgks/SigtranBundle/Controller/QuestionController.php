<?php

namespace Vgks\SigtranBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vgks\SigtranBundle\Entity\Answers;
use Vgks\SigtranBundle\Entity\Questions;
use Symfony\Component\HttpFoundation\Request;

class QuestionController extends Controller
{
    public function allAction()
    {
        $questions = $this->getDoctrine()
            ->getRepository('VgksSigtranBundle:Questions')
            ->findAll();

        return $this->render('VgksSigtranBundle:Question:all.html.twig', array(
            'questions' => $questions,
        ));
    }

    public function showAction($id)
    {
        $question = $this->getDoctrine()
            ->getRepository('VgksSigtranBundle:Questions')
            ->find($id);

        if (!$question) {
            throw $this->createNotFoundException(
                'Извините, вопрос с номером ' . $id . ' не найден'
            );
        }

        return $this->render('VgksSigtranBundle:Question:show.html.twig', array(
            'question' => $question,
        ));
    }

    public function addAction(Request $request)
    {
        $question = new Questions();

        for ($i = 0; $i < 4; $i++) {
            $question->getAnswers()->add(new Answers());
        }

        $form = $this->createForm('question', $question);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($question);
            $answers = $question->getAnswers();
            foreach ($answers as $answer) {
                $answer->setQuestion($question);
                $em->persist($answer);
            }
            $em->flush();

            return $this->redirectToRoute('vgks_sigtran_success', array(
                'message' => 'Вопрос был успешно добавлен',
            ));
        }

        return $this->render('VgksSigtranBundle:Question:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $question = $em->getRepository('VgksSigtranBundle:Questions')->find($id);

        $form = $this->createForm('question', $question);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($question);
            $answers = $question->getAnswers();
            foreach ($answers as $answer) {
                $answer->setQuestion($question);
                $em->persist($answer);
            }
            $em->flush();

            return $this->redirectToRoute('vgks_sigtran_success', array(
                'message' => 'Вопрос был успешно изменен',
            ));
        }

        return $this->render('VgksSigtranBundle:Question:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $question = $em->getRepository('VgksSigtranBundle:Questions')->find($id);

        $answers = $question->getAnswers();
        $em->remove($question);
        foreach ($answers as $answer) {
            $em->remove($answer);
        }
        $em->flush();

        return $this->redirectToRoute('vgks_sigtran_success', array(
            'message' => 'Вопрос был успешно удален',
        ));
    }
}