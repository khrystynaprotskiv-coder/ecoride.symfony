<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Brand;
use App\Repository\EnergyEnum;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model', null,[
                'label' => 'Model',
                'row_attr' => [
                    'class' => 'form-item'
                ]])
            ->add('color', null,[
                'label' => 'Color',
                'row_attr' => [
                    'class' => 'form-item'
                ]])
            ->add('registration', null,[
                'label' => 'Registration',
                'row_attr' => [
                    'class' => 'form-item'
                ]])
            ->add('registrationAt', null,[
                'label' => 'Date de registration',
                'row_attr' => [
                    'class' => 'form-item'
                ]])
          
            ->add('energy',ChoiceType::class,[
                'placeholder'=>'Énergie/Carburant',
                'choices'=>[
                    'Essence'=> 'essence',
                    'Diesel'=>'diesel',
                    'Hybrid'=>'hybrid',
                    'Électric'=> 'electric'],
                'row_attr' => [
                    'class' => 'form-item']
            ])

            ->add('brand', EntityType::class, [
                'class' => Brand::class,
                'choice_label' => 'label',
                'row_attr' => [
                    'class' => 'form-item'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
