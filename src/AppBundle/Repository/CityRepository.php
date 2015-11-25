<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CityRepository extends EntityRepository
{
    public function findByParams()
    {
        $qb = $this->createQueryBuilder('c')
//            ->where('c.statusActive = :statusActive')
//            ->setParameter(':statusActive', $statusActive)
            ->orderBy('c.name', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }
}