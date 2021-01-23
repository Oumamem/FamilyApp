<?php

namespace App\Form;

use App\Entity\Famille;
use App\Entity\Souvenir;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class SouvenirType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label'=> 'Nom de souvenir'
            ])
            ->add('date', DateType::class,[
            'widget' => 'single_text',
                'label'=>' Date de ce beau souvenir'
            ])

            ->add('description', TextType::class, [
                'label'=>'Parlez nous de ce beau souvenir'

            ])
            ->add('path',FileType::class, [
                'mapped' => false,
                'required' => false,
                'label'=>' Souvenirs',
                'constraints' => [
                    new Image()
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Souvenir::class,
        ]);
    }
}
