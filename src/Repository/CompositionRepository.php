<?php

namespace App\Repository;

use App\Entity\Composition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Composition|null find($id, $lockMode = null, $lockVersion = null)
 * @method Composition|null findOneBy(array $criteria, array $orderBy = null)
 * @method Composition[]    findAll()
 * @method Composition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompositionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Composition::class);
    }

    public function getCompositions($offset, $limit)
    {
        return $this->createQueryBuilder('c')
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getCompositionByCIS($codeCIS)
    {
        return $this->createQueryBuilder('c')
            ->where('c.codeCIS = :codeCIS')
            ->setParameter('codeCIS', $codeCIS)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getCompositionsByDesignation($offset, $limit, $designation)
    {
        return $this->createQueryBuilder('c')
            ->where('c.designationPharmaceuticalElement = :designation')
            ->setParameter('designation', $designation)
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getCompositionsBySustanceCode($offset, $limit, $substance_code)
    {
        return $this->createQueryBuilder('c')
            ->where('c.substanceCode = :substance_code')
            ->setParameter('substance_code', $substance_code)
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getCompositionsByComponentNature($offset, $limit, $composent_nature)
    {
        return $this->createQueryBuilder('c')
            ->where('c.componentNature = :composent_nature')
            ->setParameter('composent_nature', $composent_nature)
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getCompositionsByNumLink($offset, $limit, $num_link)
    {
        return $this->createQueryBuilder('c')
            ->where('c.numLink = :num_link')
            ->setParameter('num_link', $num_link)
            ->setFirstResult(($offset-1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
