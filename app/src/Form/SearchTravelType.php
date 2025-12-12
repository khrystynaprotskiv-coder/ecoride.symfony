<?php

namespace App\Form;

use App\Entity\Travel;
use App\Entity\TravelSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchTravelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('placeDepart', null,[
                'required'=> false,
                'row_attr' => [
                    'class' => 'input-with-icon'
                ]])
            ->add('placeArrive', null,[
                'required'=> false,
                'row_attr' => [
                    'class' => 'input-with-icon'
                ]])
            ->add('dateDepart', null,[
                'required'=> false,
                'row_attr' => [
                    'class' => 'input-with-icon'
                ]])
            ->add('nbPlaces', null,[
                'label' => 'Passagers',
                'required'=> false,
                'row_attr' => [
                    'class' => 'input-with-icon'
                ]])

          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Travel::class,
        ]);
    }
}

