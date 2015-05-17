<?php

namespace Vgks\SigtranBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vgks\SigtranBundle\Entity\Answers;
use Vgks\SigtranBundle\Entity\Questions;
use Symfony\Component\HttpFoundation\Request;

class QuestionController extends Controller
{
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
            // ... maybe do some form processing, like saving the Task and Tag objects
            $em = $this->getDoctrine()->getManager();
            $em->persist($question);
            $answers = $question->getAnswers();
            foreach ($answers as $answer) {
                $answer->setQuestion($question);
                $em->persist($answer);
            }
            $em->flush();

            return $this->redirectToRoute('vgks_sigtran_question_success');
        }

        return $this->render('VgksSigtranBundle:Question:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function successAction()
    {
        return $this->render('VgksSigtranBundle:Question:success.html.twig');
    }
}