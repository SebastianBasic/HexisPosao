<?php

namespace App\Form;

use App\Entity\Marka;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MarkaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('naziv')
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
            'data_class' => Marka::class,
        ]);
    }
}
