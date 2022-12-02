<?php

namespace App\Form;

use App\Entity\Sneaker;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SneakerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('style', TextType::class, [
                'label' => 'Titre du livre :',
            ])
            ->add('description', TextType::class, [
                'label' => 'Titre du livre :',
            ])
            ->add('size', NumberType::class, [
                'label' => 'Titre du livre :',
            ])
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sneaker::class,
        ]);
    }
}