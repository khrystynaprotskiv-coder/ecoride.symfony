<?php

namespace App\Form;

use App\DTO\ContactDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'empty_data' => '',
                'label' => 'Votre nom',
                'row_attr' => [
                    'class' => 'form-item'
                ]
                
            ])
            ->add('email', EmailType::class, [
                'empty_data' => '',
                'label' => 'Votre email',
                'row_attr' => [
                    'class' => 'form-item'
                ]
                
                    
            ])
            ->add('message', TextareaType::class, [
                'empty_data' => '',
                'label' => 'Votre message',
                'row_attr' => [
                    'class' => 'form-item'
                ]
                
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactDTO::class,
        ]);
    }
}
