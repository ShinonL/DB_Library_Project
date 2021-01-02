<?php

namespace App\Repository;

use App\Entity\Publishers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Publishers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Publishers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Publishers[]    findAll()
 * @method Publishers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PublishersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Publishers::class);
    }

    public function findPublisher($isbn) {
        $qb = $this->createQueryBuilder('pub');

        $qb->select('pub.name')
            ->innerJoin('App\Entity\Book', 'b', Join::WITH, 'b.publisher = pub.publisherId')
            ->where('b.isbn =' . $isbn);

        return $qb->getQuery()->getResult();
    }
    // /**
    //  * @return Publishers[] Returns an array of Publishers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Publishers
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
