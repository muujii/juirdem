<?php

namespace AdminBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file')
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px', 'placeholder' => 'Нэр')))
            ->add('phone', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px', 'placeholder' => 'Утасны дугаар')))
            ->add('email', EmailType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px', 'placeholder' => 'И-Мэйл')))
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px', 'placeholder' => 'Нууц үг')),
                'second_options' => array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px', 'placeholder' => 'Нууц үг давтах'))))
            ->add('roleId', EntityType::class, array(
                'class' => 'AdminBundle:Role',
                'required' => true,
                'multiple' => false,
                'choice_label' => 'name',
                'choice_value' => 'id',
                'expanded' => false,
                'placeholder' => 'Үүрэг сонго',
                'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')
            ))
            ->add('save', SubmitType::class, array('label' => 'Хадгалах', 'attr' => array('class' => 'btn btn-primary btn-block', 'style' => 'margin-bottom:15px')));

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