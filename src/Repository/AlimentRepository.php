<?php

namespace App\Repository;

use App\Entity\Aliment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Aliment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aliment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aliment[]    findAll()
 * @method Aliment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlimentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aliment::class);
    }

    /**
     * @return Aliment[] Returns an array of Aliment objects
     */
    
    public function findByFiltre(Array $data)
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        };
        
        return $this->createQueryBuilder('a')
            ->andWhere('a.calories <= :cal')
            ->andWhere('a.proteines <= :pro')
            ->andWhere('a.glucides <= :glu')
            ->andWhere('a.lipides <= :lip')
            ->setParameter('cal', $calories ? $calories : 200)
            ->setParameter('pro', $proteines ? $proteines : 200)
            ->setParameter('glu', $glucides ? $glucides : 200)
            ->setParameter('lip', $lipides ? $lipides : 200)
            ->orderBy('a.prix', $prix === false ? 'ASC' : 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    

    // /**
    //  * @return Aliment[] Returns an array of Aliment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Aliment
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
