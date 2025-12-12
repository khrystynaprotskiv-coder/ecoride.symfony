<?php

namespace App\Controller;

use Exeption;
use App\DTO\ContactDTO;
use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Loader\Configurator\mailer;


final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function contact(MailerInterface $mailer, Request $request): Response
    {
        $contact = new ContactDTO();

        //Pré-remplir le formulaire si l'utilisateur est connecté
        //$user = $token->getUser();

        if($user = $this->getUser()){
            $contact-> name = $user-> getName();
            $contact-> email = $user-> getEmail();
        }
        
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            try {
                $data = $form->getData();
                $email = (new TemplatedEmail())
                ->from(new Address($data->email, $data->name))
                ->to('ecoride@gmailcom')
                ->bcc('bcc@example.com')
                ->subject('Contact depuis le site Ecoride')
                ->text($data->message)
                ->htmlTemplate('emails/contact.html.twig')
                ->locale('fr')
                ->context([
                    'message' => $data->message
                ]);
               
                $mailer->send($email);
                $this->addFlash('success', 'Votre message a bien été envoyé !');

                return $this->redirectToRoute('home');
                
            } catch (Exeption $e) {
                $this->addFlash('alert', 'Un problème technique est survenu, veuillez réessayer plus tard.');
            }
        }


        return $this->render('contact/contact.html.twig', [
            'title' => 'Contactez-nous',
            'contactForm' => $form,
        ]);
    }
}

