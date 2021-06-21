<?php

namespace App\Repository;

use App\Entity\ServiceList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ServiceList|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServiceList|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServiceList[]    findAll()
 * @method ServiceList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServiceList::class);
    }

    /**
     * @param $category
     * @return ServiceList[] Returns an array of ServiceList objects
     */

    public function findService():array
    {
        return $this->createQueryBuilder('a')
            ->innerJoin('c.phones', 'p', 'WITH', 'p.phone = :phone')
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?ServiceList
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
