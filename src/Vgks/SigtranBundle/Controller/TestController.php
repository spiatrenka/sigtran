<?php

namespace Vgks\SigtranBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    public function showAction()
    {
        $questionIds = $this->getDoctrine()
            ->getRepository('VgksSigtranBundle:Questions')
            ->findAll();

        $ids = array();
        foreach($questionIds as $question) {
            $ids[] = $question->getId();
        }
        $ids = array_flip($ids);
        $randQuestions = array_rand($ids, 3);

        $questions = $this->getDoctrine()
            ->getRepository('VgksSigtranBundle:Questions')
            ->findBy(array(
                'id' => $randQuestions,
            ));

        return $this->render('VgksSigtranBundle:Test:show.html.twig', array(
            'questions' => $questions,
        ));
    }

    public function checkAction()
    {
        if (isset($_REQUEST['answers'])) {
            $answers = $this->getDoctrine()
                ->getRepository('VgksSigtranBundle:Answers')
                ->findBy(array(
                    'id' => $_REQUEST['answers'],
                ));

            $ball = 0;

            foreach($answers as $answer) {
                if ($answer->getCorrect()) {
                    $ball++;
                }
            }
        } else {
            $ball = -1;
        }
        return $this->render('VgksSigtranBundle:Test:check.html.twig', array(
            'ball' => $ball,
        ));
    }
}