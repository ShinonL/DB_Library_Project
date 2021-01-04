<?php

namespace App\Repository;

use App\Entity\Languages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Languages|null find($id, $lockMode = null, $lockVersion = null)
 * @method Languages|null findOneBy(array $criteria, array $orderBy = null)
 * @method Languages[]    findAll()
 * @method Languages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LanguagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Languages::class);
    }

    public function findLanguage($isbn) {
        $qb = $this->createQueryBuilder('lan');

        $qb->select('lan.languageName')
            ->innerJoin('App\Entity\Book', 'b', Join::WITH, 'b.language = lan.languageId')
            ->where('b.isbn =' . $isbn);

        return $qb->getQuery()->getResult();
    }
    // /**
    //  * @return Languages[] Returns an array of Languages objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Languages
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
