<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


final class HomeController extends AbstractController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {

        return $this->render('home/index.html.twig', [
            'title' => 'Ecoride',
           
            
        ]);
    }
}