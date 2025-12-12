<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Asserrt;

class ContactDTO
{
    #[Asserrt\Length (
        min: 5,
        max: 50,
        minMessage: 'Le nom doit faire au moins {{ limit }} caractères',
        maxMessage: 'Le nom ne peut pas faire plus de {{ limit }} caractères',
    )]

    public string $name = '';
    
    #[Asserrt\NotBlank (
        message: 'Entrez votre email'
    )]
    #[Asserrt\Email (
        message: 'L\'email {{ value }} n\'est pas un email valide.'
    )]  
    public string $email = '';

    #[Asserrt\Length  (
        min: 10,
        max: 100,
        minMessage: 'Le message doit faire au moins {{ limit }} caractères',  
    )]
    public string $message = '';

}
