<?php

namespace Vgks\SigtranBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vgks\SigtranBundle\Entity\Answers;
use Vgks\SigtranBundle\Entity\Questions;
use Symfony\Component\HttpFoundation\Request;

class QuestionController extends Controller
{
    public function addAction(Request $request)
    {
        $question = new Questions();

        // dummy code - this is here just so that the Task has some tags
        // otherwise, this isn't an interesting example
        $answer1 = new Answers();
        $answer1->setText('answer1');
        $question->getAnswers()->add($answer1);
        $answer2 = new Answers();
        $answer2->setText('answer2');
        $answer2->setCorrect(true);
        $question->getAnswers()->add($answer2);
        // end dummy code

        $form = $this->createForm('question', $question);

        $form->handleRequest($request);

        if ($form->isValid()) {
            // ... maybe do some form processing, like saving the Task and Tag objects
            $em = $this->getDoctrine()->getManager();
            $em->persist($question);
            $answers = $question->getAnswers();
            foreach ($answers as $answer) {
                $em->persist($answer);
            }
            $em->flush();

            return $this->redirectToRoute('vgks_sigtran_question_success');
        }

        /*if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($material);
            $em->flush();

            return $this->redirectToRoute('vgks_sigtran_material_success');
        }*/

        return $this->render('VgksSigtranBundle:Question:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function successAction()
    {
        return $this->render('VgksSigtranBundle:Question:success.html.twig');
    }
}