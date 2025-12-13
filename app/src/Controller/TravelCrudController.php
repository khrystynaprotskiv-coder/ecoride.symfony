<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\User;
use App\Entity\Travel;
use App\Form\FilterType;
use App\Form\TravelType;
use App\Form\SearchTravelType;
use App\Repository\TravelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/travel/crud')]
final class TravelCrudController extends AbstractController
{
    #[Route(name: 'travel_crud_index', methods: ['GET', 'POST'])]
    public function index(Request $request, TravelRepository $travel): Response
    {
        $search = new Travel();

        $filter = new Travel();
        
        $form = $this->createForm(SearchTravelType::class, $search);
        $form->handleRequest($request);

        $form2 = $this->createForm(FilterType::class, $filter);
        $form2->handleRequest($request);
     
        return $this->render('travel_crud/index.html.twig', [
            'form' => $form,
            'form2' => $form2,
            'travel' => $travel->getSearchFilterQuery($search, $filter),
        ]);
    }


    #[Route('/new', name: 'travel_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $travel = new Travel();

        $user = $this-> getUser();

        if (empty($user)) {
            throw $this->createAccessDeniedException();
        }


        $limit = 3;
        $page = (int) $request-> query-> get('page', 1);
        $data = $entityManager->getRepository(Car::class)->paginationCarsByUser($user, $limit, $page);

        if (empty($data['cars'])) {
            throw $this->createAccessDeniedException();
        }
        

        $travel-> setOwner($user);

        $form = $this->createForm(TravelType::class, $travel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($travel);
            $entityManager->flush();

            return $this->redirectToRoute('travel_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('travel_crud/new.html.twig', [
            'travel' => $travel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'travel_crud_show', methods: ['GET'])]
    public function show(Travel $travel): Response
    {
        
        return $this->render('travel_crud/show.html.twig', [
            'travel' => $travel,
            
        ]);
    }

    #[Route('/{id}/edit', name: 'travel_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Travel $travel, EntityManagerInterface $entityManager): Response
    {

        if ($travel->getOwner() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(TravelType::class, $travel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('travel_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('travel_crud/edit.html.twig', [
            'title' => 'Modification de la trajet',
            'travel' => $travel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'travel_crud_delete', requirements: [ 'id' => '\d+'], methods: ['POST'])]
    public function delete(Travel $travel, EntityManagerInterface $em)
    {

        if ($travel->getOwner() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        $em-> remove($travel);
        $em-> flush();

        $this-> addFlash('success', "Votre trajet " . $travel->getId() . " a été supprimé");

        //Rediriger ver le tableau de bord
        return $this-> redirectToRoute('profile_show');
    }
    

    #[Route('/{id}/participer', name: 'travel_participer', methods: ['GET', 'POST'])]
    public function participer(Travel $travel, EntityManagerInterface $entityManager)
    {
        $user = $this-> getUser();
        $credit = $user->getCredits();
        $price = $travel->getPrice();
        $user->setCredits( $credit - $price );

        if (empty($user)) {
            throw $this->createAccessDeniedException();
        }

        $travel-> addUser($user);

        $entityManager-> flush();

        $this-> addFlash('success', "Votre trajet " . $travel->getId() . " a été supprimé");

        return $this-> redirectToRoute('profile_show');
    }

}

       