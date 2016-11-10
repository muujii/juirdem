<?php

namespace AdminBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px',  'disabled'=>true)))
//            ->add('email', EmailType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px',  'disabled'=>true)))
//            ->add('phone', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px',  'disabled'=>true)))
//            ->add('password', RepeatedType::class, array(
//                'type' => PasswordType::class,
//                'first_options' => array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px', 'placeholder' => 'Нууц үг')),
//                'second_options' => array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px', 'placeholder' => 'Нууц үг давтах'))))
            ->add('file', null,array('attr' => array('class' => 'text-center center-block well well-sm', 'style' => 'margin-top: 15px', 'disabled'=>true)));
//            ->add('submit', SubmitType::class, array('label' => 'Хадгалах', 'attr' => array('class' => 'btn btn-primary btn-block', 'style' => 'margin-bottom:15px', 'disabled'=>true)));
    }

    public function getName()
    {
        return 'Register';
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