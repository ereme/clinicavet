<?php

namespace App\Form;

use App\Entity\Mascota;
use App\Entity\Cliente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class MascotaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('animal')
            ->add('fechanac', DateType::class, array(
                'format' => 'dd/MM/yyyy',
                'required' => true,
                'years' => range(date('Y'), date('Y') - 20)
            ))
            ->add('cliente', EntityType::class, array(
                'class' => Cliente::class,
                'multiple' => false,
                'choice_label' => 'nombre',
            ))
            ->add('save', SubmitType::class, array('attr' => array('class' => 'btn btn-success')))
            ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mascota::class,
        ]);
    }
}