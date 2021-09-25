<?php

namespace App\Form;

use App\Entity\Zauzece;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Romobil;

class ZauzeceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('period', DateIntervalType::class, [
              'with_years' => false,
              'with_months' => false,
              'days' => array_combine(range(1, 365), range(1, 365))
            ])
            ->add('romobil', EntityType::class, [
              'class' => Romobil::class
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Zauzece::class,
        ]);
    }
}
