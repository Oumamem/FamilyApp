<?php

namespace App\Form;

use App\Entity\Famille;
use App\Entity\Membre;
use App\Entity\TypeMembre;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class MembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('date_naissance')

            ->add('rolefamille', EntityType::class, [
                'class'=>TypeMembre::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('m')
                        ->orderBy('m.id', 'ASC');
                },
                'choice_label' => 'name'])
            ->add('description', null, [
                'label' => 'Parlez nous de ce membre'
                ])
            ->add('path',FileType::class, [
                'mapped' => false,
                'required' => false,
                'label'=>' Photo de profil',
                'constraints' => [
                    new Image()
                ]
            ])
            ->add('pathcover',FileType::class, [
                'mapped' => false,
                'required' => false,
                'label'=>' photo de couverture',
                'constraints' => [
                    new Image()
                ]
            ])
            ->add('famille', EntityType::class, [
                'class'=>Famille::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('m')
                        ->orderBy('m.id', 'ASC');
                },
                'choice_label' => 'name'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Membre::class,
        ]);
    }
}
