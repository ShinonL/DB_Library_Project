<?php

namespace App\Repository;

use App\Entity\Shippingcompany;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Shippingcompany|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shippingcompany|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shippingcompany[]    findAll()
 * @method Shippingcompany[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShippingcompanyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shippingcompany::class);
    }

    // /**
    //  * @return Shippingcompany[] Returns an array of Shippingcompany objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Shippingcompany
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
