<?php

namespace App\Form;

use App\Entity\Romobil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Marka;

class RomobilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tip')
            ->add('brojPutnika')
            ->add('marka', EntityType::class, [
              'class' => Marka::class,
              'attr' => [
                'required' => true
              ]
            ])
            ->add('Spremi', SubmitType::class, [
              'attr' => [
                'class' => 'btn btn-success',
                'style' => 'margin-top: 10px; width: 100%'
              ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Romobil::class,
        ]);
    }
}
