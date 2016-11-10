<?php
namespace AdminBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SliderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', null, array('attr' => array('class' => 'form-control')) )
            ->add('titleMN', TextType::class, array('attr' => array('class' => 'form-control', 'placeholder' => 'Нэр...')))
            ->add('submit', SubmitType::class, array('label' => 'Хадгалах', 'attr' => array('class' => 'btn btn-primary btn-block', 'style' => 'margin-bottom:15px')));
    }

    public function getName()
    {
        return 'Slider';
    }

    /**
     *  OptionsResolverInterface $resolver
     **/
    public function setDefaultsOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('data_class' => 'AdminBundle\Entity\Slider'));
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'AdminBundle\Entity\Slider',);
    }
}