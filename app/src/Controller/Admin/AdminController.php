<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


#[Route('/admin', name: 'admin_')]
class AdminController extends AbstractController
{
    #[Route(path: '/', name: 'home')]
    public function show(AuthenticationUtils $authenticationUtils): Response
    {

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        

        return $this->render('admin/home.html.twig', [
            'title' => 'Administration',
            'error' => $error,
        ]);
    }

}
