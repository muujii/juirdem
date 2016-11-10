<?php

namespace AdminBundle\Form;


use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SubMenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('labelMN', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px', 'placeholder' => 'Sub меню нэр')))
            ->add('link', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px', 'placeholder' => 'Холбоос')))
            ->add('parentID', EntityType::class, array(
                'class' => 'AdminBundle:Menu',
                'query_builder' => function (EntityRepository $m) {
                    return $m->createQueryBuilder('m')->where('m.parentID is null');
                },
                'required' => true,
                'multiple' => false,
                'choice_label' => 'labelMN',
                'choice_value' => 'id',
                'expanded' => false,
                'placeholder' => 'Харьяалагдах меню сонгох',
                'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('submit', SubmitType::class, array('label' => 'Хадгалах', 'attr' => array('class' => 'btn btn-primary btn-block', 'style' => 'margin-bottom:15px')));
    }

    public function getName(){
        return 'Menu';
    }

    /**
     *  OptionsResolverInterface $resolver
     **/
    public function setDefaultsOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'AdminBundle\Entity\Register'));
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'AdminBundle\Entity\Register',);
    }
}