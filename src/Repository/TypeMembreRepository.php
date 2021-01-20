<?php

namespace App\Repository;

use App\Entity\TypeMembre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeMembre|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeMembre|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeMembre[]    findAll()
 * @method TypeMembre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeMembreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeMembre::class);
    }

    // /**
    //  * @return TypeMembre[] Returns an array of TypeMembre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeMembre
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
