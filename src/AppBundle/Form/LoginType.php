<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ClientRegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array('attr' => array('class' => 'form-email form-control', 'placeholder' => 'И-Мэйл хаяг...')))
            ->add('password', RepeatedType::class, array(
            'type' => PasswordType::class,
            'first_options' => array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px', 'placeholder' => 'Нууц үг')),
            'second_options' => array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px', 'placeholder' => 'Нууц үг давтах'))))
            ->getForm();
    }

    public function getName()
    {
        return 'ClientRegister';
    }

    /**
     *  OptionsResolverInterface $resolver
     **/
    public function setDefaultsOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'AppBundle\Entity\ClientRegister'));
    }

}