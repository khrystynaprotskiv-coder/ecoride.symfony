<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Security\Voter\CarVoter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/profile/car/', name: 'profile_car_', methods: ['GET'])]
final class CarController extends AbstractController
{
    #[Route('new', name: 'new', methods: ['GET','POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $car = new Car();

        if($user = $this-> getUser()) {
            $car-> setUser($user) ;
        }

        if (empty($user)) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);

        if($form-> isSubmitted() && $form-> isValid()){
            $em-> persist($car);
            $em-> flush();

            $this-> addFlash('success', "La voiture " . $car->getId() . " a bien été créée");

            return $this-> redirectToRoute('profile_show');
        }
        
        return $this->render('car/edit.html.twig', [
            'title' => 'Une nouvelle voiture',
            'form' => $form,
            
        ]);
    }

    #[Route('edit/{id}', name: 'edit', requirements: [ 'id' => '\d+'], methods: ['GET','POST'])]
    
    
    public function edit(Car $car, Request $request, EntityManagerInterface $em): Response
    {
        
        if ($car->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

       
        $form = $this->createForm(CarType::class, $car);
       
        $form->handleRequest($request);

        if($form-> isSubmitted() && $form-> isValid()){
          
            $em-> flush();

            $this-> addFlash('success', "La voiture  " . $car->getModel() . " bien été modifiée");

            //Rediriger ver le tableau de bord
            return $this-> redirectToRoute('profile_show');

        }

        return $this->render('car/edit.html.twig', [
            'title' => 'Modification '. $car->getModel(),
            'car' => $car,
            'form' => $form,
            
        ]);
    }

    #[Route('delete/{id}', name: 'delete', requirements: [ 'id' => '\d+'], methods: ['DELETE'])]
    public function delete(Car $car, EntityManagerInterface $em)
    {

        if ($car->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        $em-> remove($car);
        $em-> flush();

        $this-> addFlash('success', "Votre voiture " . $car->getModel() . " a été supprimé");

        //Rediriger ver le tableau de bord
        return $this-> redirectToRoute('profile_show');
    }

}

