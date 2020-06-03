<?php

namespace App\Repository;

use App\Entity\PageLinkCT;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PageLinkCT|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageLinkCT|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageLinkCT[]    findAll()
 * @method PageLinkCT[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageLinkCTRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PageLinkCT::class);
    }

    public function getPageLinkByCodeHAS($codeHAS)
    {
        return $this->createQueryBuilder('p')
            ->where('p.codeHAS = :code_has')
            ->setParameter('code_has', $codeHAS)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getPageLink($offset, $link)
    {
        return $this->createQueryBuilder('p')
            ->setFirstResult(($offset - 1) * $limit)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return PageLinkCT[] Returns an array of PageLinkCT objects
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
    public function findOneBySomeField($value): ?PageLinkCT
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
