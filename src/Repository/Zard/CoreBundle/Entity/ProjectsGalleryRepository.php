<?php

namespace App\Repository\Zard\CoreBundle\Entity;

use App\Zard\CoreBundle\Entity\ProjectsGallery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HomeGallery|null find($id, $lockMode = null, $lockVersion = null)
 * @method HomeGallery|null findOneBy(array $criteria, array $orderBy = null)
 * @method HomeGallery[]    findAll()
 * @method HomeGallery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectsGalleryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectsGallery::class);
    }

    public function itemsOrderRandom()
    {
        return $this->createQueryBuilder('pg')
            ->addSelect('RAND() as HIDDEN rand')
            ->orderBy('rand')
            ->getQuery()
            ->execute()
        ;
    }
    
    public function itemsByOrderProject()
    {
        return $this->createQueryBuilder('pg')
        ->leftJoin('pg.projects','p')
        ->orderBy('p.listingOrder,pg.listingOrder' ,'ASC')
        ->getQuery()
        ->execute()
        ;
    }
    
    public function getProjectGalleryRandom()
    {
        return $this->createQueryBuilder('pg')
            ->addSelect('RAND() as HIDDEN rand')
            ->orderBy('rand')
            ->setMaxResults(1)
            ->getQuery()
            /* ->getOneOrNullResult() */
            ->execute()
        ;
    }

    // /**
    //  * @return HomeGallery[] Returns an array of HomeGallery objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HomeGallery
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
