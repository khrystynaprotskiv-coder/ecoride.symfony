<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Travel;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TravelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDepart', null,[
                'label' => 'Date de départ',
                'row_attr' => [
                    'class' => 'form-item'
                ]])
            ->add('dateArrive', null,[
                'label' => "Date d'arrivée",
                'row_attr' => [
                    'class' => 'form-item'
                ]])
            ->add('timeDepart', null,[
                'label' => 'Heure de départ',
                'row_attr' => [
                    'class' => 'form-item'
                ]])
            ->add('timeArrive', null,[
                'label' => "Heure d'arrivée",
                'row_attr' => [
                    'class' => 'form-item'
                ]])
            ->add('placeDepart', null,[
                'label' => 'Départ',
                'row_attr' => [
                    'class' => 'form-item'
                ]])
            ->add('placeArrive', null,[
                'label' => 'Destination',
                'row_attr' => [
                    'class' => 'form-item'
                ]])
            ->add('statu', null,[
                'label' => 'Status',
                'row_attr' => [
                    'class' => 'form-item'
                ]])
            ->add('nbPlaces', null,[
                'label' => 'Passagers',
                'row_attr' => [
                    'class' => 'form-item'
                ]])
            ->add('price', null,[
                'label' => 'Prix',
                'row_attr' => [
                    'class' => 'form-item'
                ]])
            ->add('car', EntityType::class, [
                'label' => 'Votre voiture',
                'class' => Car::class,
                'choice_label' => 'model',
                'row_attr' => [
                    'class' => 'form-item'
                ]
            ])
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Travel::class,
        ]);
    }
}
