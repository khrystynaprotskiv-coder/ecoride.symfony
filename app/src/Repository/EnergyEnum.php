<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


enum EnergyEnum  : string

{
    case HYBRID = 'HYBRID' ;
    case ELECTRIC = 'ELECTRIC' ;
    case THERMIC = 'THERMIC' ;
}