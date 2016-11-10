<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class ConsignerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('company', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px', 'placeholder' => 'Байгууллагын нэр')))
            ->add('name', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px', 'placeholder' => 'Хэрэглэгчийн нэр')))
            ->add('register', NumberType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px', 'placeholder' => 'Байгууллагын регистерийн дугаар')))
            ->add('email', EmailType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px', 'placeholder' => 'И-Мэйл')))
            ->add('phone', NumberType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px', 'placeholder' => 'Утасны дугаар')))
            ->add('address', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px', 'placeholder' => 'Хаяг')))
            ->add('type', ChoiceType::class, array(
                'choices'  => array(
                    'Бөөний бүтээгдэхүүн' => 'Бөөний бүтээгдэхүүн',
                    'Жижиглэнгийн бүтээгдэхүүн' => 'Жижиглэнгийн бүтээгдэхүүн',
                ),
                'placeholder' => 'Төлөв сонгох',
                'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('vat', ChoiceType::class, array(
                'choices'  => array(
                    'НӨАТ-тай' => 'НӨАТ-тэй',
                    'НӨАТ-гүй' => 'НӨАТ-гүй',
                ),
                'placeholder' => 'Татвар',
                'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('save', SubmitType::class, array('label' => 'Хадгалах', 'attr' => array('class' => 'btn btn-primary btn-block', 'style' => 'margin-bottom:15px')));
    }

    public function getName()
    {
        return 'Consigner';
    }

    /**
     *  OptionsResolverInterface $resolver
     **/
    public function setDefaultsOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'AdminBundle\Entity\Consigner'));
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'AdminBundle\Entity\Consigner',);
    }
}