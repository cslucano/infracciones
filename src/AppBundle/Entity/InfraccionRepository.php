<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class InfraccionRepository extends EntityRepository
{
    public function getByWindow($desde, $hasta) {
        $qb = $this->createQueryBuilder('i');

        $query = $qb
            ->where(
                $qb->expr()->andX(
                    $qb->expr()->gte('i.hora', ':desde'),
                    $qb->expr()->lt('i.hora', ':hasta'),
                    $qb->expr()->isNotNull('i.lat'),
                    $qb->expr()->isNotNull('i.lon'),
                    $qb->expr()->isNotNull('i.hora')
                )
            )
            ->setParameters(
                [
                    'desde' => $desde,
                    'hasta' => $hasta
                ]
            )
            ->getQuery();

        return $query->execute();
    }
}
