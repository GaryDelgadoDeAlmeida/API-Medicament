<?php

namespace App\Repository;

use App\Entity\GroupGenerique;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method GroupGenerique|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupGenerique|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupGenerique[]    findAll()
 * @method GroupGenerique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupGeneriqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupGenerique::class);
    }

    public function getOneGroupGenerique($idGroupGenerique, $codeCIS)
    {
        return $this->createQueryBuilder('g')
            ->where('g.idGroupGenerique = :idGG AND g.codeCIS = :code_cis')
            ->setParameters(new ArrayCollection(array(
                new Parameter('idGG', $idGroupGenerique),
                new Parameter('code_cis', $codeCIS)
           )))
           ->getQuery()
           ->getOneOrNullResult();
    }

    public function getGroupGeneriqueByIdGroup($offset, $limit, $id_group_generique)
    {
        return $this->createQueryBuilder('g')
            ->where('g.idGroupGenerique = :idGG')
            ->setParameter('idGG', $id_group_generique)
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getGroupGeneriqueByType($offset, $limit, $type_generique)
    {
        return $this->createQueryBuilder('g')
            ->where('g.typeGenerique = :type_gener')
            ->setParameter('type_gener', $type_generique)
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getGroupGeneriqueByNumTri($offset, $limit, $num_tri)
    {
        return $this->createQueryBuilder('g')
            ->where('g.numTri = :num_tri')
            ->setParameter('num_tri', $num_tri)
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return GroupGenerique[] Returns an array of GroupGenerique objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GroupGenerique
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
