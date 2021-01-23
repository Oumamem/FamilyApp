<?php

namespace App\Form;

use App\Entity\Famille;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', Null, [
                'label'=> "Votre nom de famille"
            ])
            ->add('number', Null, [
                'label'=> 'Combien de membre avez-vous dans la famille?'
            ])
            ->add('email', Null,[
                'label'=>'Vueillez saisir votre mail'
            ])
            ->add('password', Null, [
                'label' =>'Créez le mot de passe de la famille'
            ])
            ->add('username', Null, [
                'label' =>"Nom d'utilisateur"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Famille::class,
        ]);
    }
}
