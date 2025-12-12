<?php

namespace App\Controller;


use App\Entity\Car;
use App\Entity\User;
use App\Entity\Travel;
use App\Form\ProfileType;
use App\Security\Voter\ProfileVoter;
use App\Controller\ProfileController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('profile/', name: 'profile_', methods: ['GET'])]
final class ProfileController extends AbstractController
{
    #[Route('show', name: 'show', methods: ['GET'])]
   
    public function show(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this-> getUser();


        if (!$user) {
        return $this->redirectToRoute('app_login');
        }

        $limit = 3;
        $page = (int) $request-> query-> get('page', 1);

        $data = $em->getRepository(Car::class)->paginationCarsByUser($user, $limit, $page);
        $data2 = $em->getRepository(Travel::class)->paginationTravelsByOwner($user, $limit, $page);
        $data3 = $em->getRepository(Travel::class)->paginationTravelsByPassager($user, $limit, $page);
        
        return $this->render('profile/show.html.twig', [
            'title' => 'User Profile',
            'user' => $user,
            'cars' => $data['cars'],
            'page' => $page,
            'travels' => $data2['travels'],
            'travel' => $data3['travel'],
            'maxPages' => $data['maxPages']
        ]);

    }
    
    #[Route('edit/{id}', name: 'edit', requirements: [ 'id' => '\d+'], methods: ['GET','POST'])]
    #[IsGranted(ProfileVoter::EDIT, subject: 'user')]
    public function edit(User $user, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ProfileType::class, $user);

        //récupérer les données postées
        $form->handleRequest($request);


        
        if($form-> isSubmitted() && $form-> isValid()){

            
            //Faire les modifications en bdd
            $em-> flush();

            $this-> addFlash('success', "Votre profile a été modifié");

            //Rediriger ver le tableau de bord
            return $this-> redirectToRoute('profile_show');

        }

        return $this->render('profile/edit.html.twig', [
            'title' => 'Modification de mon compte',
            'user' => $user,
            'form' => $form
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', requirements: [ 'id' => '\d+'], methods: ['DELETE'])]
    public function delete(User $user, Request $request, EntityManagerInterface $em)
    {


        $em-> remove($user);
        $em-> flush();

        $this-> addFlash('success', "Votre trajet compte a été supprimé");

        
        return $this-> redirectToRoute('home');
    }





}




     