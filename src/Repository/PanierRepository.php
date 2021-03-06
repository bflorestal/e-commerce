<?php

namespace App\Repository;

use App\Entity\Panier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Panier>
 *
 * @method Panier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Panier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Panier[]    findAll()
 * @method Panier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PanierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Panier::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Panier $entity, bool $flush = false): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Panier $entity, bool $flush = false): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

//    /**
//     * @return Panier[] Returns an array of Panier objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Panier
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findOrderByUser($idUser)
    {
        return $this->createQueryBuilder('p')
        ->andWhere('p.etat LIKE :statut')
        ->setParameter('statut', "1")
        ->andWhere('p.user = :user')
        ->setParameter('user', $idUser)
        ->orderBy('p.date', 'DESC')
        ->getQuery()
        ->getResult()
        ;
    }

    public function notPaidOrder($idEtat){
        return $this->createQueryBuilder('p')
        ->andWhere('p.etat = 0')
        ->getQuery()
        ->getResult()
        ;
    }

    public function findOrderById($idCommande)
    {
        return $this->createQueryBuilder('p')
        ->andWhere('p.id = :id')
        ->setParameter('id', $idCommande)
        ->getQuery()
        ->getResult()
        ;
    }

    public function findOrderByIdNull($idUser)
    {
        return $this->createQueryBuilder('p')
        ->andWhere('p.etat LIKE :statut')
        ->setParameter('statut', "0")
        ->andWhere('p.user = :user')
        ->setParameter('user', $idUser)
        ->orderBy('p.date', 'DESC')
        ->getQuery()
        ->getResult()
        ;
    }
}
