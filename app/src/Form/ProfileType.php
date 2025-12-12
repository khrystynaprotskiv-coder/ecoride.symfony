<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            

            ->add('name', null,[
                'label' => 'Votre Prenom',
                'row_attr' => [
                    'class' => 'form-item'
                ]])
            ->add('surname', null,[
                'label' => 'Votre Nom',
                'row_attr' => [
                    'class' => 'form-item'
                ]])
            ->add('telephone', null,[
                'label' => 'Votre Numéro de téléphone',
                'row_attr' => [
                    'class' => 'form-item'
                ]])
            ->add('adress', null,[
                'label' => 'Votre Adresse',
                'row_attr' => [
                    'class' => 'form-item'
                ]])
            ->add('email', null,[
                'label' => 'Votre Email',
                'row_attr' => [
                    'class' => 'form-item'
                ]])

            ->add('birthday', null,[
                'label' => 'Date de naissance',
                'row_attr' => [
                    'class' => 'form-item'
                ]])
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
