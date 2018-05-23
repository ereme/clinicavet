<?php

namespace App\Form;

use App\Entity\Consulta;
use App\Entity\Mascota;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ConsultaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('fechahora', DateTimeType::class, array(
                'format' => 'dd/MM/yyyy',
                'required' => true,
                'years' => range(date('Y'), date('Y') + 2)
            ))
            ->add('descripcion')
            ->add('importe')
            ->add('mascota', EntityType::class, array(
                'class' => Mascota::class,
                'choice_label' => 'nombre',
            ))
            ->add('save', SubmitType::class, array('attr' => array('class' => 'btn btn-success')))
            ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Consulta::class,
        ]);
    }
}
