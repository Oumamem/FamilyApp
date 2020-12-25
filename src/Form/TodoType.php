<?php

namespace App\Form;

use App\Entity\Membre;
use App\Entity\Todo;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TodoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label'=>'Nom de la tache'])
            ->add('description', null, ['label'=>'Description'])
            ->add('AssigneA',  EntityType::class, [
                'class'=>Membre::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('m')
                        ->orderBy('m.prenom', 'ASC');
                },
                'choice_label' => 'prenom'
            ])
            ->add('termine', null, ['label'=>'est faite?'])
            ->add('membre', EntityType::class, [
                'class'=>Membre::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('m')
                        ->orderBy('m.prenom', 'ASC');
                },
                'choice_label' => 'prenom'
            ])
            ->add('save', SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Todo::class,
        ]);
    }
}
