<?php

namespace Vgks\SigtranBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text')
            ->add('answers', 'collection', array('type' => new AnswerType()))
            ->add('save', 'submit', array('label' => 'Сохранить'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vgks\SigtranBundle\Entity\Questions',
        ));
    }

    public function getName()
    {
        return 'question';
    }
}