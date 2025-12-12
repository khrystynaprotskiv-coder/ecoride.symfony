<?php

namespace App\Repository;

use App\Entity\Travel;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Travel>
 */
class TravelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Travel::class);
        $this->paginator = $paginator;
    }

    public function findLasts(int $limit=10) : array
    {
        return $this
            -> createQueryBuilder('t')
            -> orderBy('t.dateDepart', 'DESC')
            -> SetMaxResults($limit)
            -> getQuery()
            -> getResult();
    }


    public function getSearchFilterQuery(Travel $search, Travel $filter) : PaginationInterface 
    {
        
        $query = $this
            -> createQueryBuilder('t');

            
        if (!empty($search->placeDepart)) {
            $query=$query
            ->andWhere('t.placeDepart LIKE :placeDepart')
            ->setParameter('placeDepart', "%{$search->placeDepart}%");
        }

        if (!empty($search->placeArrive)) {
            $query=$query
            ->andWhere('t.placeArrive LIKE :placeArrive')
            ->setParameter('placeArrive', "%{$search->placeArrive}%");
        }

        $dateDepart = empty($search->dateDepart) ? date_create(): $search->dateDepart;
        $query=$query
            ->andWhere('t.dateDepart >= :dateDepart')
            ->setParameter('dateDepart', "{$dateDepart->format('Y-m-d')}");

        $nbPlaces = empty($search->nbPlaces) ? 1 : $search->nbPlaces;
        $query=$query
            ->andWhere('t.nbPlaces >=:nbPlaces')
            ->setParameter('nbPlaces', $nbPlaces);

        
        if (!empty($filter)) {

            if (!empty($filter->price)) {
                $query=$query
                ->andWhere('t.price = :price')
                ->setParameter('price', "%{$filter->price}%");
            }

        }
        //dd($query);
         $result = $this-> paginator->paginate(
            target: $query,
            page: 1,
            limit: 9
        );

        return $result;
    }





     public function paginationTravelsByOwner($user, int $limit=10, int $page=1) : array
    {

        $query = $this
            -> createQueryBuilder('t')
            -> select('t', 'w')
            -> join('t.owner', 'w')
            -> andwhere('t.owner = :user')
            -> setParameter(':user', $user);

        $query
            -> orderBy('t.dateDepart', 'DESC')
            -> setFirstResult(($page - 1) * $limit)
            -> SetMaxResults($limit);

        $paginator = new Paginator($query, fetchJoinCollection: true);
        $travels = $paginator-> getQuery()-> getResult();
        $count = $paginator-> count();
        $page = ceil($count / $limit);

        return [
            'travels' => $travels,
            'countTravels' => $count,
            'maxPages' => $page
        ];

    }



    public function paginationTravelsByPassager($user, int $limit=10, int $page=1) : array
    {

        $query = $this
            -> createQueryBuilder('t')
            -> addSelect('t')
            -> leftjoin('t.user', 'u')
            -> andwhere('u = :user')
            -> setParameter(':user', $user);
        
        $query
            -> orderBy('t.dateDepart', 'DESC')
            -> setFirstResult(($page - 1) * $limit)
            -> SetMaxResults($limit);

        $paginator = new Paginator($query, fetchJoinCollection: true);
        $travel = $paginator-> getQuery()-> getResult();
        $count = $paginator-> count();
        $page = ceil($count / $limit);

        return [
            'travel' => $travel,
            'countTravels' => $count,
            'maxPages' => $page
        ];

    }

    //    /**
    //     * @return Travel[] Returns an array of Travel objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Travel
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
